<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\Startup;
use App\Models\Category;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

/**
 * AuthController
 *
 * Handles all authentication-related actions:
 * - Role selection (Startup / Mentor)
 * - Registration forms for each role
 * - Login with session-based authentication
 * - Logout
 *
 * Demonstrates:
 * - Controllers (Unit III)
 * - Request data handling (Unit IV)
 * - Form validation with rules (Unit V)
 * - CSRF protection (Unit V)
 * - Session usage for auth (Unit IV)
 * - Redirects with named routes (Unit II)
 * - Passing data to views (Unit II)
 * - Eloquent ORM CRUD - create (Unit VI)
 * - Password hashing for security
 */
class AuthController extends Controller
{
    /**
     * Show the role selection page.
     * User chooses: "I am a Startup" or "I am a Mentor"
     */
    public function showRoleSelection()
    {
        return view('auth.register-choice');
    }

    /**
     * Show the startup registration form.
     */
    public function showStartupRegister()
    {
        return view('auth.register-startup');
    }

    /**
     * Handle startup registration form submission.
     *
     * Demonstrates:
     * - Request validation (Unit V)
     * - CSRF protection (automatic via middleware)
     * - Eloquent create() for inserting data (Unit VI)
     * - Password hashing
     * - Session flash messages (Unit IV)
     * - Redirect to named route (Unit II)
     */
    public function registerStartup(Request $request)
    {
        // Form Validation (Unit V)
        $validated = $request->validate([
            'startup_name'      => 'required|string|max:255',
            'founder_name'      => 'required|string|max:255',
            'email'             => 'required|email|unique:startups,email',
            'password'          => 'required|string|min:6|confirmed',
            'industry'          => 'nullable|string|max:255',
            'stage'             => 'nullable|string|max:255',
            'problem_statement' => 'nullable|string|max:1000',
        ]);

        // Hash the password for security
        $validated['password'] = Hash::make($validated['password']);

        // Create startup using Eloquent ORM (Unit VI)
        Startup::create($validated);

        // Flash success message to session (Unit IV)
        return redirect()->route('login')->with('success', 'Startup registered successfully! Please log in.');
    }

    /**
     * Show the mentor registration form.
     * Passes categories from database to the view.
     */
    public function showMentorRegister()
    {
        // Fetch categories using Eloquent (Unit VI)
        $categories = Category::all();

        // Pass data to view (Unit II)
        return view('auth.register-mentor', compact('categories'));
    }

    /**
     * Handle mentor registration form submission.
     */
    public function registerMentor(Request $request)
    {
        // Form Validation (Unit V)
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:mentors,email',
            'password'    => 'required|string|min:6|confirmed',
            'expertise'   => 'required|string|max:255',
            'experience'  => 'required|integer|min:0|max:50',
            'bio'         => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Pending until admin approves (Unit VI)
        $validated['status'] = 'pending';

        // Create mentor using Eloquent ORM (Unit VI)
        Mentor::create($validated);

        // Redirect with success flash message
        return redirect()->route('login')->with('success', 'Mentor registered! Your account is pending admin approval.');
    }

    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login form submission.
     *
     * Demonstrates:
     * - Reading form input using $request (Unit IV)
     * - Eloquent where() query (Unit VI)
     * - Password verification with Hash::check()
     * - Storing user data in session (Unit IV)
     * - Redirect based on role (Unit II)
     */
    public function login(Request $request)
    {
        // Validate login form (Unit V)
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
            'role'     => 'required|in:startup,mentor,admin',
        ]);

        $email    = $request->input('email');
        $password = $request->input('password');
        $role     = $request->input('role');

        // Look up user in the appropriate table based on role (Unit VI)
        if ($role === 'startup') {
            $user = Startup::where('email', $email)->first();
        } elseif ($role === 'mentor') {
            $user = Mentor::where('email', $email)->first();
        } else {
            $user = Admin::where('email', $email)->first();
        }

        // Check if user exists and password matches
        if (!$user || !Hash::check($password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials. Please check your email, password, and role.'])->withInput();
        }

        // Store user data in session (Unit IV)
        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_role', $role);
        $request->session()->put('user_name', match ($role) {
            'startup' => $user->founder_name,
            'admin'   => $user->name,
            default   => $user->name,
        });
        $request->session()->put('user_email', $user->email);

        // Redirect based on role (Unit II)
        if ($role === 'startup') {
            return redirect()->route('dashboard.startup')->with('success', 'Welcome back, ' . $user->founder_name . '!');
        }
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return redirect()->route('dashboard.mentor')->with('success', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Handle logout.
     * Clears all session data.
     */
    public function logout(Request $request)
    {
        // Clear session (Unit IV)
        $request->session()->flush();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}

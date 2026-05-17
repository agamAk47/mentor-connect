<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\Startup;
use App\Models\Category;

/**
 * ProfileController
 * 
 * Handles viewing and editing user profiles.
 * Demonstrates Eloquent CRUD (Unit VI) and Form Validation (Unit V).
 */
class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $role = $request->session()->get('user_role');

        if ($role === 'mentor') {
            $user = Mentor::findOrFail($userId);
            $categories = Category::all();
            return view('profile.edit', compact('user', 'role', 'categories'));
        } elseif ($role === 'startup') {
            $user = Startup::findOrFail($userId);
            return view('profile.edit', compact('user', 'role'));
        }

        return redirect()->route('home')->with('error', 'Invalid role.');
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $role = $request->session()->get('user_role');

        if ($role === 'mentor') {
            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'email'       => 'required|email|unique:mentors,email,' . $userId . ',_id',
                'expertise'   => 'required|string|max:255',
                'experience'  => 'required|integer|min:0|max:50',
                'bio'         => 'nullable|string|max:1000',
                'category_id' => 'required|exists:categories,_id',
            ]);

            $mentor = Mentor::findOrFail($userId);
            $mentor->update($validated);

            // Update session name if changed
            $request->session()->put('user_name', $mentor->name);

            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
            
        } elseif ($role === 'startup') {
            $validated = $request->validate([
                'startup_name'      => 'required|string|max:255',
                'founder_name'      => 'required|string|max:255',
                'email'             => 'required|email|unique:startups,email,' . $userId . ',_id',
                'industry'          => 'nullable|string|max:255',
                'stage'             => 'nullable|string|max:255',
                'problem_statement' => 'nullable|string|max:1000',
            ]);

            $startup = Startup::findOrFail($userId);
            $startup->update($validated);

            // Update session name if changed
            $request->session()->put('user_name', $startup->founder_name);

            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('home');
    }
}

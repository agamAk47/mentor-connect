<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MentorshipRequest;
use App\Models\Startup;
use App\Models\Mentor;
use Illuminate\Support\Facades\Mail;
use App\Mail\MentorshipRequestReceived;

/**
 * MentorshipRequestController
 *
 * Demonstrates:
 * - Form Validation (Unit V)
 * - Eloquent CRUD -> create (Unit VI)
 * - Session Flash Data (Unit IV)
 * - Redirects (Unit II)
 */
class MentorshipRequestController extends Controller
{
    /**
     * Store a newly created mentorship request in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate Form Data (Unit V)
        $validated = $request->validate([
            'mentor_id' => 'required|exists:mentors,id',
            'message'   => 'required|string|min:20|max:1000',
        ]);

        // 2. Security Check: Ensure user is logged in as a startup
        if (!$request->session()->has('user_id') || $request->session()->get('user_role') !== 'startup') {
            return redirect()->route('login')->with('error', 'Only startups can send mentorship requests.');
        }

        // 3. Prevent duplicate pending requests to the same mentor
        $startupId = $request->session()->get('user_id');
        
        $existingRequest = MentorshipRequest::where('startup_id', $startupId)
            ->where('mentor_id', $validated['mentor_id'])
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'You have already sent a request to this mentor.');
        }

        // 4. Save to Database (Unit VI)
        $newRequest = MentorshipRequest::create([
            'startup_id' => $startupId,
            'mentor_id'  => $validated['mentor_id'],
            'message'    => $validated['message'],
            'status'     => 'pending',
        ]);

        // 5. Send Email Notification (Syllabus concept implementation)
        $startup = Startup::find($startupId);
        $mentor = Mentor::find($validated['mentor_id']);
        
        // Log the email locally instead of actually sending via SMTP (configured in .env)
        Mail::to($mentor->email)->send(new MentorshipRequestReceived($newRequest, $startup));

        // 6. Redirect back with success message (Unit IV)
        return back()->with('success', 'Your mentorship request has been sent successfully! The mentor has been notified via email.');
    }
}

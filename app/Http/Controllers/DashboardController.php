<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\MentorshipRequest;

/**
 * DashboardController
 *
 * Handles dashboard views for both Startups and Mentors.
 *
 * Demonstrates:
 * - Eloquent Queries with Eager Loading (Unit VI)
 * - Session-based Auth Checks (Unit IV)
 * - Passing Data to Views (Unit II)
 */
class DashboardController extends Controller
{
    /**
     * Mentor Dashboard — View all received mentorship requests.
     * Demonstrates: Eloquent where(), with() eager loading, orderBy (Unit VI)
     */
    public function mentorDashboard(Request $request)
    {
        $mentorId = $request->session()->get('user_id');

        // Fetch all requests addressed to this mentor, with startup details (eager loading)
        $requests = MentorshipRequest::with('startup')
            ->where('mentor_id', $mentorId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->sortBy(function ($req) {
                // Sort: pending first, then approved, then rejected (MongoDB-compatible)
                return match($req->status) {
                    'pending'  => 0,
                    'approved' => 1,
                    'rejected' => 2,
                    default    => 3,
                };
            });

        // Count by status for the summary cards
        $stats = [
            'total'    => $requests->count(),
            'pending'  => $requests->where('status', 'pending')->count(),
            'approved' => $requests->where('status', 'approved')->count(),
            'rejected' => $requests->where('status', 'rejected')->count(),
        ];

        $mentor = Mentor::find($mentorId);
        $mentorStatus = $mentor->status ?? 'approved';

        return view('dashboard.mentor', compact('requests', 'stats', 'mentorStatus'));
    }

    /**
     * Update the status of a mentorship request (approve / reject).
     * Demonstrates: Eloquent findOrFail + update (Unit VI)
     */
    public function updateRequestStatus(Request $request, $id)
    {
        // Validate the incoming status (Unit V)
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $mentorId = $request->session()->get('user_id');

        // Find the request and ensure it belongs to this mentor
        $mentorshipRequest = MentorshipRequest::where('mentor_id', $mentorId)->findOrFail($id);

        // Update status using Eloquent (Unit VI - CRUD update)
        $mentorshipRequest->update([
            'status' => $validated['status'],
        ]);

        $action = $validated['status'] === 'approved' ? 'approved' : 'rejected';

        return back()->with('success', "Mentorship request has been {$action} successfully!");
    }

    /**
     * Startup Dashboard — View all sent mentorship requests and their status.
     * Demonstrates: Eloquent where(), with() eager loading (Unit VI)
     */
    public function startupDashboard(Request $request)
    {
        $startupId = $request->session()->get('user_id');

        // Fetch all requests sent by this startup, with mentor & category details
        $requests = MentorshipRequest::with(['mentor', 'mentor.category'])
            ->where('startup_id', $startupId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Count by status for the summary cards
        $stats = [
            'total'    => $requests->count(),
            'pending'  => $requests->where('status', 'pending')->count(),
            'approved' => $requests->where('status', 'approved')->count(),
            'rejected' => $requests->where('status', 'rejected')->count(),
        ];

        return view('dashboard.startup', compact('requests', 'stats'));
    }
}

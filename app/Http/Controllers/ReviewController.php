<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\MentorshipRequest;

/**
 * ReviewController
 * 
 * Handles storing reviews and ratings.
 * Demonstrates Eloquent CRUD and Form Validation (Unit V & VI).
 */
class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, $mentorId)
    {
        // 1. Form Validation (Unit V)
        $validated = $request->validate([
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:1000',
        ]);

        $startupId = $request->session()->get('user_id');

        // 2. Security Check: Ensure the startup has an APPROVED request with this mentor
        $hasApprovedRequest = MentorshipRequest::where('startup_id', $startupId)
            ->where('mentor_id', $mentorId)
            ->where('status', 'approved')
            ->exists();

        if (!$hasApprovedRequest) {
            return back()->with('error', 'You can only review mentors who have approved your mentorship request.');
        }

        // 3. Prevent Duplicate Reviews
        $existingReview = Review::where('startup_id', $startupId)
            ->where('mentor_id', $mentorId)
            ->exists();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this mentor.');
        }

        // 4. Create the Review (Unit VI)
        Review::create([
            'mentor_id'   => $mentorId,
            'startup_id'  => $startupId,
            'rating'      => $validated['rating'],
            'review_text' => $validated['review_text'],
        ]);

        return back()->with('success', 'Thank you! Your review has been published.');
    }
}

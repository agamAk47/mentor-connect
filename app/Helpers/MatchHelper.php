<?php

namespace App\Helpers;

use App\Models\Mentor;
use App\Models\MentorshipRequest;
use App\Models\Startup;

/**
 * MatchHelper
 *
 * Computes mentor–startup compatibility score (0–100).
 * Demonstrates: Pure PHP business logic (Unit III)
 */
class MatchHelper
{
    /**
     * Calculate match score between a startup and mentor.
     */
    public static function getMatchScore(Startup $startup, Mentor $mentor): int
    {
        $score = 0;

        // 1. Industry alignment (+40 pts)
        $mentor->loadMissing('category');
        $categoryName = strtolower($mentor->category->name ?? '');
        $industry = strtolower($startup->industry ?? '');

        if ($industry !== '' && $categoryName !== '') {
            if ($industry === $categoryName
                || str_contains($categoryName, $industry)
                || str_contains($industry, $categoryName)) {
                $score += 40;
            }
        }

        // 2. Stage suitability (+30 pts)
        $experience = (int) ($mentor->experience ?? 0);
        $stage = strtolower($startup->stage ?? '');

        $stageRanges = [
            'idea'    => [0, 3],
            'mvp'     => [3, 7],
            'growth'  => [7, 15],
            'scale'   => [15, 100],
        ];

        foreach ($stageRanges as $stageKey => [$min, $max]) {
            if (str_contains($stage, $stageKey) && $experience >= $min && $experience < $max) {
                $score += 30;
                break;
            }
        }

        // 3. Activity score — availability signal (+30 pts max)
        $totalRequests = MentorshipRequest::where('mentor_id', $mentor->id)->count();
        if ($totalRequests > 0) {
            $approvedCount = MentorshipRequest::where('mentor_id', $mentor->id)
                ->where('status', 'approved')
                ->count();
            $activityRatio = $approvedCount / $totalRequests;
            $score += (int) min(30, round($activityRatio * 30));
        } else {
            $score += 15; // New mentor — neutral availability
        }

        return min(100, $score);
    }
}

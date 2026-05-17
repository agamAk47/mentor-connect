<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\Category;

/**
 * MentorApiController
 *
 * Demonstrates:
 * - Implementing REST APIs (Unit VI)
 * - JSON Responses
 * - Eloquent ORM with Relationships
 */
class MentorApiController extends Controller
{
    /**
     * Get a list of all approved mentors.
     * Optionally filter by category.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Mentor::with('category')->where('status', 'approved');

        // Optional filtering by category name
        if ($request->has('category')) {
            $categoryName = $request->input('category');
            $category = Category::where('name', $categoryName)->first();
            
            if ($category) {
                $query->where('category_id', $category->id);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Category '{$categoryName}' not found.",
                    'data'    => []
                ], 404);
            }
        }

        $mentors = $query->get();

        return response()->json([
            'success' => true,
            'count'   => $mentors->count(),
            'data'    => $mentors
        ], 200);
    }

    /**
     * Get details of a specific mentor by ID.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $mentor = Mentor::with('category')->find($id);

        if (!$mentor) {
            return response()->json([
                'success' => false,
                'message' => 'Mentor not found'
            ], 404);
        }

        // Hide password hash just in case (already hidden in Model, but good practice)
        $mentor->makeHidden('password');

        return response()->json([
            'success' => true,
            'data'    => $mentor
        ], 200);
    }

    /**
     * Get all categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories()
    {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'count'   => $categories->count(),
            'data'    => $categories
        ], 200);
    }
}

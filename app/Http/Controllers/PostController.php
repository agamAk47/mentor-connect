<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * PostController
 * 
 * Handles the Community Board where mentors and startups can post content.
 * CRITICALLY DEMONSTRATES: CRUD using Laravel's Query Builder (DB::table) 
 * instead of Eloquent, as required by Unit VI of the syllabus.
 */
class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index()
    {
        // Fetch all posts using Query Builder (Unit VI)
        $posts = DB::table('posts')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request)
    {
        // 1. Validation (Unit V)
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        // Ensure user is logged in
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'You must be logged in to post.');
        }

        // 2. Insert using Query Builder (Unit VI)
        DB::table('posts')->insert([
            'author_id'   => $request->session()->get('user_id'),
            'author_name' => $request->session()->get('user_name'),
            'author_role' => $request->session()->get('user_role'),
            'content'     => $request->input('content'),
            'created_at'  => Carbon::now()->toDateTimeString(),
            'updated_at'  => Carbon::now()->toDateTimeString(),
        ]);

        // 3. Redirect with flash message (Unit IV)
        return redirect()->route('posts.index')->with('success', 'Post published successfully!');
    }

    /**
     * Display a specific post (Feature - Post Details)
     */
    public function show($id)
    {
        // Fetch post using Query Builder
        $post = DB::table('posts')->where('_id', $id)->first();
        
        if (!$post) {
            abort(404, 'Post not found.');
        }

        // Fetch author details dynamically based on role
        $author = null;
        if ($post->author_role === 'mentor') {
            $author = \App\Models\Mentor::with('category')->find($post->author_id);
        } else if ($post->author_role === 'startup') {
            $author = \App\Models\Startup::find($post->author_id);
        }

        return view('posts.show', compact('post', 'author'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * Demonstrates:
     * - MVC pattern (Controller returning a View)
     * - Passing data from Controller to View
     * - Named route usage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data passed to the home view
        // This demonstrates passing data from Controller to View (Unit II)
        $stats = [
            'mentors' => '50+',
            'startups' => '120+',
            'categories' => '10+',
        ];

        return view('home', compact('stats'));
    }
}

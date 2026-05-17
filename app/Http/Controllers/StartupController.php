<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\MentorshipRequest;

class StartupController extends Controller
{
    /**
     * Display the specified startup's profile.
     */
    public function show($id)
    {
        $startup = Startup::findOrFail($id);
        $requestCount = MentorshipRequest::where('startup_id', $id)->count();

        return view('startups.show', compact('startup', 'requestCount'));
    }
}

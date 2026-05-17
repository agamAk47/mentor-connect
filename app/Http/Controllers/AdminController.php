<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\MentorshipRequest;
use App\Models\Review;
use App\Models\Startup;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * AdminController
 *
 * Handles admin panel: moderation, statistics, and platform management.
 * Demonstrates: Eloquent CRUD, Query Builder, aggregation (Unit VI)
 */
class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_mentors'    => Mentor::count(),
            'pending_mentors'  => Mentor::where('status', 'pending')->count(),
            'total_startups'   => Startup::count(),
            'total_requests'   => MentorshipRequest::count(),
            'pending_requests' => MentorshipRequest::where('status', 'pending')->count(),
            'total_posts'      => DB::table('posts')->count(),
            'recent_mentors'   => Mentor::orderBy('created_at', 'desc')->limit(5)->get(),
            'recent_requests'  => MentorshipRequest::with(['mentor', 'startup'])->orderBy('created_at', 'desc')->limit(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function mentors(Request $request)
    {
        $sorted = Mentor::with('category')
            ->orderBy('created_at', 'desc')
            ->get()
            ->sortBy(fn ($m) => match ($m->status) {
                'pending'  => 0,
                'approved' => 1,
                'rejected' => 2,
                default    => 3,
            })
            ->values();

        $page = (int) $request->get('page', 1);
        $perPage = 15;
        $mentors = new LengthAwarePaginator(
            $sorted->forPage($page, $perPage),
            $sorted->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.mentors', compact('mentors'));
    }

    public function approveMentor($id)
    {
        Mentor::findOrFail($id)->update(['status' => 'approved']);

        return back()->with('success', 'Mentor approved successfully.');
    }

    public function rejectMentor($id)
    {
        Mentor::findOrFail($id)->update(['status' => 'rejected']);

        return back()->with('warning', 'Mentor registration rejected.');
    }

    public function deleteMentor($id)
    {
        Review::where('mentor_id', $id)->delete();
        MentorshipRequest::where('mentor_id', $id)->delete();
        Mentor::findOrFail($id)->delete();

        return back()->with('success', 'Mentor and associated data deleted.');
    }

    public function startups()
    {
        $startups = Startup::orderBy('created_at', 'desc')->paginate(15);

        $countsMap = [];
        foreach (MentorshipRequest::all() as $req) {
            $sid = (string) $req->startup_id;
            $countsMap[$sid] = ($countsMap[$sid] ?? 0) + 1;
        }

        return view('admin.startups', compact('startups', 'countsMap'));
    }

    public function deleteStartup($id)
    {
        MentorshipRequest::where('startup_id', $id)->delete();
        Review::where('startup_id', $id)->delete();
        Startup::findOrFail($id)->delete();

        return back()->with('success', 'Startup and associated data deleted.');
    }

    public function requests(Request $request)
    {
        $query = MentorshipRequest::with(['mentor', 'startup'])->orderBy('created_at', 'desc');

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(15);

        return view('admin.requests', compact('requests'));
    }

    public function posts(Request $request)
    {
        $query = DB::table('posts')->orderBy('created_at', 'desc');

        if ($request->filled('role') && in_array($request->role, ['mentor', 'startup'])) {
            $query->where('author_role', $request->role);
        }

        $posts = $query->paginate(20);

        return view('admin.posts', compact('posts'));
    }

    public function deletePost($id)
    {
        DB::table('posts')->where('_id', new \MongoDB\BSON\ObjectId($id))->delete();

        return back()->with('success', 'Post deleted successfully.');
    }

    public function statistics()
    {
        $mentors = Mentor::all();

        // Mentor registration trend — last 6 months (Unit VI)
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('M Y'));
        }

        $mentorTrend = [];
        $mentorTrendLabels = [];
        foreach ($months as $monthLabel) {
            $mentorTrendLabels[] = $monthLabel;
            $count = $mentors->filter(function ($m) use ($monthLabel) {
                if (!$m->created_at) {
                    return false;
                }
                return Carbon::parse($m->created_at)->format('M Y') === $monthLabel;
            })->count();
            $mentorTrend[] = $count;
        }

        $requestStatus = [
            'pending'  => MentorshipRequest::where('status', 'pending')->count(),
            'approved' => MentorshipRequest::where('status', 'approved')->count(),
            'rejected' => MentorshipRequest::where('status', 'rejected')->count(),
        ];

        $mentorStatus = [
            'pending'  => Mentor::where('status', 'pending')->count(),
            'approved' => Mentor::where('status', 'approved')->count(),
            'rejected' => Mentor::where('status', 'rejected')->count(),
        ];

        // Top 5 categories by mentor count
        $categoryCounts = [];
        foreach (Category::all() as $category) {
            $count = Mentor::where('category_id', $category->id)->count();
            $categoryCounts[$category->name] = ($categoryCounts[$category->name] ?? 0) + $count;
        }
        arsort($categoryCounts);
        $topCategories = array_slice($categoryCounts, 0, 5, true);

        // Top 5 most-requested mentors
        $mentorRequestCounts = [];
        foreach (MentorshipRequest::all() as $req) {
            $mid = (string) $req->mentor_id;
            $mentorRequestCounts[$mid] = ($mentorRequestCounts[$mid] ?? 0) + 1;
        }
        arsort($mentorRequestCounts);
        $topMentorIds = array_slice(array_keys($mentorRequestCounts), 0, 5);
        $topMentors = [];
        foreach ($topMentorIds as $mid) {
            $mentor = Mentor::find($mid);
            if ($mentor) {
                $topMentors[$mentor->name] = $mentorRequestCounts[$mid];
            }
        }

        $chartData = [
            'mentorTrendLabels' => $mentorTrendLabels,
            'mentorTrend'       => $mentorTrend,
            'requestStatus'     => $requestStatus,
            'mentorStatus'      => $mentorStatus,
            'topCategories'     => $topCategories,
            'topMentors'        => $topMentors,
            'totals'            => [
                'mentors'  => Mentor::count(),
                'startups' => Startup::count(),
                'requests' => MentorshipRequest::count(),
                'posts'    => DB::table('posts')->count(),
            ],
        ];

        return view('admin.statistics', compact('chartData'));
    }
}

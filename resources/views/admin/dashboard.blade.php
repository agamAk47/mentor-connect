@extends('layouts.admin')

@section('title', 'Admin Dashboard | MentorConnect')
@section('page_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/40 shadow-sm">
        <p class="text-sm text-slate-500">Total Mentors</p>
        <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total_mentors'] }}</p>
    </div>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border {{ $stats['pending_mentors'] > 0 ? 'border-orange-400 ring-2 ring-orange-200 shadow-lg' : 'border-white/40' }} shadow-sm">
        <p class="text-sm text-slate-500">Pending Mentor Approvals</p>
        <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['pending_mentors'] }}</p>
        @if($stats['pending_mentors'] > 0)
            <a href="{{ route('admin.mentors') }}" class="inline-flex mt-3 text-sm font-semibold text-orange-600">Review Now →</a>
        @endif
    </div>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/40 shadow-sm">
        <p class="text-sm text-slate-500">Total Startups</p>
        <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total_startups'] }}</p>
    </div>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/40 shadow-sm">
        <p class="text-sm text-slate-500">Total Requests</p>
        <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total_requests'] }}</p>
    </div>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/40 shadow-sm">
        <p class="text-sm text-slate-500">Pending Requests</p>
        <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['pending_requests'] }}</p>
    </div>
    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-6 border border-white/40 shadow-sm">
        <p class="text-sm text-slate-500">Community Posts</p>
        <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total_posts'] }}</p>
    </div>
</div>

<div class="flex flex-wrap gap-3 mb-8">
    <a href="{{ route('admin.mentors') }}" class="px-5 py-2.5 bg-teal-600 text-white rounded-xl text-sm font-semibold hover:bg-teal-700">Approve Mentors</a>
    <a href="{{ route('admin.posts') }}" class="px-5 py-2.5 bg-white border-2 border-teal-200 text-teal-700 rounded-xl text-sm font-semibold">Moderate Posts</a>
    <a href="{{ route('admin.statistics') }}" class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-semibold">View Statistics</a>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h2 class="font-bold text-slate-900 mb-4">Recent Mentors</h2>
        @forelse($stats['recent_mentors'] as $mentor)
            <div class="flex items-center gap-3 border-l-2 border-teal-500 pl-4 mb-4">
                <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center font-bold text-teal-700">{{ strtoupper(substr($mentor->name, 0, 1)) }}</div>
                <div>
                    <p class="font-medium">{{ $mentor->name }}</p>
                    <p class="text-xs text-slate-500">{{ $mentor->email }} · {{ ucfirst($mentor->status ?? 'pending') }}</p>
                </div>
            </div>
        @empty
            <p class="text-sm text-slate-500">No mentors yet.</p>
        @endforelse
    </div>
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h2 class="font-bold text-slate-900 mb-4">Recent Requests</h2>
        @forelse($stats['recent_requests'] as $req)
            <div class="border-l-2 border-indigo-500 pl-4 mb-4">
                <p class="font-medium">{{ $req->startup->startup_name ?? 'Startup' }} → {{ $req->mentor->name ?? 'Mentor' }}</p>
                <p class="text-xs text-slate-500">{{ ucfirst($req->status) }}</p>
            </div>
        @empty
            <p class="text-sm text-slate-500">No requests yet.</p>
        @endforelse
    </div>
</div>
@endsection

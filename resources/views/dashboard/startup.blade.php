@extends('layouts.app')

@section('title', 'Startup Dashboard | MentorConnect')

@section('styles')
<style>
    .dot-grid-bg {
        background-color: #F8FAFC;
        background-image: radial-gradient(circle, #CBD5E1 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .sidebar-link-active {
        background: rgba(13, 148, 136, 0.1);
        color: #0D9488;
        border-color: #0D9488;
    }
</style>
@endsection

@section('content')

@php
    $userInitials = strtoupper(collect(explode(' ', session('user_name', 'U')))->map(fn($w) => substr($w, 0, 1))->take(2)->join(''));
@endphp

<section class="dot-grid-bg min-h-[calc(100vh-5rem)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
        <div class="flex gap-8">

            {{-- Desktop Sidebar --}}
            <aside class="hidden lg:flex flex-col w-64 flex-shrink-0">
                <div class="glass-card rounded-2xl p-4 sticky top-24 shadow-sm">
                    <div class="flex items-center gap-3 px-3 py-3 mb-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center text-white font-bold text-sm shadow-md">
                            {{ $userInitials }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-heading truncate">{{ session('user_name') }}</p>
                            <p class="text-xs text-primary-600 font-semibold">Startup</p>
                        </div>
                    </div>
                    <nav class="space-y-1" aria-label="Dashboard navigation">
                        <a href="{{ route('dashboard.startup') }}" class="sidebar-link-active flex items-center gap-3 px-3 py-2.5 text-sm font-semibold rounded-xl border-l-2 border-primary-600 transition-all">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('mentors.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-body hover:text-primary-600 hover:bg-primary-50 rounded-xl border-l-2 border-transparent transition-all">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            Browse Mentors
                        </a>
                        <a href="{{ route('messages.inbox') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-body hover:text-primary-600 hover:bg-primary-50 rounded-xl border-l-2 border-transparent transition-all">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            Inbox
                        </a>
                        <a href="#my-requests" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-body hover:text-primary-600 hover:bg-primary-50 rounded-xl border-l-2 border-transparent transition-all">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            My Requests
                        </a>
                        <a href="{{ route('posts.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-body hover:text-primary-600 hover:bg-primary-50 rounded-xl border-l-2 border-transparent transition-all">
                            <i data-lucide="messages-square" class="w-4 h-4"></i>
                            Community
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-body hover:text-primary-600 hover:bg-primary-50 rounded-xl border-l-2 border-transparent transition-all">
                            <i data-lucide="user-circle" class="w-4 h-4"></i>
                            Profile
                        </a>
                    </nav>
                </div>
            </aside>

            {{-- Main Content --}}
            <div class="flex-1 min-w-0">

                {{-- Mobile quick nav --}}
                <div class="lg:hidden flex gap-2 overflow-x-auto pb-4 mb-2">
                    <a href="{{ route('dashboard.startup') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-semibold rounded-full bg-primary-600 text-white">Dashboard</a>
                    <a href="{{ route('mentors.index') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Mentors</a>
                    <a href="{{ route('messages.inbox') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Inbox</a>
                    <a href="#my-requests" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Requests</a>
                    <a href="{{ route('posts.index') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Community</a>
                    <a href="{{ route('profile.edit') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Profile</a>
                </div>

                {{-- Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 animate-fade-in-up">
                    <div>
                        <h1 class="text-3xl font-bold text-heading mb-2">
                            Welcome, <span class="gradient-text">{{ session('user_name') }}</span>
                        </h1>
                        <p class="text-body text-sm">Track the status of your mentorship requests.</p>
                    </div>
                    <a href="{{ route('mentors.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-lg shadow-primary-600/25 hover:shadow-primary-600/40 hover:scale-[1.02] transition-all btn-shine text-sm">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Browse Mentors
                    </a>
                </div>

                {{-- Glass Stat Cards --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10 animate-fade-in-up-delay-1">
                    <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-primary-600">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="send" class="w-5 h-5 text-primary-600"></i>
                            </div>
                            <span class="text-xs font-semibold text-body uppercase tracking-wider">Sent</span>
                        </div>
                        <p class="text-2xl font-bold text-heading">{{ $stats['total'] }}</p>
                    </div>
                    <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-amber-500">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="clock" class="w-5 h-5 text-amber-500"></i>
                            </div>
                            <span class="text-xs font-semibold text-body uppercase tracking-wider">Pending</span>
                        </div>
                        <p class="text-2xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-emerald-500">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i>
                            </div>
                            <span class="text-xs font-semibold text-body uppercase tracking-wider">Approved</span>
                        </div>
                        <p class="text-2xl font-bold text-emerald-600">{{ $stats['approved'] }}</p>
                    </div>
                    <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-red-500">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="x-circle" class="w-5 h-5 text-red-500"></i>
                            </div>
                            <span class="text-xs font-semibold text-body uppercase tracking-wider">Rejected</span>
                        </div>
                        <p class="text-2xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
                    </div>
                </div>

                {{-- Requests Timeline --}}
                <div id="my-requests" class="animate-fade-in-up-delay-2 scroll-mt-24">
                    <h2 class="text-lg font-bold text-heading mb-4 flex items-center gap-2">
                        <i data-lucide="git-branch" class="w-5 h-5 text-primary-600"></i>
                        Your Mentorship Requests
                    </h2>

                    @if($requests->isEmpty())
                        <div class="glass-card rounded-2xl p-12 text-center shadow-sm">
                            <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="send" class="w-8 h-8 text-primary-500"></i>
                            </div>
                            <h3 class="text-lg font-bold text-heading mb-2">No requests sent yet</h3>
                            <p class="text-body text-sm mb-6 max-w-sm mx-auto">Start by browsing our mentor directory and sending your first request!</p>
                            <a href="{{ route('mentors.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-lg text-sm btn-shine transition-all">
                                <i data-lucide="search" class="w-4 h-4"></i>
                                Find a Mentor
                            </a>
                        </div>
                    @else
                        <div class="relative">
                            <div class="absolute left-[23px] top-6 bottom-6 w-0.5 bg-gray-200 hidden sm:block" aria-hidden="true"></div>

                            @foreach($requests as $req)
                                @php
                                    $statusBar = match($req->status) {
                                        'pending'  => 'border-l-amber-500',
                                        'approved' => 'border-l-emerald-500',
                                        default    => 'border-l-red-500',
                                    };
                                    $statusBadge = match($req->status) {
                                        'pending'  => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        default    => 'bg-red-50 text-red-700 border-red-200',
                                    };
                                    $dotColor = match($req->status) {
                                        'pending'  => 'bg-amber-400',
                                        'approved' => 'bg-emerald-500',
                                        default    => 'bg-red-500',
                                    };
                                @endphp
                                <div class="relative pl-0 sm:pl-12 pb-6 last:pb-0">
                                    <div class="hidden sm:flex absolute left-3 top-8 w-5 h-5 rounded-full border-2 border-white shadow-md items-center justify-center z-10 {{ $dotColor }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                    </div>

                                    <div class="glass-card rounded-2xl shadow-sm overflow-hidden border-l-4 {{ $statusBar }} hover-lift">
                                        <div class="p-6">
                                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                                <div class="flex items-start gap-4 flex-1">
                                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-secondary flex items-center justify-center text-white font-bold text-lg flex-shrink-0 shadow-sm">
                                                        {{ strtoupper(substr($req->mentor->name ?? 'M', 0, 1)) }}
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                                                            <h3 class="font-bold text-heading">{{ $req->mentor->name ?? 'Unknown Mentor' }}</h3>
                                                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full border {{ $statusBadge }}">
                                                                {{ ucfirst($req->status) }}
                                                            </span>
                                                        </div>
                                                        <p class="text-xs text-body mb-3">
                                                            <span class="font-medium text-heading">{{ $req->mentor->expertise ?? 'N/A' }}</span>
                                                            @if($req->mentor->category)
                                                                · {{ $req->mentor->category->name }}
                                                            @endif
                                                            · {{ $req->mentor->experience ?? 0 }} yrs experience
                                                        </p>
                                                        <div class="bg-white/60 rounded-xl p-4 border border-gray-100/80 border-l-2 border-l-primary-200">
                                                            <p class="text-xs font-semibold text-body uppercase tracking-wider mb-1 flex items-center gap-1">
                                                                <i data-lucide="message-square-quote" class="w-3 h-3 text-primary-600"></i>
                                                                Your Message
                                                            </p>
                                                            <p class="text-sm text-body leading-relaxed">{!! nl2br(e($req->message)) !!}</p>
                                                        </div>
                                                        <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                                            <i data-lucide="calendar" class="w-3 h-3"></i>
                                                            Sent {{ $req->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="flex-shrink-0 flex flex-col gap-2.5 sm:min-w-[210px]">
                                                    <a href="{{ route('mentors.show', $req->mentor->id) }}" class="group w-full px-4 py-2.5 bg-[#F8F7FF] text-[#5A45D1] font-bold text-[13px] rounded-xl hover:bg-indigo-50 border border-[#E2DFF6] transition-all flex items-center justify-between shadow-xs">
                                                        <i data-lucide="user" class="w-4 h-4 text-[#5A45D1]"></i>
                                                        <span class="flex-1 text-center">View Profile</span>
                                                        <i data-lucide="chevron-right" class="w-4 h-4 text-[#5A45D1] transition-transform group-hover:translate-x-1"></i>
                                                    </a>
                                                    @if($req->status === 'approved')
                                                        <a href="{{ route('messages.index', ['receiverType' => 'mentor', 'receiverId' => $req->mentor->id]) }}" class="group w-full px-4 py-2.5 bg-gradient-to-r from-[#594CE5] via-[#A852B2] to-[#FB7B44] text-white font-bold text-[13px] rounded-xl hover:opacity-90 shadow-sm shadow-[#594CE5]/20 transition-all flex items-center justify-between border border-transparent">
                                                            <i data-lucide="message-circle" class="w-4 h-4 text-white"></i>
                                                            <span class="flex-1 text-center">Message</span>
                                                            <i data-lucide="chevron-right" class="w-4 h-4 text-white transition-transform group-hover:translate-x-1"></i>
                                                        </a>
                                                        <a href="mailto:{{ $req->mentor->email }}" class="group w-full px-4 py-2.5 bg-[#F4F8FE] text-[#1D54CB] font-bold text-[13px] rounded-xl hover:bg-blue-50 border border-[#D5E4F8] transition-all flex items-center justify-between shadow-xs">
                                                            <i data-lucide="mail" class="w-4 h-4 text-[#1D54CB]"></i>
                                                            <span class="flex-1 text-center truncate px-2 max-w-[140px]">{{ $req->mentor->email }}</span>
                                                            <i data-lucide="chevron-right" class="w-4 h-4 text-[#1D54CB] transition-transform group-hover:translate-x-1"></i>
                                                        </a>
                                                        <a href="{{ route('mentors.show', $req->mentor->id) }}#reviews" class="group w-full px-4 py-2.5 bg-[#FFFBF0] text-[#D89311] font-bold text-[13px] rounded-xl hover:bg-yellow-50 border border-[#FBE5B4] transition-all flex items-center justify-between shadow-xs">
                                                            <i data-lucide="star" class="w-4 h-4 text-[#D89311]"></i>
                                                            <span class="flex-1 text-center">Rate Mentor</span>
                                                            <i data-lucide="chevron-right" class="w-4 h-4 text-[#D89311] transition-transform group-hover:translate-x-1"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

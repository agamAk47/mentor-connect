@extends('layouts.app')

@section('title', 'Mentor Dashboard | MentorConnect')

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
                            <p class="text-xs text-primary-600 font-semibold">Mentor</p>
                        </div>
                    </div>
                    <nav class="space-y-1" aria-label="Dashboard navigation">
                        <a href="{{ route('dashboard.mentor') }}" class="sidebar-link-active flex items-center gap-3 px-3 py-2.5 text-sm font-semibold rounded-xl border-l-2 border-primary-600 transition-all">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('messages.inbox') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-body hover:text-primary-600 hover:bg-primary-50 rounded-xl border-l-2 border-transparent transition-all">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            Inbox
                        </a>

                        <a href="#mentorship-requests" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-body hover:text-primary-600 hover:bg-primary-50 rounded-xl border-l-2 border-transparent transition-all">
                            <i data-lucide="inbox" class="w-4 h-4"></i>
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

            <div class="flex-1 min-w-0">

                <div class="lg:hidden flex gap-2 overflow-x-auto pb-4 mb-2">
                    <a href="{{ route('dashboard.mentor') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-semibold rounded-full bg-primary-600 text-white">Dashboard</a>
                    <a href="{{ route('messages.inbox') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Inbox</a>
                    <a href="#mentorship-requests" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Requests</a>
                    <a href="{{ route('posts.index') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Community</a>
                    <a href="{{ route('profile.edit') }}" class="flex-shrink-0 px-3 py-1.5 text-xs font-medium rounded-full glass-card text-body">Profile</a>
                </div>

                {{-- Mentor status banner --}}
                @if($mentorStatus === 'pending')
                    <div class="mb-6 glass-card rounded-2xl border-l-4 border-amber-500 bg-amber-50/80 p-5 flex items-start gap-4 animate-fade-in-up">
                        <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-amber-900 mb-1">Account Pending Approval</h3>
                            <p class="text-sm text-amber-800/90">Your mentor profile is under review. You can view requests, but startups may not see you in search until approved.</p>
                        </div>
                    </div>
                @elseif($mentorStatus === 'rejected')
                    <div class="mb-6 glass-card rounded-2xl border-l-4 border-red-500 bg-red-50/80 p-5 flex items-start gap-4 animate-fade-in-up">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-red-900 mb-1">Application Not Approved</h3>
                            <p class="text-sm text-red-800/90">Your mentor application was not approved. Please contact support or update your profile for reconsideration.</p>
                        </div>
                    </div>
                @endif

                <div class="mb-8 animate-fade-in-up">
                    <h1 class="text-3xl font-bold text-heading mb-2">
                        Welcome, <span class="gradient-text">{{ session('user_name') }}</span>
                    </h1>
                    <p class="text-body text-sm">Manage your incoming mentorship requests from startups.</p>
                </div>

                {{-- Glass Stats --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10 animate-fade-in-up-delay-1">
                    <div class="glass-card rounded-2xl p-5 shadow-sm border-l-4 border-primary-600">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center">
                                <i data-lucide="inbox" class="w-5 h-5 text-primary-600"></i>
                            </div>
                            <span class="text-xs font-semibold text-body uppercase tracking-wider">Total</span>
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

                {{-- Request cards --}}
                <div id="mentorship-requests" class="animate-fade-in-up-delay-2 scroll-mt-24">
                    <h2 class="text-lg font-bold text-heading mb-4 flex items-center gap-2">
                        <i data-lucide="mail" class="w-5 h-5 text-primary-600"></i>
                        Mentorship Requests
                    </h2>

                    @if($requests->isEmpty())
                        <div class="glass-card rounded-2xl p-12 text-center shadow-sm">
                            <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="inbox" class="w-8 h-8 text-primary-500"></i>
                            </div>
                            <h3 class="text-lg font-bold text-heading mb-2">No requests yet</h3>
                            <p class="text-body text-sm">When startups send you mentorship requests, they will appear here.</p>
                        </div>
                    @else
                        <div class="space-y-4">
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
                                @endphp
                                <div class="glass-card rounded-2xl shadow-sm overflow-hidden border-l-4 {{ $statusBar }} card-hover">
                                    <div class="p-6">
                                        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-5">
                                            <div class="flex items-start gap-4 flex-1 min-w-0">
                                                <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center text-white font-bold text-lg flex-shrink-0 shadow-sm">
                                                    {{ strtoupper(substr($req->startup->startup_name ?? 'S', 0, 1)) }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                                                        <h3 class="font-bold text-heading text-lg">{{ $req->startup->startup_name ?? 'Unknown Startup' }}</h3>
                                                        @if($req->startup->stage)
                                                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                                                                {{ $req->startup->stage }}
                                                            </span>
                                                        @endif
                                                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full border {{ $statusBadge }}">
                                                            {{ ucfirst($req->status) }}
                                                        </span>
                                                    </div>
                                                    <p class="text-xs text-body mb-3">
                                                        Founded by <span class="font-medium text-heading">{{ $req->startup->founder_name ?? 'N/A' }}</span>
                                                        @if($req->startup->industry)
                                                            · {{ $req->startup->industry }}
                                                        @endif
                                                    </p>
                                                    <div class="bg-white/70 rounded-xl p-4 border border-gray-100 border-l-4 border-l-primary-300">
                                                        <p class="text-xs font-semibold text-primary-700 uppercase tracking-wider mb-2 flex items-center gap-1">
                                                            <i data-lucide="quote" class="w-3.5 h-3.5"></i>
                                                            Message from startup
                                                        </p>
                                                        <p class="text-sm text-body leading-relaxed italic">{!! nl2br(e($req->message)) !!}</p>
                                                    </div>
                                                    <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                                        <i data-lucide="calendar" class="w-3 h-3"></i>
                                                        Received {{ $req->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex flex-col gap-2.5 flex-shrink-0 sm:min-w-[210px]">
                                                <a href="{{ route('startups.show', $req->startup->id) }}" class="group w-full px-4 py-2.5 bg-[#F8F7FF] text-[#5A45D1] font-bold text-[13px] rounded-xl hover:bg-indigo-50 border border-[#E2DFF6] transition-all flex items-center justify-between shadow-xs">
                                                    <i data-lucide="building-2" class="w-4 h-4 text-[#5A45D1]"></i>
                                                    <span class="flex-1 text-center">View Startup</span>
                                                    <i data-lucide="chevron-right" class="w-4 h-4 text-[#5A45D1] transition-transform group-hover:translate-x-1"></i>
                                                </a>
                                                @if($req->status === 'pending')
                                                    <form action="{{ route('requests.update', $req->id) }}" method="POST" class="w-full">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="group w-full px-4 py-2.5 bg-[#E6F8EF] text-[#0BC060] font-bold text-[13px] rounded-xl hover:bg-green-50 border border-[#bbf7d0] transition-all flex items-center justify-between shadow-xs">
                                                            <i data-lucide="check" class="w-4 h-4 text-[#0BC060]"></i>
                                                            <span class="flex-1 text-center">Approve</span>
                                                            <i data-lucide="chevron-right" class="w-4 h-4 text-[#0BC060] transition-transform group-hover:translate-x-1"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('requests.update', $req->id) }}" method="POST" class="w-full">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="group w-full px-4 py-2.5 bg-red-50 text-red-600 font-bold text-[13px] rounded-xl hover:bg-red-100 border border-red-200 transition-all flex items-center justify-between shadow-xs">
                                                            <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                                                            <span class="flex-1 text-center">Reject</span>
                                                            <i data-lucide="chevron-right" class="w-4 h-4 text-red-500 transition-transform group-hover:translate-x-1"></i>
                                                        </button>
                                                    </form>
                                                @elseif($req->status === 'approved')
                                                    <a href="{{ route('messages.index', ['receiverType' => 'startup', 'receiverId' => $req->startup->id]) }}" class="group w-full px-4 py-2.5 bg-gradient-to-r from-[#594CE5] via-[#A852B2] to-[#FB7B44] text-white font-bold text-[13px] rounded-xl hover:opacity-90 shadow-sm shadow-[#594CE5]/20 transition-all flex items-center justify-between border border-transparent">
                                                        <i data-lucide="message-circle" class="w-4 h-4 text-white"></i>
                                                        <span class="flex-1 text-center">Message</span>
                                                        <i data-lucide="chevron-right" class="w-4 h-4 text-white transition-transform group-hover:translate-x-1"></i>
                                                    </a>
                                                    <a href="mailto:{{ $req->startup->email }}" class="group w-full px-4 py-2.5 bg-[#F4F8FE] text-[#1D54CB] font-bold text-[13px] rounded-xl hover:bg-blue-50 border border-[#D5E4F8] transition-all flex items-center justify-between shadow-xs">
                                                        <i data-lucide="mail" class="w-4 h-4 text-[#1D54CB]"></i>
                                                        <span class="flex-1 text-center truncate px-2 max-w-[140px]">{{ $req->startup->email }}</span>
                                                        <i data-lucide="chevron-right" class="w-4 h-4 text-[#1D54CB] transition-transform group-hover:translate-x-1"></i>
                                                    </a>
                                                @endif
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

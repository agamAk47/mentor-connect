@extends('layouts.app')

@section('title', 'Inbox | MentorConnect')

@section('content')
<section class="bg-surface min-h-[calc(100vh-5rem)] py-8 lg:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8 animate-fade-in-up">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-heading flex items-center gap-3">
                    <i data-lucide="inbox" class="w-8 h-8 text-primary-600"></i>
                    Your Inbox
                </h1>
                <p class="text-body mt-1">Manage your active conversations.</p>
            </div>
            <a href="{{ $currentUserRole === 'startup' ? route('dashboard.startup') : route('dashboard.mentor') }}" class="px-4 py-2 bg-white text-gray-700 font-semibold text-sm rounded-xl hover:bg-gray-50 border border-gray-200 transition-all flex items-center gap-2 shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Dashboard
            </a>
        </div>

        <div class="glass-card rounded-2xl shadow-xl shadow-primary-500/5 overflow-hidden animate-fade-in-up-delay-1">
            @if($conversations->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="message-square" class="w-8 h-8 text-primary-500"></i>
                    </div>
                    <h3 class="text-lg font-bold text-heading mb-2">No conversations yet</h3>
                    <p class="text-body max-w-md mx-auto">Your inbox is currently empty. @if($currentUserRole === 'startup') Start a conversation with an approved mentor from your dashboard. @else Startups will appear here once you approve their requests and they send a message. @endif</p>
                </div>
            @else
                <div class="divide-y divide-gray-100">
                    @foreach($conversations as $convo)
                        <a href="{{ route('messages.index', ['receiverType' => $convo['otherType'], 'receiverId' => $convo['otherId']]) }}" class="flex items-start gap-4 p-5 hover:bg-gray-50/50 transition-colors group">
                            <div class="w-12 h-12 rounded-[14px] bg-[#7064E9] flex items-center justify-center text-white font-bold text-lg flex-shrink-0 shadow-sm relative">
                                {{ strtoupper(substr($convo['otherUser']->name ?? $convo['otherUser']->startup_name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h4 class="font-bold text-heading truncate pr-4 group-hover:text-primary-600 transition-colors">
                                        {{ $convo['otherUser']->name ?? $convo['otherUser']->startup_name ?? 'Unknown User' }}
                                    </h4>
                                    <span class="text-xs font-medium text-gray-400 whitespace-nowrap">
                                        {{ $convo['latestMessage']->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 text-sm">
                                    @if($convo['latestMessage']->sender_id == session('user_id') && $convo['latestMessage']->sender_type == $currentUserRole)
                                        <i data-lucide="corner-down-right" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0"></i>
                                    @endif
                                    <p class="text-body truncate font-medium">
                                        {{ $convo['latestMessage']->content }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</section>
@endsection

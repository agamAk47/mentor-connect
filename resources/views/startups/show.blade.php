@extends('layouts.app')

@section('title', $startup->startup_name . ' - Startup Profile | MentorConnect')
@section('meta_description', 'View ' . $startup->startup_name . ' startup profile on MentorConnect.')

@section('content')
<section class="bg-surface min-h-screen py-12 bg-[radial-gradient(circle,_#94a3b8_1px,_transparent_1px)] bg-[length:28px_28px]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex text-sm text-body mb-8" aria-label="Breadcrumb">
            <a href="{{ session('user_role') === 'mentor' ? route('dashboard.mentor') : route('dashboard.startup') }}" class="hover:text-primary-600">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="font-semibold text-heading">{{ $startup->startup_name }}</span>
        </nav>

        <div class="glass-card rounded-2xl overflow-hidden shadow-xl mb-8">
            <div class="h-28 bg-gradient-to-r from-teal-600 via-indigo-500 to-orange-500"></div>
            <div class="px-8 pb-8 -mt-12 relative">
                <div class="flex flex-col sm:flex-row sm:items-end gap-6">
                    <div class="w-24 h-24 rounded-2xl gradient-bg flex items-center justify-center text-white font-black text-3xl shadow-lg border-4 border-white">
                        {{ strtoupper(substr($startup->startup_name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl font-black text-heading">{{ $startup->startup_name }}</h1>
                        <p class="text-primary-600 font-medium flex items-center gap-2 mt-1">
                            <i data-lucide="user" class="w-4 h-4"></i> {{ $startup->founder_name }}
                        </p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            @if($startup->industry)
                                <span class="px-3 py-1 bg-teal-50 text-teal-700 rounded-full text-xs font-semibold flex items-center gap-1">
                                    <i data-lucide="building-2" class="w-3 h-3"></i> {{ $startup->industry }}
                                </span>
                            @endif
                            @if($startup->stage)
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-semibold flex items-center gap-1">
                                    <i data-lucide="trending-up" class="w-3 h-3"></i> {{ $startup->stage }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-center bg-white/60 backdrop-blur-md rounded-xl px-6 py-4 border border-white/40">
                        <p class="text-2xl font-black text-teal-600">{{ $requestCount ?? 0 }}</p>
                        <p class="text-xs text-body font-medium">Mentorship Requests</p>
                    </div>
                </div>
            </div>
        </div>

        @if($startup->problem_statement)
            <div class="glass-card rounded-2xl p-8 mb-8 border-l-4 border-teal-500">
                <h3 class="text-sm font-bold text-heading uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i data-lucide="target" class="w-4 h-4 text-teal-600"></i> Problem Statement
                </h3>
                <blockquote class="text-body leading-relaxed italic border-l-2 border-teal-200 pl-4">
                    {!! nl2br(e($startup->problem_statement)) !!}
                </blockquote>
            </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

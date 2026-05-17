@extends('layouts.app')

@section('title', 'Browse Mentors | MentorConnect')

@section('content')

    <section class="bg-surface min-h-screen py-10 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-full mb-4">
                    <i data-lucide="search" class="w-4 h-4 text-primary-600"></i>
                    <span class="text-xs font-semibold text-primary-700 uppercase tracking-wider">Mentor Directory</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold text-heading mb-3">
                    Find Your <span class="gradient-text">Mentor</span>
                </h1>
                <p class="text-body text-lg max-w-2xl">
                    Browse curated industry experts. Filter by category and discover your best match.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">

                <aside class="w-full lg:w-72 flex-shrink-0 animate-fade-in-up-delay-1">
                    <div class="glass-card rounded-2xl p-6 sticky top-24 shadow-xl shadow-primary-500/5">
                        <h3 class="text-sm font-bold text-heading uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i data-lucide="filter" class="w-4 h-4 text-primary-600"></i>
                            Categories
                        </h3>

                        <nav class="space-y-1">
                            <a href="{{ route('mentors.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ empty($selectedCategory) ? 'bg-primary-50 text-primary-700 font-semibold border border-primary-100' : 'text-body hover:bg-white/60 hover:text-heading font-medium' }} text-sm transition-all group">
                                <i data-lucide="layout-grid" class="w-4 h-4 {{ empty($selectedCategory) ? 'text-primary-600' : 'text-gray-400 group-hover:text-primary-500' }}"></i>
                                All Categories
                            </a>

                            @foreach($categories as $category)
                                @php
                                    $isActive = $selectedCategory == $category->id;
                                @endphp
                                <a href="{{ route('mentors.index', ['category' => $category->id]) }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl {{ $isActive ? 'bg-primary-50 text-primary-700 font-semibold border border-primary-100' : 'text-body hover:bg-white/60 hover:text-heading font-medium' }} text-sm transition-all group">
                                    <i data-lucide="{{ $category->icon ?? 'circle' }}" class="w-4 h-4 {{ $isActive ? 'text-primary-600' : 'text-gray-400 group-hover:text-primary-500' }}"></i>
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>

                <div class="flex-1">
                    <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @forelse($mentors as $index => $mentor)
                            @php
                                $mentorMatch = session('user_role') === 'startup' && isset($matchScores[(string) $mentor->id]);
                                $score = $mentorMatch ? (int) round($matchScores[(string) $mentor->id]) : null;
                                $badgeClass = $score !== null
                                    ? ($score < 40 ? 'bg-red-50 text-red-700 border-red-200' : ($score <= 70 ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-primary-50 text-primary-700 border-primary-200'))
                                    : '';
                            @endphp
                            <article class="glass-card rounded-2xl overflow-hidden hover-lift shadow-lg shadow-primary-500/5 flex flex-col animate-fade-in-up" style="animation-delay: {{ min($index * 0.08, 0.4) }}s">
                                <div class="relative h-28 bg-gradient-to-br from-primary-500 via-secondary to-accent">
                                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 16px 16px;"></div>
                                    @if($mentorMatch)
                                        <span class="absolute top-3 right-3 inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold border backdrop-blur-sm {{ $badgeClass }}">
                                            <i data-lucide="sparkles" class="w-3 h-3"></i>
                                            {{ $score }}% Match
                                        </span>
                                    @endif
                                    <div class="absolute -bottom-10 left-1/2 -translate-x-1/2">
                                        <div class="w-20 h-20 rounded-2xl bg-white p-1 shadow-xl">
                                            <div class="w-full h-full rounded-xl gradient-bg flex items-center justify-center text-white font-bold text-2xl">
                                                {{ strtoupper(substr($mentor->name, 0, 1)) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-14 px-5 pb-5 flex flex-col flex-1 text-center">
                                    <h2 class="text-lg font-bold text-heading mb-0.5">{{ $mentor->name }}</h2>
                                    <p class="text-sm text-primary-600 font-medium mb-3">{{ $mentor->expertise }}</p>

                                    <div class="flex flex-wrap items-center gap-2 text-xs text-body mb-4">
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-white/60">
                                            <i data-lucide="briefcase" class="w-3.5 h-3.5 text-primary-500"></i>
                                            {{ $mentor->experience }} yrs
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-white/60">
                                            <i data-lucide="tag" class="w-3.5 h-3.5 text-secondary"></i>
                                            {{ $mentor->category->name }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-body leading-relaxed line-clamp-3 mb-5 flex-1">
                                        {{ $mentor->bio }}
                                    </p>

                                    <div class="flex items-center gap-2 pt-4 border-t border-gray-200/60">
                                        <a href="{{ route('mentors.show', $mentor->id) }}" class="flex-1 py-2.5 bg-primary-50 text-primary-700 font-semibold rounded-xl hover:bg-primary-100 transition-colors text-sm flex items-center justify-center gap-2">
                                            <i data-lucide="user" class="w-4 h-4"></i>
                                            View Profile
                                        </a>
                                        <a href="{{ route('mentors.show', $mentor->id) }}#request-form" class="flex-1 py-2.5 gradient-bg text-white font-semibold rounded-xl shadow-md shadow-primary-500/20 hover:shadow-primary-500/35 transition-all text-sm flex items-center justify-center gap-2 btn-shine">
                                            <i data-lucide="send" class="w-4 h-4"></i>
                                            Request
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full text-center py-20 glass-card rounded-2xl border border-dashed border-gray-300/80">
                                <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="search-x" class="w-8 h-8 text-primary-400"></i>
                                </div>
                                <h3 class="text-lg font-bold text-heading mb-2">No Mentors Found</h3>
                                <p class="text-body text-sm max-w-sm mx-auto mb-6">
                                    @if($selectedCategory)
                                        No approved mentors in this category yet. Try another filter or browse all mentors.
                                    @else
                                        There are currently no approved mentors on the platform.
                                    @endif
                                </p>
                                @if($selectedCategory)
                                    <a href="{{ route('mentors.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-primary-700 bg-primary-50 rounded-xl hover:bg-primary-100 transition-colors">
                                        <i data-lucide="layout-grid" class="w-4 h-4"></i>
                                        View All Mentors
                                    </a>
                                @endif
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

@extends('layouts.app')

@section('title', 'Community Post | MentorConnect')

@section('content')

@php
    $isMentorAuthor = $post->author_role === 'mentor';
    $chipClass = $isMentorAuthor
        ? 'bg-primary-50 text-primary-700 border-primary-200'
        : 'bg-indigo-50 text-indigo-700 border-indigo-200';
    $authorInitials = strtoupper(collect(explode(' ', $post->author_name))->map(fn($w) => substr($w, 0, 1))->take(2)->join(''));
@endphp

<section class="bg-surface min-h-[calc(100vh-5rem)] py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="flex text-sm text-body mb-8 animate-fade-in-up" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('posts.index') }}" class="hover:text-primary-600 transition-colors flex items-center gap-1"><i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Community</a></li>
                <li><i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i></li>
                <li class="font-semibold text-heading truncate max-w-xs">Post by {{ $post->author_name }}</li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8 animate-fade-in-up-delay-1">

            {{-- Author glass sidebar --}}
            <aside class="lg:w-80 flex-shrink-0 order-2 lg:order-1">
                <div class="glass-card rounded-2xl p-6 shadow-lg border border-white/40 sticky top-24">
                    <div class="text-center mb-5">
                        <div class="w-20 h-20 rounded-2xl mx-auto flex items-center justify-center font-bold text-2xl shadow-md mb-4 ring-2 {{ $isMentorAuthor ? 'bg-primary-100 text-primary-700 ring-primary-200' : 'bg-indigo-100 text-indigo-700 ring-indigo-200' }}">
                            {{ $authorInitials }}
                        </div>
                        <h2 class="text-xl font-bold text-heading mb-1">{{ $post->author_name }}</h2>
                        <span class="inline-block text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider font-semibold border {{ $chipClass }}">
                            {{ $isMentorAuthor ? 'Mentor' : 'Startup' }}
                        </span>
                    </div>

                    @if($author)
                        <div class="space-y-3 pt-4 border-t border-gray-100 text-sm">
                            @if($isMentorAuthor)
                                <div class="flex items-start gap-2 text-body">
                                    <i data-lucide="award" class="w-4 h-4 text-primary-600 flex-shrink-0 mt-0.5"></i>
                                    <span>{{ $author->expertise ?? 'Mentor' }}</span>
                                </div>
                                <div class="flex items-start gap-2 text-body">
                                    <i data-lucide="tag" class="w-4 h-4 text-primary-600 flex-shrink-0 mt-0.5"></i>
                                    <span>{{ $author->category->name ?? 'General' }}</span>
                                </div>
                            @else
                                <div class="flex items-start gap-2 text-body">
                                    <i data-lucide="briefcase" class="w-4 h-4 text-indigo-600 flex-shrink-0 mt-0.5"></i>
                                    <span>{{ $author->industry ?? 'Startup' }}</span>
                                </div>
                                <div class="flex items-start gap-2 text-body">
                                    <i data-lucide="activity" class="w-4 h-4 text-indigo-600 flex-shrink-0 mt-0.5"></i>
                                    <span>{{ ucfirst($author->startup_stage ?? $author->stage ?? 'Early') }} Stage</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    <p class="text-xs text-gray-400 mt-5 pt-4 border-t border-gray-100 flex items-center justify-center gap-1">
                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                        {{ \Carbon\Carbon::parse($post->created_at)->format('M j, Y') }}
                    </p>

                    @if($isMentorAuthor && session('user_role') !== 'mentor')
                        <a href="{{ route('mentors.show', $post->author_id) }}#request-form" class="mt-5 w-full px-5 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-lg shadow-primary-600/25 transition-all flex items-center justify-center gap-2 text-sm">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Request Mentorship
                        </a>
                    @endif
                </div>
            </aside>

            {{-- Article body --}}
            <article class="flex-1 order-1 lg:order-2 min-w-0">
                <div class="glass-card rounded-3xl shadow-xl border border-white/40 overflow-hidden">
                    <header class="px-8 pt-8 pb-6 border-b border-gray-100/80">
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider flex items-center gap-2 mb-3">
                            <i data-lucide="newspaper" class="w-4 h-4 text-primary-600"></i>
                            Community Post
                        </p>
                        <h1 class="text-2xl sm:text-3xl font-bold text-heading leading-tight">
                            Insights from {{ $post->author_name }}
                        </h1>
                        <p class="text-sm text-body mt-2 flex items-center gap-1">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            Published {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y \a\t g:i A') }}
                        </p>
                    </header>

                    <div class="px-8 py-8">
                        <div class="prose prose-slate max-w-none text-body text-lg leading-relaxed">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>

                    <footer class="px-8 py-5 bg-white/40 border-t border-gray-100/80">
                        <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 inline-flex items-center gap-1.5 transition-colors">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            Back to Community Board
                        </a>
                    </footer>
                </div>
            </article>

        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

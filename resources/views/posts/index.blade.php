@extends('layouts.app')

@section('title', 'Community Board | MentorConnect')

@section('content')

@php
    $composerInitials = session('user_id')
        ? strtoupper(collect(explode(' ', session('user_name', 'U')))->map(fn($w) => substr($w, 0, 1))->take(2)->join(''))
        : '';
@endphp

<section class="bg-surface min-h-[calc(100vh-5rem)] py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8 animate-fade-in-up">
            <h1 class="text-3xl font-bold text-heading mb-2">
                Community <span class="gradient-text">Board</span>
            </h1>
            <p class="text-body text-sm">Share insights, ask questions, and connect with everyone.</p>
        </div>

        @if(session('user_id'))
            <div id="create-post" class="glass-card rounded-3xl p-6 shadow-lg mb-10 animate-fade-in-up-delay-1 border border-white/40">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-primary-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 shadow-md ring-2 ring-primary-100">
                            {{ $composerInitials }}
                        </div>
                        <div class="flex-1">
                            <textarea name="content" rows="3" placeholder="What's on your mind? Share an insight, ask a question..." class="w-full px-4 py-3 bg-white/60 border border-gray-200/80 rounded-2xl text-sm focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all outline-none resize-none {{ $errors->has('content') ? 'border-red-500 ring-red-100' : '' }}" required></textarea>
                            @error('content')
                                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <div class="flex justify-end mt-3">
                                <button type="submit" class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center gap-2 text-sm">
                                    <i data-lucide="send" class="w-4 h-4"></i> Post
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="glass-card rounded-2xl p-6 border border-primary-100/50 text-center mb-10">
                <p class="text-primary-700 font-medium mb-3">Join the conversation with startups and mentors!</p>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-sm text-sm transition-all">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    Log in to Post
                </a>
            </div>
        @endif

        <div class="space-y-6 animate-fade-in-up-delay-2">
            @if($posts->isEmpty())
                <div class="glass-card rounded-3xl p-16 text-center shadow-sm border border-white/40">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="messages-square" class="w-8 h-8 text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-bold text-heading mb-2">No posts yet</h3>
                    <p class="text-body text-sm">Be the first to start the conversation!</p>
                </div>
            @else
                @foreach($posts as $post)
                    @php
                        $isMentor = $post->author_role === 'mentor';
                        $chipClass = $isMentor
                            ? 'bg-primary-50 text-primary-700 border-primary-200'
                            : 'bg-indigo-50 text-indigo-700 border-indigo-200';
                        $avatarClass = $isMentor
                            ? 'bg-primary-100 text-primary-700 ring-primary-200'
                            : 'bg-indigo-100 text-indigo-700 ring-indigo-200';
                        $postInitials = strtoupper(collect(explode(' ', $post->author_name))->map(fn($w) => substr($w, 0, 1))->take(2)->join(''));
                    @endphp
                    <article class="glass-card rounded-3xl p-6 border border-white/40 shadow-sm hover:shadow-md transition-shadow hover-lift">
                        <header class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-bold text-sm ring-2 {{ $avatarClass }}">
                                {{ $postInitials }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h4 class="font-bold text-heading">{{ $post->author_name }}</h4>
                                    <span class="text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider font-semibold border {{ $chipClass }}">
                                        {{ $isMentor ? 'Mentor' : 'Startup' }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 flex items-center gap-1 mt-0.5">
                                    <i data-lucide="clock" class="w-3 h-3"></i>
                                    {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </header>

                        <div class="text-body leading-relaxed pl-0 sm:pl-[60px]">
                            {!! nl2br(e(\Illuminate\Support\Str::limit($post->content, 200))) !!}

                            @if(strlen($post->content) > 200)
                                <div class="mt-3">
                                    <a href="{{ route('posts.show', (string) $post->id) }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 inline-flex items-center gap-1 transition-all">
                                        Read More <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            @else
                                <div class="mt-3">
                                    <a href="{{ route('posts.show', (string) $post->id) }}" class="text-sm font-semibold text-body hover:text-primary-600 inline-flex items-center gap-1 transition-all">
                                        View Full Post <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            @endif
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

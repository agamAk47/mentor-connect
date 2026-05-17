@extends('layouts.app')

@section('title', $mentor->name . ' - Mentor Profile | MentorConnect')

@section('content')

    @php
        $scoreRounded = isset($matchScore) ? (int) round($matchScore) : null;
        $matchStroke = 'stroke-primary-500';
        $matchText = 'text-primary-700';
        $matchBg = 'bg-primary-50';
        $matchRing = 'ring-primary-200';
        if ($scoreRounded !== null) {
            if ($scoreRounded < 40) {
                $matchStroke = 'stroke-red-500';
                $matchText = 'text-red-700';
                $matchBg = 'bg-red-50';
                $matchRing = 'ring-red-200';
            } elseif ($scoreRounded <= 70) {
                $matchStroke = 'stroke-amber-500';
                $matchText = 'text-amber-700';
                $matchBg = 'bg-amber-50';
                $matchRing = 'ring-amber-200';
            }
        }
        $circumference = 2 * 3.14159 * 42;
        $dashOffset = $scoreRounded !== null ? $circumference - ($scoreRounded / 100) * $circumference : $circumference;
        $firstName = explode(' ', trim($mentor->name))[0];
    @endphp

    <section class="bg-surface min-h-screen py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex text-sm text-body mb-6 animate-fade-in-up" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('mentors.index') }}" class="hover:text-primary-600 transition-colors flex items-center gap-1"><i data-lucide="arrow-left" class="w-4 h-4"></i> Browse Mentors</a></li>
                    <li><i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i></li>
                    <li class="font-semibold text-heading">{{ $mentor->name }}</li>
                </ol>
            </nav>

            {{-- Hero banner --}}
            <div class="glass-card rounded-3xl overflow-hidden shadow-xl shadow-primary-500/10 mb-8 animate-fade-in-up">
                <div class="relative h-40 sm:h-48 bg-gradient-to-r from-primary-500 via-secondary to-accent">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                    <div class="absolute -bottom-20 -right-10 w-48 h-48 bg-white/10 blob animate-float"></div>
                </div>

                <div class="px-6 sm:px-8 pb-8 relative">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-5">
                        <div class="w-28 h-28 rounded-2xl bg-white p-1.5 shadow-xl flex-shrink-0 -mt-12 sm:-mt-16 z-10">
                            <div class="w-full h-full rounded-xl gradient-bg flex items-center justify-center text-white font-bold text-4xl">
                                {{ strtoupper(substr($mentor->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-1 pt-3 sm:pt-4">
                            <h1 class="text-2xl sm:text-3xl font-bold text-heading mb-1">{{ $mentor->name }}</h1>
                            <p class="text-primary-600 font-medium mb-3">{{ $mentor->expertise }}</p>
                            <div class="flex flex-wrap items-center gap-3 text-sm text-body">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/80 border border-gray-200/60">
                                    <i data-lucide="briefcase" class="w-4 h-4 text-primary-500"></i>
                                    {{ $mentor->experience }} years experience
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/80 border border-gray-200/60">
                                    <i data-lucide="tag" class="w-4 h-4 text-secondary"></i>
                                    {{ $mentor->category->name }}
                                </span>
                                @if($mentor->reviews->count() > 0)
                                    <span class="inline-flex items-center gap-1 text-amber-500 font-semibold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        {{ number_format($mentor->reviews->avg('rating'), 1) }}
                                        <span class="text-body font-normal">({{ $mentor->reviews->count() }} reviews)</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Two columns: content + sticky sidebar --}}
            <div class="grid lg:grid-cols-3 gap-8 items-start">

                {{-- Left column --}}
                <div class="lg:col-span-2 space-y-8 animate-fade-in-up-delay-1">

                    {{-- About --}}
                    <div class="glass-card rounded-2xl p-6 sm:p-8 shadow-lg shadow-primary-500/5">
                        <h2 class="text-sm font-bold text-heading uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i data-lucide="user" class="w-4 h-4 text-primary-600"></i>
                            About {{ $firstName }}
                        </h2>
                        <div class="text-body leading-relaxed bg-white/50 rounded-xl p-5 border border-gray-200/60">
                            {!! nl2br(e($mentor->bio)) !!}
                        </div>
                    </div>

                    {{-- Reviews --}}
                    <div id="reviews" class="glass-card rounded-2xl p-6 sm:p-8 shadow-lg shadow-primary-500/5">
                        <h2 class="text-xl font-bold text-heading mb-6 flex items-center gap-2">
                            <i data-lucide="star" class="w-5 h-5 text-amber-500"></i>
                            Reviews & Ratings
                        </h2>

                        @if($canReview)
                            <form action="{{ route('reviews.store', $mentor->id) }}" method="POST" class="bg-amber-50/80 backdrop-blur rounded-2xl p-6 border border-amber-200/60 mb-8">
                                @csrf
                                <h3 class="font-bold text-heading mb-4 text-sm uppercase tracking-wider flex items-center gap-2">
                                    <i data-lucide="pen-line" class="w-4 h-4 text-amber-600"></i>
                                    Write a Review
                                </h3>

                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-heading mb-2">Rating <span class="text-red-500">*</span></label>
                                    <div class="flex flex-wrap items-center gap-4">
                                        @for($i = 5; $i >= 1; $i--)
                                            <label class="flex items-center gap-1 cursor-pointer">
                                                <input type="radio" name="rating" value="{{ $i }}" class="text-amber-500 focus:ring-amber-500" {{ old('rating') == $i ? 'checked' : '' }} required>
                                                <span class="text-sm font-semibold">{{ $i }} <i data-lucide="star" class="w-3 h-3 inline fill-amber-400 text-amber-400"></i></span>
                                            </label>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                            <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="review_text" class="block text-sm font-semibold text-heading mb-2">Your Review <span class="text-red-500">*</span></label>
                                    <textarea name="review_text" id="review_text" rows="3" placeholder="How was your mentorship experience?" class="w-full px-4 py-3 bg-white/90 border border-gray-200/80 rounded-xl text-sm focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none resize-none" required>{{ old('review_text') }}</textarea>
                                    @error('review_text')
                                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                            <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <button type="submit" class="px-6 py-2.5 bg-amber-500 text-white font-semibold rounded-xl hover:bg-amber-600 transition-all flex items-center gap-2 text-sm">
                                    <i data-lucide="check" class="w-4 h-4"></i> Submit Review
                                </button>
                            </form>
                        @endif

                        @if($mentor->reviews->isEmpty())
                            <div class="text-center py-10 bg-white/40 rounded-2xl border border-dashed border-gray-300/80">
                                <i data-lucide="message-square" class="w-10 h-10 text-gray-300 mx-auto mb-3"></i>
                                <p class="text-sm text-body">No reviews yet. Be the first after an approved mentorship!</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($mentor->reviews as $review)
                                    <article class="bg-white/60 rounded-2xl p-5 border border-gray-200/60">
                                        <div class="flex items-center justify-between mb-3 gap-4">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                    {{ strtoupper(substr($review->startup->startup_name ?? 'S', 0, 1)) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <h4 class="font-bold text-heading text-sm truncate">{{ $review->startup->startup_name ?? 'Anonymous Startup' }}</h4>
                                                    <p class="text-xs text-body">{{ $review->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center text-amber-400 flex-shrink-0">
                                                @for($i = 0; $i < $review->rating; $i++)
                                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                                @endfor
                                                @for($i = 0; $i < (5 - $review->rating); $i++)
                                                    <i data-lucide="star" class="w-4 h-4 text-gray-300"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-sm text-body leading-relaxed">{{ $review->review_text }}</p>
                                    </article>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right column: sticky request card --}}
                <aside class="lg:col-span-1 space-y-6 lg:sticky lg:top-24 animate-fade-in-up-delay-2">

                    @if(isset($matchScore) && $matchScore !== null)
                        <div class="glass-card rounded-2xl p-6 text-center shadow-lg shadow-primary-500/5 {{ $matchBg }} ring-1 {{ $matchRing }}">
                            <h3 class="text-xs font-bold text-heading uppercase tracking-wider mb-4 flex items-center justify-center gap-2">
                                <i data-lucide="sparkles" class="w-4 h-4 text-primary-600"></i>
                                Match Score
                            </h3>
                            <div class="relative w-32 h-32 mx-auto mb-3 {{ $matchText }}">
                                <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100" aria-hidden="true">
                                    <circle cx="50" cy="50" r="42" fill="none" stroke="currentColor" stroke-width="8" class="text-gray-200/80"></circle>
                                    <circle cx="50" cy="50" r="42" fill="none" stroke-width="8" stroke-linecap="round"
                                        class="{{ $matchStroke }}"
                                        stroke="currentColor"
                                        stroke-dasharray="{{ $circumference }}"
                                        stroke-dashoffset="{{ $dashOffset }}"></circle>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-3xl font-bold {{ $matchText }}">{{ $scoreRounded }}%</span>
                                    <span class="text-xs text-body font-medium">match</span>
                                </div>
                            </div>
                            <p class="text-xs text-body">
                                @if($scoreRounded < 40)
                                    Consider exploring other mentors for a stronger fit.
                                @elseif($scoreRounded <= 70)
                                    A solid potential match based on your startup profile.
                                @else
                                    Excellent alignment with your industry and goals!
                                @endif
                            </p>
                        </div>
                    @endif

                    <div id="request-form" class="glass-card rounded-2xl p-6 shadow-xl shadow-primary-500/10 border border-primary-100/50">
                        <h3 class="text-lg font-bold text-heading mb-2 flex items-center gap-2">
                            <i data-lucide="send" class="w-5 h-5 text-primary-600"></i>
                            Request Mentorship
                        </h3>
                        <p class="text-sm text-body mb-5">Tell {{ $firstName }} how they can help your startup grow.</p>

                        <form action="{{ route('requests.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">

                            <div class="mb-4">
                                <label for="message" class="block text-sm font-semibold text-heading mb-2">Your message <span class="text-red-500">*</span></label>
                                <textarea name="message" id="message" rows="5"
                                    placeholder="Briefly explain your startup's challenges and how this mentor can help..."
                                    class="w-full px-4 py-3 bg-white/80 border border-gray-200/80 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none resize-none {{ $errors->has('message') ? 'border-red-400 focus:ring-red-500/20 focus:border-red-500' : '' }}"
                                    required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1.5 text-xs font-medium text-red-500 flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full py-3.5 gradient-bg text-white font-semibold rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 hover:scale-[1.02] transition-all btn-shine flex items-center justify-center gap-2">
                                <i data-lucide="paper-plane" class="w-4 h-4"></i>
                                Submit Request
                            </button>
                        </form>
                    </div>

                    <div class="glass-card rounded-2xl p-5 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                                <i data-lucide="briefcase" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-heading">{{ $mentor->experience }}</p>
                                <p class="text-xs text-body uppercase tracking-wider">Years Experience</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-secondary">
                                <i data-lucide="layers" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-lg font-bold text-heading">{{ $mentor->category->name }}</p>
                                <p class="text-xs text-body uppercase tracking-wider">Mentorship Domain</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

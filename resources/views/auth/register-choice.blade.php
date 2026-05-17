@extends('layouts.app')

@section('title', 'Join MentorConnect')

@section('content')

<section class="relative min-h-[calc(100vh-4rem)] lg:min-h-[calc(100vh-5rem)] flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8 bg-[#FAFBFF] overflow-hidden">
    {{-- Background Blobs --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute top-[-10%] left-[10%] w-[500px] h-[500px] bg-primary-200/20 rounded-full blur-[100px] mix-blend-multiply"></div>
        <div class="absolute bottom-[10%] right-[-10%] w-[600px] h-[600px] bg-accent/10 rounded-full blur-[120px] mix-blend-multiply"></div>
        
        {{-- Dotted background --}}
        <div class="absolute top-[20%] left-[5%] w-32 h-32 opacity-30 hidden lg:block" style="background-image: radial-gradient(#CBD5E1 1.5px, transparent 1.5px); background-size: 16px 16px;"></div>
        <div class="absolute bottom-[10%] right-[10%] w-48 h-48 opacity-30 hidden lg:block" style="background-image: radial-gradient(#CBD5E1 1.5px, transparent 1.5px); background-size: 16px 16px;"></div>
    </div>

    <div class="max-w-5xl w-full relative z-10 flex flex-col items-center">
        {{-- Header --}}
        <div class="text-center mb-12 animate-fade-in-up">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 mb-4 font-display">
                Join <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent">MentorConnect</span>
            </h1>
            <p class="text-slate-500 text-base sm:text-lg">Choose how you want to get started</p>
        </div>

        {{-- Cards Container --}}
        <div class="grid md:grid-cols-2 gap-8 w-full max-w-4xl">
            
            {{-- Startup Card --}}
            <div class="bg-white rounded-[2rem] p-8 sm:p-10 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.06)] border border-slate-100 hover:-translate-y-2 hover:shadow-[0_30px_60px_-12px_rgba(91,108,255,0.15)] transition-all duration-300 flex flex-col text-center group animate-fade-in-left">
                <div class="w-20 h-20 mx-auto rounded-full bg-primary-50 flex items-center justify-center mb-6 relative">
                    <div class="absolute inset-0 bg-primary-100 rounded-full scale-0 group-hover:scale-110 transition-transform duration-300 opacity-50"></div>
                    <i data-lucide="rocket" class="w-8 h-8 text-primary-500 relative z-10"></i>
                    {{-- Sparkles --}}
                    <i data-lucide="sparkle" class="absolute -top-2 -left-4 w-4 h-4 text-primary-300 animate-pulse"></i>
                    <i data-lucide="sparkle" class="absolute top-2 -right-4 w-5 h-5 text-primary-200 animate-pulse" style="animation-delay: 0.5s"></i>
                </div>
                
                <h2 class="text-2xl font-bold text-slate-900 mb-4">I'm a Startup</h2>
                <p class="text-slate-500 text-sm mb-10 px-4">
                    Find experienced mentors to guide your journey, get expert advice, and accelerate your growth.
                </p>
                
                <ul class="space-y-5 text-left mb-10 flex-1">
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="users" class="w-4 h-4 text-primary-500"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-600">Browse expert mentors by category</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="sparkles" class="w-4 h-4 text-primary-500"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-600">AI-powered match scores</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="send" class="w-4 h-4 text-primary-500"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-600">Send mentorship requests</span>
                    </li>
                </ul>
                
                <a href="{{ route('register.startup') }}" class="w-full py-4 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 transition-colors shadow-lg shadow-primary-500/25 flex items-center justify-center gap-2 group/btn">
                    Get Started as a Startup
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

            {{-- Mentor Card --}}
            <div class="bg-white rounded-[2rem] p-8 sm:p-10 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.06)] border border-slate-100 hover:-translate-y-2 hover:shadow-[0_30px_60px_-12px_rgba(255,138,91,0.15)] transition-all duration-300 flex flex-col text-center group animate-fade-in-right">
                <div class="w-20 h-20 mx-auto rounded-full bg-orange-50 flex items-center justify-center mb-6 relative">
                    <div class="absolute inset-0 bg-orange-100 rounded-full scale-0 group-hover:scale-110 transition-transform duration-300 opacity-50"></div>
                    <i data-lucide="graduation-cap" class="w-8 h-8 text-accent relative z-10"></i>
                    {{-- Sparkles --}}
                    <i data-lucide="sparkle" class="absolute top-0 -left-6 w-4 h-4 text-orange-300 animate-pulse"></i>
                    <i data-lucide="sparkle" class="absolute -top-4 right-0 w-5 h-5 text-orange-200 animate-pulse" style="animation-delay: 0.5s"></i>
                </div>
                
                <h2 class="text-2xl font-bold text-slate-900 mb-4">I'm a Mentor</h2>
                <p class="text-slate-500 text-sm mb-10 px-4">
                    Share your expertise, help startups succeed, and make a meaningful impact.
                </p>
                
                <ul class="space-y-5 text-left mb-10 flex-1">
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="user" class="w-4 h-4 text-accent"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-600">Showcase your expertise & bio</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="message-square" class="w-4 h-4 text-accent"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-600">Receive mentorship requests</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-8 h-8 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="heart" class="w-4 h-4 text-accent"></i>
                        </div>
                        <span class="text-sm font-semibold text-slate-600">Give back to the community</span>
                    </li>
                </ul>
                
                <a href="{{ route('register.mentor') }}" class="w-full py-4 bg-accent text-white font-bold rounded-xl hover:bg-orange-500 transition-colors shadow-lg shadow-accent/25 flex items-center justify-center gap-2 group/btn">
                    Get Started as a Mentor
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform"></i>
                </a>
            </div>

        </div>

        {{-- Login link --}}
        <div class="mt-12 animate-fade-in-up">
            <p class="text-sm text-slate-600 bg-white/60 backdrop-blur border border-slate-200/50 px-6 py-3 rounded-full shadow-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold text-primary-600 hover:text-primary-700 underline underline-offset-4 ml-1 transition-colors">Log in here</a>
            </p>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

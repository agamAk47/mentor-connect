@extends('layouts.app')

@section('title', 'Log In | MentorConnect')

@section('content')

    <section class="relative min-h-[calc(100vh-4rem)] lg:min-h-[calc(100vh-5rem)] flex overflow-hidden bg-[#FAFBFF]">
        {{-- Animated background blobs and floating orbs --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
            {{-- Big blurred background blobs --}}
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-primary-200/30 rounded-full blur-[100px] mix-blend-multiply"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-sky-100/40 rounded-full blur-[120px] mix-blend-multiply"></div>
            
            {{-- Small floating glassy orbs --}}
            <div class="absolute top-1/4 right-1/4 w-8 h-8 rounded-full bg-violet-400/40 backdrop-blur-sm border border-white/40 shadow-sm animate-float"></div>
            <div class="absolute top-1/3 left-1/2 w-6 h-6 rounded-full bg-teal-400/40 backdrop-blur-sm border border-white/40 shadow-sm animate-float" style="animation-delay: 1s"></div>
            <div class="absolute bottom-1/4 left-[30%] w-10 h-10 rounded-full bg-purple-500/40 backdrop-blur-sm border border-white/40 shadow-sm animate-blob"></div>
            <div class="absolute bottom-[40%] right-[10%] w-5 h-5 rounded-full bg-blue-400/40 backdrop-blur-sm border border-white/40 shadow-sm animate-float" style="animation-delay: 2s"></div>
        </div>

        <div class="max-w-7xl mx-auto w-full flex flex-col lg:flex-row items-center justify-between px-4 sm:px-6 lg:px-8 py-12 lg:py-0 relative z-10 gap-12 lg:gap-8">
            
            {{-- Left Content --}}
            <div class="w-full lg:w-1/2 lg:pr-8 animate-fade-in-left">
                {{-- Eyebrow --}}
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 rounded-full mb-8 border border-emerald-100 shadow-sm">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-emerald-500"></i>
                    <span class="text-[0.65rem] font-bold text-emerald-600 uppercase tracking-widest">The bridge between startups & success</span>
                </div>
                
                {{-- Heading --}}
                <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 leading-[1.1] mb-5 font-display tracking-tight">
                    Grow faster <br>
                    with the right <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent">mentor</span>
                </h1>
                
                {{-- Subtext --}}
                <p class="text-slate-500 text-base lg:text-lg mb-10 max-w-md leading-relaxed">
                    Connect with industry experts who understand your startup journey and help you scale smarter, faster, and better.
                </p>
                
                {{-- Bullet Points --}}
                <div class="space-y-5 mb-16 max-w-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0 border border-indigo-100/50 shadow-sm">
                            <i data-lucide="sparkles" class="w-4 h-4 text-indigo-500"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-semibold text-slate-700">AI-powered mentor matching for startups</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center flex-shrink-0 border border-teal-100/50 shadow-sm">
                            <i data-lucide="users" class="w-4 h-4 text-teal-500"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-semibold text-slate-700">Curated experts across EdTech, FinTech & more</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0 border border-red-100/50 shadow-sm">
                            <i data-lucide="message-square" class="w-4 h-4 text-red-500"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-semibold text-slate-700">Request mentorship and track your growth</span>
                    </div>
                </div>
                
                {{-- Wave & Avatars (Hidden on small screens) --}}
                <div class="relative h-24 hidden lg:block w-full max-w-md">
                    <!-- Dot grid accent -->
                    <div class="absolute left-0 top-0 w-24 h-24 opacity-30" style="background-image: radial-gradient(#CBD5E1 1.5px, transparent 1.5px); background-size: 12px 12px;"></div>
                    
                    <!-- SVG Wave -->
                    <svg class="absolute top-4 left-0 w-full h-20 overflow-visible opacity-60" viewBox="0 0 400 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 40 C 50 10, 100 60, 150 40 C 200 20, 250 60, 300 40 C 350 20, 400 40, 450 40" stroke="#CBD5E1" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    
                    <!-- Avatars on wave -->
                    <div class="absolute top-6 left-[10%] w-10 h-10 rounded-full border-[2px] border-white shadow-md overflow-hidden bg-white animate-float" style="animation-delay: 0.5s">
                        <img src="https://i.pravatar.cc/100?img=1" alt="Avatar 1" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute top-12 left-[28%] w-8 h-8 rounded-full border-[2px] border-white shadow-md overflow-hidden bg-secondary flex items-center justify-center animate-float" style="animation-delay: 1.2s">
                        <i data-lucide="users" class="w-3 h-3 text-white"></i>
                    </div>
                    <div class="absolute top-0 left-[45%] w-14 h-14 rounded-full border-[3px] border-white shadow-lg overflow-hidden bg-white animate-float" style="animation-delay: 0s">
                        <img src="https://i.pravatar.cc/100?img=11" alt="Avatar 2" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute top-10 left-[75%] w-11 h-11 rounded-full border-[2px] border-white shadow-md overflow-hidden bg-white animate-float" style="animation-delay: 1.5s">
                        <img src="https://i.pravatar.cc/100?img=5" alt="Avatar 3" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            {{-- Right: White Glass Form Card --}}
            <div class="w-full lg:w-[480px] xl:w-[500px] animate-fade-in-up">
                <div class="bg-white rounded-[2rem] p-8 sm:p-12 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.06)] border border-slate-100/80 relative hover-lift transition-all duration-500">
                    
                    <div class="mb-8 text-center sm:text-left">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-2 font-display">
                            Welcome <span class="text-secondary">back</span>
                        </h2>
                        <p class="text-slate-500 text-sm">Sign in to your MentorConnect account</p>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf

                        <div class="space-y-5">
                            {{-- Role pill tabs --}}
                            <div class="flex items-center gap-1 p-1 bg-slate-50 border border-slate-200/60 rounded-xl mb-8">
                                <label class="relative cursor-pointer flex-1 text-center">
                                    <input type="radio" name="role" value="startup" class="peer sr-only" {{ old('role', 'startup') == 'startup' ? 'checked' : '' }}>
                                    <div class="flex items-center justify-center gap-2 px-2 py-2.5 rounded-lg text-xs sm:text-sm font-bold text-slate-500 peer-checked:bg-white peer-checked:text-primary-600 peer-checked:shadow-sm transition-all duration-200">
                                        <i data-lucide="building-2" class="w-4 h-4"></i>
                                        Startup
                                    </div>
                                </label>
                                <div class="w-px h-6 bg-slate-200"></div>
                                <label class="relative cursor-pointer flex-1 text-center">
                                    <input type="radio" name="role" value="mentor" class="peer sr-only" {{ old('role') == 'mentor' ? 'checked' : '' }}>
                                    <div class="flex items-center justify-center gap-2 px-2 py-2.5 rounded-lg text-xs sm:text-sm font-bold text-slate-500 peer-checked:bg-white peer-checked:text-secondary peer-checked:shadow-sm transition-all duration-200">
                                        <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                        Mentor
                                    </div>
                                </label>
                                <div class="w-px h-6 bg-slate-200"></div>
                                <label class="relative cursor-pointer flex-1 text-center">
                                    <input type="radio" name="role" value="admin" class="peer sr-only" {{ old('role') == 'admin' ? 'checked' : '' }}>
                                    <div class="flex items-center justify-center gap-2 px-2 py-2.5 rounded-lg text-xs sm:text-sm font-bold text-slate-500 peer-checked:bg-white peer-checked:text-slate-800 peer-checked:shadow-sm transition-all duration-200">
                                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                                        Admin
                                    </div>
                                </label>
                            </div>
                            @error('role')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                                </p>
                            @enderror

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Email Address <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                                    </div>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm"
                                        placeholder="Enter your email">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <div class="flex items-center justify-between mb-1.5 ml-1">
                                    <label for="password" class="block text-xs font-bold text-slate-700">Password <span class="text-red-500">*</span></label>
                                    <a href="#" class="text-[0.7rem] font-bold text-primary-600 hover:text-primary-700 transition-colors">Forgot password?</a>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm"
                                        placeholder="Enter your password">
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Remember Me --}}
                            <div class="flex items-center pt-2">
                                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded text-primary-500 focus:ring-primary-500 border-slate-300">
                                <label for="remember" class="ml-2 text-xs font-bold text-slate-500 cursor-pointer">Remember me</label>
                            </div>

                            <button type="submit"
                                class="w-full py-3.5 mt-2 bg-gradient-to-r from-primary-600 to-accent text-white font-bold text-sm rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 hover:opacity-95 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 group">
                                Log In
                                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-8">
                        <p class="text-xs text-slate-500 font-semibold">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold text-primary-600 hover:text-primary-700 hover:underline underline-offset-4 ml-1 transition-all">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

@extends('layouts.app')

@section('title', 'Register Startup | MentorConnect')

@section('content')

<section class="relative min-h-[calc(100vh-4rem)] lg:min-h-[calc(100vh-5rem)] flex overflow-hidden bg-[#FAFBFF]">
    {{-- Animated background blobs --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-primary-200/30 rounded-full blur-[100px] mix-blend-multiply"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-sky-100/40 rounded-full blur-[120px] mix-blend-multiply"></div>
        <div class="absolute top-1/4 right-1/4 w-8 h-8 rounded-full bg-violet-400/40 backdrop-blur-sm border border-white/40 shadow-sm animate-float"></div>
        <div class="absolute bottom-[40%] right-[10%] w-5 h-5 rounded-full bg-blue-400/40 backdrop-blur-sm border border-white/40 shadow-sm animate-float" style="animation-delay: 2s"></div>
    </div>

    <div class="max-w-7xl mx-auto w-full flex flex-col lg:flex-row items-center justify-between px-4 sm:px-6 lg:px-8 py-12 lg:py-16 relative z-10 gap-12 lg:gap-8">
        
        {{-- Left Content --}}
        <div class="w-full lg:w-5/12 lg:pr-8 animate-fade-in-left self-start lg:mt-12">
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-primary-600 mb-8 font-semibold transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to roles
            </a>
            
            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 rounded-full mb-6 border border-indigo-100 shadow-sm">
                <i data-lucide="rocket" class="w-3.5 h-3.5 text-indigo-500"></i>
                <span class="text-[0.65rem] font-bold text-indigo-600 uppercase tracking-widest">Startup Registration</span>
            </div>
            
            <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-[1.1] mb-5 font-display tracking-tight">
                Accelerate your <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-accent">startup's growth</span>
            </h1>
            
            <p class="text-slate-500 text-base mb-10 leading-relaxed">
                Join MentorConnect to find experienced mentors, get expert advice, and scale smarter.
            </p>

            <div class="hidden lg:block relative mt-12 p-6 bg-white/60 backdrop-blur-md rounded-2xl border border-white shadow-sm">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="quote" class="w-4 h-4 text-primary-600"></i>
                    </div>
                    <p class="text-sm text-slate-600 font-medium italic">
                        "MentorConnect helped us refine our pitch and close our seed round 3 months faster than planned."
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-xs font-bold text-slate-800">- Sarah J., Founder of Edutech</div>
                    <div class="flex text-yellow-400">
                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                        <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Form Card --}}
        <div class="w-full lg:w-7/12 animate-fade-in-up">
            <div class="bg-white rounded-[2rem] p-6 sm:p-10 shadow-[0_20px_50px_-12px_rgba(0,0,0,0.06)] border border-slate-100/80 relative transition-all duration-500">
                <form action="{{ route('register.startup.submit') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-8">
                        {{-- Account Details Section --}}
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2 pb-3 border-b border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-primary-50 flex items-center justify-center">
                                    <span class="text-xs text-primary-600">1</span>
                                </div>
                                Account Details
                            </h3>
                            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Startup Name <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="building" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="text" name="startup_name" value="{{ old('startup_name') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" placeholder="TechVenture">
                                    </div>
                                    @error('startup_name') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Founder Name <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="text" name="founder_name" value="{{ old('founder_name') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" placeholder="Jane Smith">
                                    </div>
                                    @error('founder_name') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Email Address <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" placeholder="jane@startup.com">
                                </div>
                                @error('email') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Password <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" placeholder="Min 6 characters">
                                    </div>
                                    @error('password') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Confirm Password <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="password" name="password_confirmation" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" placeholder="Re-enter password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Profile Section --}}
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2 pb-3 border-b border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-primary-50 flex items-center justify-center">
                                    <span class="text-xs text-primary-600">2</span>
                                </div>
                                Startup Profile
                            </h3>
                            
                            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Industry / Domain</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="layers" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="text" name="industry" value="{{ old('industry') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm" placeholder="e.g., EdTech">
                                    </div>
                                    @error('industry') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Startup Stage</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="signal" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <select name="stage" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm appearance-none">
                                            <option value="">Select your stage</option>
                                            <option value="Idea Stage" {{ old('stage') == 'Idea Stage' ? 'selected' : '' }}>Idea Stage</option>
                                            <option value="MVP" {{ old('stage') == 'MVP' ? 'selected' : '' }}>MVP</option>
                                            <option value="Early Traction" {{ old('stage') == 'Early Traction' ? 'selected' : '' }}>Early Traction</option>
                                            <option value="Growth" {{ old('stage') == 'Growth' ? 'selected' : '' }}>Growth Stage</option>
                                            <option value="Scaling" {{ old('stage') == 'Scaling' ? 'selected' : '' }}>Scaling</option>
                                        </select>
                                    </div>
                                    @error('stage') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Problem Statement</label>
                                <textarea name="problem_statement" rows="3" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all shadow-sm resize-none" placeholder="Briefly describe the problem your startup is solving...">{{ old('problem_statement') }}</textarea>
                                @error('problem_statement') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 mt-2 bg-gradient-to-r from-primary-600 to-accent text-white font-bold rounded-xl shadow-lg shadow-primary-500/25 hover:shadow-primary-500/40 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 group">
                            Create Startup Account
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <p class="text-center mt-6 text-sm text-slate-500 font-medium">
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

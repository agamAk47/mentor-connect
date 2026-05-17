@extends('layouts.app')

@section('title', 'Register as Mentor | MentorConnect')

@section('content')

<section class="relative min-h-[calc(100vh-4rem)] lg:min-h-[calc(100vh-5rem)] flex overflow-hidden bg-[#FAFBFF]">
    {{-- Animated background blobs --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-secondary/20 rounded-full blur-[100px] mix-blend-multiply"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-accent/20 rounded-full blur-[120px] mix-blend-multiply"></div>
        <div class="absolute top-1/4 right-1/4 w-8 h-8 rounded-full bg-orange-400/40 backdrop-blur-sm border border-white/40 shadow-sm animate-float"></div>
        <div class="absolute bottom-[40%] right-[10%] w-5 h-5 rounded-full bg-red-400/40 backdrop-blur-sm border border-white/40 shadow-sm animate-float" style="animation-delay: 2s"></div>
    </div>

    <div class="max-w-7xl mx-auto w-full flex flex-col lg:flex-row items-center justify-between px-4 sm:px-6 lg:px-8 py-12 lg:py-16 relative z-10 gap-12 lg:gap-8">
        
        {{-- Left Content --}}
        <div class="w-full lg:w-5/12 lg:pr-8 animate-fade-in-left self-start lg:mt-12">
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-accent mb-8 font-semibold transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to roles
            </a>
            
            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-50 rounded-full mb-6 border border-orange-100 shadow-sm">
                <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-accent"></i>
                <span class="text-[0.65rem] font-bold text-orange-600 uppercase tracking-widest">Mentor Registration</span>
            </div>
            
            <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-[1.1] mb-5 font-display tracking-tight">
                Shape the <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary to-accent">next generation</span>
            </h1>
            
            <p class="text-slate-500 text-base mb-10 leading-relaxed">
                Join MentorConnect to share your expertise, give back to the community, and help startups succeed.
            </p>

            <div class="hidden lg:block relative mt-12 p-6 bg-white/60 backdrop-blur-md rounded-2xl border border-white shadow-sm">
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="heart" class="w-4 h-4 text-accent"></i>
                    </div>
                    <p class="text-sm text-slate-600 font-medium italic">
                        "Mentoring startups on MentorConnect has been incredibly fulfilling. Seeing them implement my advice and raise funding is the best reward."
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-xs font-bold text-slate-800">- Rajesh M., Product VP</div>
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
                <form action="{{ route('register.mentor.submit') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-8">
                        {{-- Account Details Section --}}
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2 pb-3 border-b border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-orange-50 flex items-center justify-center">
                                    <span class="text-xs text-accent">1</span>
                                </div>
                                Account Details
                            </h3>
                            
                            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Full Name <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="text" name="name" value="{{ old('name') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm" placeholder="Rahul Sharma">
                                    </div>
                                    @error('name') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Email Address <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm" placeholder="rahul@example.com">
                                    </div>
                                    @error('email') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Password <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm" placeholder="Min 6 characters">
                                    </div>
                                    @error('password') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Confirm Password <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="password" name="password_confirmation" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm" placeholder="Re-enter password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Profile Section --}}
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2 pb-3 border-b border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-orange-50 flex items-center justify-center">
                                    <span class="text-xs text-accent">2</span>
                                </div>
                                Mentor Profile
                            </h3>
                            
                            <div class="mb-4">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Area of Expertise <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="award" class="w-4 h-4 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="expertise" value="{{ old('expertise') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm" placeholder="e.g., Product Strategy, B2B Sales">
                                </div>
                                @error('expertise') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Years of Experience <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <input type="number" name="experience" min="0" max="50" value="{{ old('experience') }}" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm" placeholder="e.g., 10">
                                    </div>
                                    @error('experience') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Category <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <i data-lucide="tag" class="w-4 h-4 text-slate-400"></i>
                                        </div>
                                        <select name="category_id" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm appearance-none">
                                            <option value="">Select category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5 ml-1">Short Bio</label>
                                <textarea name="bio" rows="3" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-accent/20 focus:border-accent transition-all shadow-sm resize-none" placeholder="Tell startups about your experience and how you can help...">{{ old('bio') }}</textarea>
                                @error('bio') <p class="text-red-500 text-xs mt-1"> <i data-lucide="alert-circle" class="w-3 h-3 inline"></i> {{ $message }} </p> @enderror
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 mt-2 bg-gradient-to-r from-secondary to-accent text-white font-bold rounded-xl shadow-lg shadow-accent/25 hover:shadow-accent/40 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 group">
                            Create Mentor Account
                            <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <p class="text-center mt-6 text-sm text-slate-500 font-medium">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold text-accent hover:text-orange-600 underline underline-offset-4 ml-1 transition-colors">Log in here</a>
            </p>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>lucide.createIcons();</script>
@endsection

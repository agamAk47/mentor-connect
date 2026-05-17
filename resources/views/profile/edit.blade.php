@extends('layouts.app')

@section('title', 'Edit Profile | MentorConnect')

@section('styles')
<style>
    .dot-grid-bg {
        background-color: #F8FAFC;
        background-image: radial-gradient(circle, #CBD5E1 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .profile-tab-btn.active {
        background: rgba(13, 148, 136, 0.1);
        color: #0D9488;
        border-color: #0D9488;
    }
    .profile-tab-panel {
        display: none;
    }
    .profile-tab-panel.active {
        display: block;
    }
</style>
@endsection

@section('content')

@php
    $displayName = $role === 'mentor' ? ($user->name ?? 'User') : ($user->founder_name ?? 'User');
    $initials = strtoupper(collect(explode(' ', $displayName))->map(fn($w) => substr($w, 0, 1))->take(2)->join(''));
    $roleLabel = $role === 'mentor' ? 'Mentor' : 'Startup';
    $roleBadgeClass = $role === 'mentor' ? 'bg-primary-50 text-primary-700 border-primary-200' : 'bg-indigo-50 text-indigo-700 border-indigo-200';
@endphp

<section class="dot-grid-bg min-h-[calc(100vh-5rem)] py-10 lg:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header + Avatar --}}
        <div class="mb-8 animate-fade-in-up text-center sm:text-left">
            <div class="flex flex-col sm:flex-row sm:items-center gap-5 mb-6">
                <div class="w-20 h-20 rounded-2xl gradient-bg flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-primary-600/25 mx-auto sm:mx-0 ring-4 ring-white">
                    {{ $initials }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-heading mb-1">
                        My <span class="gradient-text">Profile</span>
                    </h1>
                    <p class="text-body text-sm mb-2">{{ $displayName }}</p>
                    <span class="inline-block text-[10px] px-2.5 py-1 rounded-full uppercase tracking-wider font-semibold border {{ $roleBadgeClass }}">
                        {{ $roleLabel }}
                    </span>
                </div>
            </div>
            <p class="text-body text-sm">Manage your account, profile details, and security settings.</p>
        </div>

        {{-- Tab Navigation --}}
        <div class="glass-card rounded-2xl p-1.5 mb-6 shadow-sm flex flex-wrap gap-1 animate-fade-in-up-delay-1" role="tablist" aria-label="Profile sections">
            <button type="button" class="profile-tab-btn active flex-1 min-w-[100px] px-4 py-2.5 text-sm font-semibold rounded-xl border border-transparent text-body transition-all flex items-center justify-center gap-2" data-tab="account" role="tab" aria-selected="true" aria-controls="tab-account">
                <i data-lucide="user" class="w-4 h-4"></i>
                Account
            </button>
            <button type="button" class="profile-tab-btn flex-1 min-w-[100px] px-4 py-2.5 text-sm font-semibold rounded-xl border border-transparent text-body hover:text-primary-600 hover:bg-primary-50/50 transition-all flex items-center justify-center gap-2" data-tab="profile-details" role="tab" aria-selected="false" aria-controls="tab-profile-details">
                <i data-lucide="id-card" class="w-4 h-4"></i>
                Profile Details
            </button>
            <button type="button" class="profile-tab-btn flex-1 min-w-[100px] px-4 py-2.5 text-sm font-semibold rounded-xl border border-transparent text-body hover:text-primary-600 hover:bg-primary-50/50 transition-all flex items-center justify-center gap-2" data-tab="security" role="tab" aria-selected="false" aria-controls="tab-security">
                <i data-lucide="shield" class="w-4 h-4"></i>
                Security
            </button>
        </div>

        {{-- Form Card --}}
        <div class="glass-card rounded-2xl shadow-lg border border-white/40 p-6 sm:p-8 animate-fade-in-up-delay-2">
            <form action="{{ route('profile.update') }}" method="POST" id="profile-form">
                @csrf
                @method('PUT')

                {{-- Account Tab --}}
                <div id="tab-account" class="profile-tab-panel active" role="tabpanel">
                    <h2 class="text-lg font-bold text-heading mb-1 flex items-center gap-2">
                        <i data-lucide="user-circle" class="w-5 h-5 text-primary-600"></i>
                        Account Information
                    </h2>
                    <p class="text-body text-sm mb-6">Your login identity and primary contact details.</p>

                    <div class="grid sm:grid-cols-2 gap-5">
                        @if($role === 'mentor')
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-semibold text-heading mb-1.5">Full Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="user" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all {{ $errors->has('name') ? 'border-red-500' : '' }}">
                                </div>
                                @error('name')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <div>
                                <label for="founder_name" class="block text-sm font-semibold text-heading mb-1.5">Founder Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="user" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <input type="text" name="founder_name" id="founder_name" value="{{ old('founder_name', $user->founder_name) }}"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all {{ $errors->has('founder_name') ? 'border-red-500' : '' }}">
                                </div>
                                @error('founder_name')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="startup_name" class="block text-sm font-semibold text-heading mb-1.5">Startup Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="building-2" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <input type="text" name="startup_name" id="startup_name" value="{{ old('startup_name', $user->startup_name) }}"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all {{ $errors->has('startup_name') ? 'border-red-500' : '' }}">
                                </div>
                                @error('startup_name')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <div class="{{ $role === 'startup' ? 'sm:col-span-2' : '' }}">
                            <label for="email" class="block text-sm font-semibold text-heading mb-1.5">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="w-4 h-4 text-body"></i>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                    class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all {{ $errors->has('email') ? 'border-red-500' : '' }}">
                            </div>
                            @error('email')
                                <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Profile Details Tab --}}
                <div id="tab-profile-details" class="profile-tab-panel" role="tabpanel">
                    <h2 class="text-lg font-bold text-heading mb-1 flex items-center gap-2">
                        <i data-lucide="briefcase" class="w-5 h-5 text-primary-600"></i>
                        Profile Details
                    </h2>
                    <p class="text-body text-sm mb-6">
                        @if($role === 'mentor')
                            Your mentorship expertise and professional background.
                        @else
                            Tell mentors about your startup and what you're building.
                        @endif
                    </p>

                    @if($role === 'mentor')
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="experience" class="block text-sm font-semibold text-heading mb-1.5">Years of Experience</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="clock" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <input type="number" name="experience" id="experience" value="{{ old('experience', $user->experience) }}" min="0" max="50"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all {{ $errors->has('experience') ? 'border-red-500' : '' }}">
                                </div>
                                @error('experience')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-heading mb-1.5">Category</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
                                        <i data-lucide="tag" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <select name="category_id" id="category_id"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all appearance-none {{ $errors->has('category_id') ? 'border-red-500' : '' }}">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $user->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="expertise" class="block text-sm font-semibold text-heading mb-1.5">Area of Expertise</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="award" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <input type="text" name="expertise" id="expertise" value="{{ old('expertise', $user->expertise) }}"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all {{ $errors->has('expertise') ? 'border-red-500' : '' }}">
                                </div>
                                @error('expertise')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="bio" class="block text-sm font-semibold text-heading mb-1.5">Short Bio</label>
                                <textarea name="bio" id="bio" rows="4"
                                    class="w-full px-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all resize-none {{ $errors->has('bio') ? 'border-red-500' : '' }}">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @else
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="industry" class="block text-sm font-semibold text-heading mb-1.5">Industry</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <i data-lucide="briefcase" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <input type="text" name="industry" id="industry" value="{{ old('industry', $user->industry) }}"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all {{ $errors->has('industry') ? 'border-red-500' : '' }}">
                                </div>
                                @error('industry')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="stage" class="block text-sm font-semibold text-heading mb-1.5">Startup Stage</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
                                        <i data-lucide="signal" class="w-4 h-4 text-body"></i>
                                    </div>
                                    <select name="stage" id="stage"
                                        class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all appearance-none {{ $errors->has('stage') ? 'border-red-500' : '' }}">
                                        <option value="">Select your stage</option>
                                        <option value="Idea Stage" {{ old('stage', $user->stage) == 'Idea Stage' ? 'selected' : '' }}>Idea Stage</option>
                                        <option value="MVP" {{ old('stage', $user->stage) == 'MVP' ? 'selected' : '' }}>MVP</option>
                                        <option value="Early Traction" {{ old('stage', $user->stage) == 'Early Traction' ? 'selected' : '' }}>Early Traction</option>
                                        <option value="Growth" {{ old('stage', $user->stage) == 'Growth' ? 'selected' : '' }}>Growth Stage</option>
                                        <option value="Scaling" {{ old('stage', $user->stage) == 'Scaling' ? 'selected' : '' }}>Scaling</option>
                                    </select>
                                </div>
                                @error('stage')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="problem_statement" class="block text-sm font-semibold text-heading mb-1.5">Problem Statement</label>
                                <textarea name="problem_statement" id="problem_statement" rows="4"
                                    class="w-full px-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm text-heading focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all resize-none {{ $errors->has('problem_statement') ? 'border-red-500' : '' }}">{{ old('problem_statement', $user->problem_statement) }}</textarea>
                                @error('problem_statement')
                                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Security Tab --}}
                <div id="tab-security" class="profile-tab-panel" role="tabpanel">
                    <h2 class="text-lg font-bold text-heading mb-1 flex items-center gap-2">
                        <i data-lucide="lock" class="w-5 h-5 text-primary-600"></i>
                        Security
                    </h2>
                    <p class="text-body text-sm mb-6">Update your password to keep your account secure.</p>

                    <div class="rounded-xl bg-amber-50/80 border border-amber-200 p-4 mb-6 flex items-start gap-3">
                        <i data-lucide="info" class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5"></i>
                        <p class="text-sm text-amber-800">Password changes are not yet available in this version. Use <strong>Save Changes</strong> on Account or Profile Details to update your profile.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5 opacity-60 pointer-events-none" aria-hidden="true">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-heading mb-1.5">Current Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i data-lucide="key" class="w-4 h-4 text-body"></i>
                                </div>
                                <input type="password" disabled placeholder="••••••••"
                                    class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-heading mb-1.5">New Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="w-4 h-4 text-body"></i>
                                </div>
                                <input type="password" disabled placeholder="••••••••"
                                    class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-heading mb-1.5">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <i data-lucide="lock-keyhole" class="w-4 h-4 text-body"></i>
                                </div>
                                <input type="password" disabled placeholder="••••••••"
                                    class="w-full pl-10 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit (visible on Account & Profile Details tabs) --}}
                <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row gap-3 justify-between items-center" id="profile-submit-bar">
                    <a href="{{ $role === 'mentor' ? route('dashboard.mentor') : route('dashboard.startup') }}" class="text-sm font-medium text-body hover:text-primary-600 inline-flex items-center gap-1 transition-colors">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Back to Dashboard
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-3.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl shadow-lg shadow-primary-600/25 hover:shadow-primary-600/40 hover:scale-[1.02] transition-all btn-shine flex items-center justify-center gap-2 text-sm">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabBtns = document.querySelectorAll('.profile-tab-btn');
        const tabPanels = document.querySelectorAll('.profile-tab-panel');
        const submitBar = document.getElementById('profile-submit-bar');

        function switchTab(tabId) {
            tabBtns.forEach(function(btn) {
                const isActive = btn.dataset.tab === tabId;
                btn.classList.toggle('active', isActive);
                btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });
            tabPanels.forEach(function(panel) {
                panel.classList.toggle('active', panel.id === 'tab-' + tabId);
            });
            if (submitBar) {
                submitBar.style.display = tabId === 'security' ? 'none' : 'flex';
            }
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        tabBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                switchTab(btn.dataset.tab);
            });
        });

        @if($errors->has('name') || $errors->has('email') || $errors->has('founder_name') || $errors->has('startup_name'))
            switchTab('account');
        @elseif($errors->has('experience') || $errors->has('category_id') || $errors->has('expertise') || $errors->has('bio') || $errors->has('industry') || $errors->has('stage') || $errors->has('problem_statement'))
            switchTab('profile-details');
        @endif

        lucide.createIcons();
    });
</script>
@endsection

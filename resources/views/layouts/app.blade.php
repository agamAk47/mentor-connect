<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'MentorConnect - A platform for startups to find and connect with experienced mentors for guidance and growth.')">
    <title>@yield('title', 'MentorConnect - Startup Mentorship Platform')</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50:  '#EEEEFF',
                            100: '#D5D8FF',
                            200: '#ABABFF',
                            300: '#8B8DFF',
                            400: '#7B6FFF',
                            500: '#5B6CFF',
                            600: '#4A5AEE',
                            700: '#3A48CC',
                            800: '#2A36AA',
                            900: '#1A2488',
                        },
                        secondary: {
                            DEFAULT: '#8B6DFF',
                            50:  '#F3EEFF',
                            100: '#E4DAFF',
                            200: '#C9B5FF',
                            300: '#AE90FF',
                            400: '#9A7EFF',
                            500: '#8B6DFF',
                            600: '#7A5AEE',
                            700: '#6948CC',
                            800: '#5836AA',
                            900: '#472488',
                        },
                        accent: {
                            DEFAULT: '#FF8A5B',
                            50:  '#FFF5F0',
                            100: '#FFE6D9',
                            200: '#FFCDB3',
                            300: '#FFB48D',
                            400: '#FF9F74',
                            500: '#FF8A5B',
                            600: '#EE7A4A',
                            700: '#CC6839',
                            800: '#AA5628',
                            900: '#884418',
                        },
                        violet:  '#8B6DFF',
                        coral:   '#FF8A5B',
                        teal:    '#14C8B0',
                        teallt:  '#63E6D8',
                        success: '#10B981',
                        warning: '#F59E0B',
                        dark:    '#0F172A',
                        surface: '#F7F9FC',
                        heading: '#0F172A',
                        body:    '#64748B',
                    },
                    fontFamily: {
                        display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        sans:    ['Inter', 'system-ui', 'sans-serif'],
                    },
                    borderRadius: {
                        '2xl': '1rem',
                        '3xl': '1.5rem',
                        '4xl': '2rem',
                    },
                },
            },
        }
    </script>

    <!-- Google Fonts - Plus Jakarta Sans + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        h1, h2, h3, .font-display {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        }

        /* ── Brand gradient ── */
        .brand-gradient {
            background: linear-gradient(135deg, #5B6CFF 0%, #8B6DFF 50%, #FF8A5B 100%);
        }
        .brand-gradient-text {
            background: linear-gradient(135deg, #5B6CFF 0%, #8B6DFF 55%, #FF8A5B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        /* "mentor." word — blue-violet */
        .hero-accent-text {
            background: linear-gradient(90deg, #5B6CFF 0%, #8B6DFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        /* Teal accent gradient */
        .teal-gradient-text {
            background: linear-gradient(90deg, #14C8B0, #63E6D8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Legacy aliases kept for other pages */
        .gradient-text  { background: linear-gradient(135deg, #5B6CFF, #8B6DFF, #FF8A5B); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .gradient-bg    { background: linear-gradient(135deg, #5B6CFF, #8B6DFF, #FF8A5B); }

        /* ── Pill button ── */
        .btn-primary {
            background: linear-gradient(135deg, #5B6CFF 0%, #8B6DFF 100%);
            color: #fff;
            border-radius: 9999px;
            font-weight: 600;
            box-shadow: 0 8px 24px rgba(91,108,255,0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(91,108,255,0.45);
        }
        .btn-outline {
            background: #fff;
            color: #0F172A;
            border-radius: 9999px;
            border: 1.5px solid #E2E8F0;
            font-weight: 600;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        }
        .btn-outline:hover {
            transform: translateY(-2px);
            border-color: #8B6DFF;
            box-shadow: 0 6px 20px rgba(139,109,255,0.15);
        }

        /* ── Glass card ── */
        .glass-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 24px;
        }
        .card-hover {
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 48px rgba(91,108,255,0.12);
        }

        /* ── Glow blobs ── */
        .glow-blob {
            border-radius: 50%;
            filter: blur(72px);
            opacity: 0.55;
            pointer-events: none;
        }

        /* ── Animations ── */
        @keyframes fadeInUp {
            from { opacity:0; transform:translateY(28px); }
            to   { opacity:1; transform:translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity:0; transform:translateX(-28px); }
            to   { opacity:1; transform:translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity:0; transform:translateX(28px); }
            to   { opacity:1; transform:translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity:0; transform:scale(0.92); }
            to   { opacity:1; transform:scale(1); }
        }
        @keyframes float {
            0%,100% { transform:translateY(0); }
            50%      { transform:translateY(-10px); }
        }
        @keyframes slideDown {
            from { opacity:0; transform:translateY(-20px); }
            to   { opacity:1; transform:translateY(0); }
        }
        @keyframes slideUp {
            from { opacity:1; transform:translateY(0); }
            to   { opacity:0; transform:translateY(-20px); }
        }
        @keyframes blob {
            0%,100% { transform:translate(0,0) scale(1); }
            33%      { transform:translate(30px,-20px) scale(1.05); }
            66%      { transform:translate(-20px,20px) scale(0.95); }
        }
        @keyframes pulseGlow {
            0%,100% { box-shadow: 0 0 0 0 rgba(91,108,255,0.4); }
            50%     { box-shadow: 0 0 0 12px rgba(91,108,255,0); }
        }
        @keyframes shimmer {
            from { left:-150%; }
            to   { left:150%; }
        }
        @keyframes gradientShift {
            0%   { background-position:0% 50%; }
            50%  { background-position:100% 50%; }
            100% { background-position:0% 50%; }
        }
        .animate-fade-in-up          { animation: fadeInUp 0.8s ease-out forwards; }
        .animate-fade-in-up-delay-1  { animation: fadeInUp 0.8s ease-out 0.2s forwards; opacity:0; }
        .animate-fade-in-up-delay-2  { animation: fadeInUp 0.8s ease-out 0.4s forwards; opacity:0; }
        .animate-fade-in-up-delay-3  { animation: fadeInUp 0.8s ease-out 0.6s forwards; opacity:0; }
        .animate-fade-in-left        { animation: fadeInLeft 0.7s ease-out forwards; }
        .animate-fade-in-right       { animation: fadeInRight 0.7s ease-out forwards; }
        .animate-scale-in            { animation: scaleIn 0.5s ease-out forwards; }
        .animate-float               { animation: float 3.5s ease-in-out infinite; }
        .animate-blob                { animation: blob 8s ease-in-out infinite; }
        .animate-blob-delay          { animation: blob 8s ease-in-out 2s infinite; }
        .animate-slide-down          { animation: slideDown 0.4s ease-out forwards; }
        .animate-slide-up            { animation: slideUp 0.3s ease-in forwards; }
        .animate-pulse-glow          { animation: pulseGlow 2s ease-in-out infinite; }
        .animate-gradient            { background-size:200% 200%; animation: gradientShift 4s ease infinite; }

        /* ── Micro-interactions ── */
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), box-shadow 0.3s;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(91,108,255,0.15);
        }
        .hover-scale {
            transition: transform 0.2s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .focus-ring {
            transition: box-shadow 0.2s, border-color 0.2s;
        }
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(91,108,255,0.15);
            border-color: #5B6CFF;
        }

        /* ── Shimmer effect for buttons ── */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: 0; left: -150%;
            width: 50%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }

        /* ── Navbar ── */
        .navbar-glass {
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* ── Smooth scroll ── */
        html { scroll-behavior: smooth; }

        /* ── Button shine ── */
        .btn-shine { position:relative; overflow:hidden; }
        .btn-shine::after {
            content:''; position:absolute; top:-50%; left:-50%;
            width:200%; height:200%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.18), transparent);
            transform:rotate(45deg); transition:left 0.6s;
            pointer-events: none;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-white text-body font-sans antialiased">

    {{-- ========== NAVIGATION ========== --}}
    <nav class="navbar-glass fixed top-0 left-0 right-0 z-50 border border-white/20 shadow-xl" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    {{-- SVG logo mark: two people + connecting arc, gradient cyan→blue→violet --}}
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="lg1" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse">
                                <stop offset="0%"   stop-color="#14C8B0"/>
                                <stop offset="45%"  stop-color="#5B6CFF"/>
                                <stop offset="100%" stop-color="#8B6DFF"/>
                            </linearGradient>
                        </defs>
                        {{-- Left person head --}}
                        <circle cx="9" cy="7" r="3.5" fill="url(#lg1)"/>
                        {{-- Right person head --}}
                        <circle cx="27" cy="7" r="3.5" fill="url(#lg1)"/>
                        {{-- Left person body --}}
                        <path d="M4 22c0-4 2.5-7 5-8.5S14 12 14 12" stroke="url(#lg1)" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                        {{-- Right person body --}}
                        <path d="M32 22c0-4-2.5-7-5-8.5S22 12 22 12" stroke="url(#lg1)" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                        {{-- Connecting arc / M shape --}}
                        <path d="M9 28 C9 20 14 16 18 16 C22 16 27 20 27 28" stroke="url(#lg1)" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                        {{-- Center link circle --}}
                        <circle cx="18" cy="16" r="3" fill="url(#lg1)"/>
                    </svg>
                    <span class="text-xl font-bold" style="font-family:'Plus Jakarta Sans',sans-serif;">
                        <span style="color:#0F172A;">Mentor</span><span style="background:linear-gradient(90deg,#8B6DFF,#FF8A5B);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Connect</span>
                    </span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-heading hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Home</a>
                    @if(session('user_role') === 'startup')
                        <a href="{{ route('dashboard.startup') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Dashboard</a>
                        <a href="{{ route('mentors.index') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Browse Mentors</a>
                    @elseif(session('user_role') === 'mentor')
                        <a href="{{ route('dashboard.mentor') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Dashboard</a>
                    @elseif(session('user_role') === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all flex items-center gap-1">
                            <i data-lucide="shield-check" class="w-4 h-4"></i> Admin Panel
                        </a>
                        <a href="{{ route('admin.mentors') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Mentors</a>
                        <a href="{{ route('admin.startups') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Startups</a>
                        <a href="{{ route('admin.posts') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Posts</a>
                    @else
                        <a href="#how-it-works" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">How It Works</a>
                        <a href="#benefits" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Benefits</a>
                    @endif
                    <a href="{{ route('posts.index') }}" class="px-4 py-2 text-sm font-medium text-body hover:text-primary-600 rounded-lg hover:bg-primary-50 transition-all">Community</a>
                </div>

                {{-- Auth Buttons (Session-based auth check - Unit IV) --}}
                <div class="hidden md:flex items-center gap-3">
                    @if(session('user_id'))
                        {{-- New Post Button --}}
                        <a href="{{ route('posts.index') }}#create-post" class="px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-xl transition-all shadow-sm flex items-center gap-1.5">
                            <i data-lucide="plus" class="w-4 h-4"></i> Post
                        </a>
                        
                        {{-- Logged In State --}}
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-1.5 bg-surface rounded-xl border border-gray-200 hover:border-primary-300 hover:shadow-sm transition-all group cursor-pointer" title="Edit Profile">
                            <div class="w-7 h-7 rounded-lg gradient-bg flex items-center justify-center group-hover:scale-105 transition-transform">
                                <span class="text-xs font-bold text-white">{{ strtoupper(substr(session('user_name'), 0, 1)) }}</span>
                            </div>
                            <span class="text-sm font-medium text-heading group-hover:text-primary-600 transition-colors">{{ session('user_name') }}</span>
                            @if(session('user_role') === 'admin')
                                <i data-lucide="shield-check" class="w-4 h-4 text-primary-600"></i>
                            @endif
                            <span class="text-xs px-2 py-0.5 rounded-full {{ session('user_role') === 'startup' ? 'bg-primary-50 text-primary-600' : (session('user_role') === 'admin' ? 'bg-slate-100 text-slate-700' : 'bg-indigo-50 text-secondary') }} font-semibold">{{ ucfirst(session('user_role')) }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2.5 text-sm font-semibold text-body hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                <i data-lucide="log-out" class="w-4 h-4 inline"></i> Logout
                            </button>
                        </form>
                    @else
                        {{-- Guest State --}}
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-semibold text-slate-700 border border-slate-200 rounded-full hover:border-violet hover:text-violet transition-all">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary btn-shine px-5 py-2 text-sm inline-block">
                            Get Started
                        </a>
                    @endif
                </div>

                {{-- Mobile menu button --}}
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-xl text-body hover:text-heading hover:bg-gray-100 transition-all">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="md:hidden hidden border-t border-gray-100 bg-white/95 backdrop-blur-lg">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Home</a>
                <a href="{{ route('posts.index') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Community</a>
                @if(session('user_role') === 'startup')
                    <a href="{{ route('dashboard.startup') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Dashboard</a>
                    <a href="{{ route('mentors.index') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Browse Mentors</a>
                @elseif(session('user_role') === 'mentor')
                    <a href="{{ route('dashboard.mentor') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Dashboard</a>
                @elseif(session('user_role') === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Admin Panel</a>
                    <a href="{{ route('admin.mentors') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Mentors</a>
                    <a href="{{ route('admin.startups') }}" class="block px-4 py-3 text-sm font-medium text-heading hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Startups</a>
                @else
                    <a href="#how-it-works" class="block px-4 py-3 text-sm font-medium text-body hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">How It Works</a>
                    <a href="#benefits" class="block px-4 py-3 text-sm font-medium text-body hover:text-primary-600 rounded-xl hover:bg-primary-50 transition-all">Benefits</a>
                @endif
                <hr class="my-2 border-gray-100">
                @if(session('user_id'))
                    <a href="{{ route('posts.index') }}#create-post" class="flex items-center gap-2 px-4 py-3 text-primary-600 hover:bg-primary-50 rounded-xl transition-all font-semibold text-sm">
                        <i data-lucide="plus" class="w-4 h-4"></i> Create Post
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-50 rounded-xl transition-all cursor-pointer" title="Edit Profile">
                        <div class="w-7 h-7 rounded-lg gradient-bg flex items-center justify-center">
                            <span class="text-xs font-bold text-white">{{ strtoupper(substr(session('user_name'), 0, 1)) }}</span>
                        </div>
                        <span class="text-sm font-medium text-heading hover:text-primary-600 transition-colors">{{ session('user_name') }}</span>
                        <span class="text-xs px-2 py-0.5 rounded-full {{ session('user_role') === 'startup' ? 'bg-primary-50 text-primary-600' : 'bg-pink-50 text-accent' }} font-semibold">{{ ucfirst(session('user_role')) }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition-all">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-sm font-medium text-primary-600 hover:bg-primary-50 rounded-xl transition-all">Log In</a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 text-sm font-semibold text-white gradient-bg rounded-xl text-center shadow-lg">Get Started</a>
                @endif
            </div>
        </div>
    </nav>

    {{-- ========== MAIN CONTENT ========== --}}
    <main class="pt-16 lg:pt-20">

        {{-- ========== FLASH MESSAGES (Unit IV - Session Flash Data) ========== --}}
        @if(session('success'))
            <div class="flash-message max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-slide-down">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-lg shadow-emerald-100/50" role="alert">
                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600"></i>
                    </div>
                    <span class="text-sm font-medium flex-1">{{ session('success') }}</span>
                    <button onclick="this.closest('.flash-message').remove()" class="p-1 rounded-lg hover:bg-emerald-100 transition-colors flex-shrink-0" aria-label="Dismiss">
                        <i data-lucide="x" class="w-4 h-4 text-emerald-400"></i>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-slide-down">
                <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-lg shadow-red-100/50" role="alert">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                    </div>
                    <span class="text-sm font-medium flex-1">{{ session('error') }}</span>
                    <button onclick="this.closest('.flash-message').remove()" class="p-1 rounded-lg hover:bg-red-100 transition-colors flex-shrink-0" aria-label="Dismiss">
                        <i data-lucide="x" class="w-4 h-4 text-red-400"></i>
                    </button>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="flash-message max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-slide-down">
                <div class="bg-blue-50 border border-blue-200 text-blue-800 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-lg shadow-blue-100/50" role="alert">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="info" class="w-5 h-5 text-blue-600"></i>
                    </div>
                    <span class="text-sm font-medium flex-1">{{ session('info') }}</span>
                    <button onclick="this.closest('.flash-message').remove()" class="p-1 rounded-lg hover:bg-blue-100 transition-colors flex-shrink-0" aria-label="Dismiss">
                        <i data-lucide="x" class="w-4 h-4 text-blue-400"></i>
                    </button>
                </div>
            </div>
        @endif

        @if(session('warning'))
            <div class="flash-message max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-slide-down">
                <div class="bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-lg shadow-amber-100/50" role="alert">
                    <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600"></i>
                    </div>
                    <span class="text-sm font-medium flex-1">{{ session('warning') }}</span>
                    <button onclick="this.closest('.flash-message').remove()" class="p-1 rounded-lg hover:bg-amber-100 transition-colors flex-shrink-0" aria-label="Dismiss">
                        <i data-lucide="x" class="w-4 h-4 text-amber-400"></i>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ========== FOOTER ========== --}}
    <footer class="bg-heading text-white">
        {{-- Main Footer --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-4">
                        <svg width="32" height="32" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs><linearGradient id="flg" x1="0" y1="0" x2="36" y2="36" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#14C8B0"/><stop offset="45%" stop-color="#5B6CFF"/><stop offset="100%" stop-color="#8B6DFF"/></linearGradient></defs>
                            <circle cx="9" cy="7" r="3.5" fill="url(#flg)"/>
                            <circle cx="27" cy="7" r="3.5" fill="url(#flg)"/>
                            <path d="M4 22c0-4 2.5-7 5-8.5S14 12 14 12" stroke="url(#flg)" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                            <path d="M32 22c0-4-2.5-7-5-8.5S22 12 22 12" stroke="url(#flg)" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                            <path d="M9 28 C9 20 14 16 18 16 C22 16 27 20 27 28" stroke="url(#flg)" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                            <circle cx="18" cy="16" r="3" fill="url(#flg)"/>
                        </svg>
                        <span class="text-xl font-bold text-white" style="font-family:'Plus Jakarta Sans',sans-serif;">MentorConnect</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Empowering startups with the mentorship they need to grow, scale, and succeed.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Platform</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Home</a></li>
                        <li><a href="{{ route('mentors.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Browse Mentors</a></li>
                        <li><a href="{{ route('register.startup') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Register Startup</a></li>
                        <li><a href="{{ route('register.mentor') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Become a Mentor</a></li>
                    </ul>
                </div>

                {{-- Resources --}}
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Resources</h4>
                    <ul class="space-y-3">
                        <li><a href="#how-it-works" class="text-gray-400 hover:text-white text-sm transition-colors">How It Works</a></li>
                        <li><a href="#benefits" class="text-gray-400 hover:text-white text-sm transition-colors">Benefits</a></li>
                        <li><a href="#categories" class="text-gray-400 hover:text-white text-sm transition-colors">Categories</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-gray-400 text-sm">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            support@mentorconnect.com
                        </li>
                        <li class="flex items-center gap-2 text-gray-400 text-sm">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            Mumbai, India
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} MentorConnect. All rights reserved.</p>
                <p class="text-gray-500 text-sm">Built with <span class="text-accent">&hearts;</span> using Laravel & Tailwind CSS</p>
            </div>
        </div>
    </footer>

    {{-- ========== SCRIPTS ========== --}}
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Navbar background on scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-sm');
            } else {
                navbar.classList.remove('shadow-sm');
            }
        });

        // Auto-dismiss flash messages after 5 seconds (Unit IV - Flash Data)
        document.querySelectorAll('.flash-message').forEach(function(msg) {
            setTimeout(function() {
                msg.classList.remove('animate-slide-down');
                msg.classList.add('animate-slide-up');
                setTimeout(function() { msg.remove(); }, 300);
            }, 5000);
        });
    </script>

    @yield('scripts')
</body>
</html>

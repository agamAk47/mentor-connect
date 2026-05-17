<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'MentorConnect Admin Panel')">
    <title>@yield('title', 'Admin | MentorConnect')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 600: '#0D9488', 700: '#0F766E' },
                    },
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
                },
            },
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>body { font-family: 'Inter', system-ui, sans-serif; }</style>
    @yield('styles')
</head>
<body class="bg-slate-50 text-slate-700 antialiased">

    {{-- Desktop Sidebar --}}
    <aside class="hidden lg:flex fixed inset-y-0 left-0 w-64 bg-slate-900 text-slate-300 flex-col z-40">
        <div class="p-6 border-b border-slate-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-xl bg-teal-600 flex items-center justify-center">
                    <i data-lucide="shield-check" class="w-5 h-5 text-white"></i>
                </div>
                <span class="font-bold text-white">MentorConnect</span>
            </a>
            <p class="text-xs text-slate-500 mt-1">Admin Panel</p>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            @php
                $links = [
                    ['route' => 'admin.dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard'],
                    ['route' => 'admin.mentors', 'icon' => 'users-round', 'label' => 'Mentors'],
                    ['route' => 'admin.startups', 'icon' => 'rocket', 'label' => 'Startups'],
                    ['route' => 'admin.requests', 'icon' => 'activity', 'label' => 'Requests'],
                    ['route' => 'admin.posts', 'icon' => 'messages-square', 'label' => 'Posts'],
                    ['route' => 'admin.statistics', 'icon' => 'bar-chart-2', 'label' => 'Statistics'],
                ];
            @endphp
            @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ request()->routeIs($link['route']) ? 'bg-slate-800 text-teal-400 border-l-4 border-teal-500' : 'hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="{{ $link['icon'] }}" class="w-5 h-5"></i>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2 w-full px-4 py-3 text-sm text-red-400 hover:bg-slate-800 rounded-xl transition-all">
                    <i data-lucide="log-out" class="w-5 h-5"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Mobile bottom tab bar --}}
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-slate-900 border-t border-slate-800 z-50 flex justify-around py-2">
        @foreach([
            ['admin.dashboard', 'layout-dashboard'],
            ['admin.mentors', 'users-round'],
            ['admin.startups', 'rocket'],
            ['admin.requests', 'activity'],
            ['admin.posts', 'messages-square'],
        ] as [$route, $icon])
            <a href="{{ route($route) }}" class="flex flex-col items-center p-2 {{ request()->routeIs($route) ? 'text-teal-400' : 'text-slate-400' }}">
                <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
            </a>
        @endforeach
    </nav>

    <div class="lg:pl-64 min-h-screen pb-20 lg:pb-0">
        <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
            <h1 class="text-lg font-bold text-slate-900">@yield('page_title', 'Admin Panel')</h1>
            <div class="flex items-center gap-2 text-sm">
                <i data-lucide="shield-check" class="w-4 h-4 text-teal-600"></i>
                <span class="font-medium text-slate-900">{{ session('user_name') }}</span>
            </div>
        </header>

        <main class="p-6">
            @if(session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm">{{ session('error') }}</div>
            @endif
            @if(session('warning'))
                <div class="mb-4 bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl text-sm">{{ session('warning') }}</div>
            @endif
            @if(session('info'))
                <div class="mb-4 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-xl text-sm">{{ session('info') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>lucide.createIcons();</script>
    @yield('scripts')
</body>
</html>

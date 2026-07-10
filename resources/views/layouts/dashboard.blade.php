<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SuiviHealth')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-navy-900 antialiased bg-mist min-h-screen overflow-x-hidden" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-navy-900/50 z-30 md:hidden"></div>

    <div class="flex min-h-screen">
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-navy-900 text-white transform transition-transform duration-200 md:translate-x-0 md:static md:z-auto flex flex-col shrink-0">

            <div class="flex items-center gap-2.5 px-6 h-16 border-b border-white/10">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="text-coral-500 shrink-0">
                    <path d="M3 12h4l2-7 4 14 2-7h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="font-display font-semibold text-[15px] tracking-tight">SuiviHealth</span>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-0.5 text-sm">
                @yield('sidebar')
            </nav>

            <div class="px-3 py-4 border-t border-white/10">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-semibold shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-medium text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-slate-400 truncate">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="mt-1 w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-slate-400 hover:bg-white/5 hover:text-white transition text-sm">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="sticky top-0 z-20 h-16 bg-white border-b border-slate-100 flex items-center justify-between px-4 md:px-8">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-navy-900">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 5.25h16.5M3.75 12h16.5M3.75 18.75h16.5"/></svg>
                    </button>
                    <h1 class="font-display font-semibold text-lg text-navy-900">@yield('page-title', 'Tableau de bord')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <button class="relative text-slate-500 hover:text-navy-900" aria-label="Notifications">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                        <span class="absolute -top-0.5 -right-0.5 w-2 h-2 bg-coral-500 rounded-full"></span>
                    </button>
                    <div class="w-8 h-8 rounded-full bg-navy-900 text-white flex items-center justify-center text-xs font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
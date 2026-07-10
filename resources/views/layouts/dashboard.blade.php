<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SuiviHealth')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased bg-mist min-h-screen overflow-x-hidden text-[14px]" x-data="{ profileOpen: false }">

    <div class="flex min-h-screen">
        <aside class="hidden md:flex md:static w-[248px] bg-navy-900 flex-col shrink-0">
            <div class="flex items-center gap-2.5 px-5 h-14 border-b border-white/[0.08]">
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" class="text-coral-500 shrink-0">
                    <path d="M3 12h4l2-7 4 14 2-7h6" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="font-semibold text-[14px] text-white tracking-tight">SuiviHealth</span>
            </div>

            <nav class="flex-1 px-2.5 py-4 space-y-0.5">
                @yield('sidebar')
            </nav>

            <div class="px-2.5 py-3 border-t border-white/[0.08]">
                <div class="flex items-center gap-2.5 px-2.5 py-2">
                    <div class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center text-[11px] font-semibold text-white shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[13px] font-medium text-white truncate leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-slate-400 truncate leading-tight">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="mt-0.5 w-full flex items-center gap-2.5 px-2.5 py-2 rounded-md text-slate-400 hover:bg-white/5 hover:text-white transition text-[13px]">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="sticky top-0 z-20 h-14 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-7">
                <h1 class="font-semibold text-[15px] text-slate-900">@yield('page-title', 'Tableau de bord')</h1>

                <div class="flex items-center gap-3">
                    <button class="relative w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100" aria-label="Notifications">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                        <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-coral-500 rounded-full"></span>
                    </button>

                    <div class="w-px h-5 bg-slate-200"></div>

                    <div class="relative">
                        <button @click="profileOpen = !profileOpen" class="w-7 h-7 rounded-full bg-navy-900 text-white flex items-center justify-center text-[11px] font-semibold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </button>
                        <div x-show="profileOpen" x-cloak @click.outside="profileOpen = false" x-transition
                            class="absolute right-0 mt-2 w-44 bg-white rounded-lg border border-slate-200 shadow-lg shadow-slate-200/50 py-1.5 md:hidden">
                            <div class="px-3 py-2 border-b border-slate-100">
                                <p class="text-[13px] font-medium text-slate-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] text-slate-400">{{ ucfirst(auth()->user()->role) }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-3 py-2 text-[13px] text-coral-600 hover:bg-slate-50">Se déconnecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-7 pb-24 md:pb-7">
                @yield('content')
            </main>
        </div>
    </div>

    <nav class="md:hidden fixed bottom-0 inset-x-0 z-30 bg-white border-t border-slate-200 pb-safe">
        <div class="grid grid-cols-3">
            <a href="{{ route('patient.dashboard') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.dashboard') ? 'text-navy-900' : 'text-slate-400' }}">
                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                <span class="text-[10.5px] font-medium">Accueil</span>
            </a>
            <a href="{{ route('patient.consultation.choix') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.consultation.*') ? 'text-navy-900' : 'text-slate-400' }}">
                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                <span class="text-[10.5px] font-medium">Consultation</span>
            </a>
            <a href="{{ route('patient.dossier.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.dossier.*') ? 'text-navy-900' : 'text-slate-400' }}">
                <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                <span class="text-[10.5px] font-medium">Dossier</span>
            </a>
        </div>
    </nav>
</body>
</html>
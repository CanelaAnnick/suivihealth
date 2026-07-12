<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SuiviHealth')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased bg-mist min-h-screen overflow-x-hidden text-[14px]" x-data>
    <aside class="hidden md:flex md:flex-col fixed left-0 top-0 h-screen w-[252px] bg-navy-900 z-40">
        <div class="flex items-center px-5 h-20 border-b border-white/10 shrink-0">
            <div class="bg-white rounded-xl px-3.5 py-2.5 shadow-sm">
                <x-logo class="h-10" />
            </div>
        </div>

        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">
            @yield('sidebar')
        </nav>

        <div class="px-3 py-3.5 border-t border-white/10 shrink-0">
            <div class="flex items-center gap-2.5 px-2.5 py-2">
                <div class="w-8 h-8 rounded-full bg-coral-500 flex items-center justify-center text-[11.5px] font-semibold text-white shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-[13px] font-medium text-white truncate leading-tight">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-teal-300 truncate leading-tight">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mt-0.5 w-full flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-slate-300 hover:bg-white/10 hover:text-white transition text-[13px]">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                    Se déconnecter
                </button>
            </form>
        </div>
    </aside>

    <div class="md:ml-[252px] flex flex-col min-h-screen">
        <header class="sticky top-0 z-20 h-16 bg-white border-b border-slate-200 flex items-center justify-between gap-4 px-5 md:px-8"
        x-data="{ notifOpen: false, profileOpen: false, notifs: [], nonLues: 0 }"
        x-init="
            const charger = () => fetch('{{ route('notifications.index') }}').then(r => r.json()).then(d => { notifs = d.notifications; nonLues = d.non_lues });
            charger();
            setInterval(charger, 10000);
        ">

            <h1 class="font-semibold text-[15.5px] text-slate-900 truncate">@yield('page-title', 'Tableau de bord')</h1>

            <div class="flex items-center gap-3 shrink-0">
                <div class="relative">
                    <button @click="notifOpen = !notifOpen; profileOpen = false" class="relative w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-slate-100 transition" aria-label="Notifications">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                        <span x-show="nonLues > 0" x-cloak class="absolute top-1 right-1 w-2 h-2 bg-coral-500 rounded-full ring-2 ring-white"></span>
                    </button>
                    <div x-show="notifOpen" x-cloak @click.outside="notifOpen = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-xl border border-slate-200 shadow-lg shadow-slate-200/50 z-30 max-h-96 overflow-y-auto">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                            <p class="text-[13px] font-semibold text-slate-900">Notifications</p>
                            <button @click="fetch('{{ route('notifications.tout-lu') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(() => { notifs.forEach(n => n.lu = true); nonLues = 0 })" class="text-[11.5px] text-navy-800 font-medium hover:underline">Tout marquer lu</button>
                        </div>
                        <template x-if="notifs.length === 0">
                            <p class="text-[12.5px] text-slate-400 text-center py-8">Aucune notification.</p>
                        </template>
                        <template x-for="n in notifs" :key="n.id">
                            <div @click="if (!n.lu) { fetch('/notifications/' + n.id + '/lu', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }); n.lu = true; nonLues = Math.max(0, nonLues - 1) }" class="px-4 py-3 border-b border-slate-50 cursor-pointer hover:bg-slate-50" :class="!n.lu && 'bg-teal-50/40'">
                                <p class="text-[12.5px] font-medium text-slate-900" x-text="n.titre"></p>
                                <p class="text-[12px] text-slate-500 mt-0.5" x-text="n.message"></p>
                            </div>
                        </template>
                    </div>
                </div>

                @if (auth()->user()->role === 'medecin')
                    <div class="relative" x-data="{ open: false, demandes: [] }" x-init="
                        const charger = () => fetch('{{ route('medecin.rendezvous.demandes') }}').then(r => r.json()).then(d => demandes = d);
                        charger(); setInterval(charger, 8000);
                    ">
                        <button @click="open = !open" class="relative w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-slate-100 transition" aria-label="Demandes de consultation">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.5a1.125 1.125 0 00-.852-1.09l-4.5-1.125a1.125 1.125 0 00-1.173.417l-.97 1.293a12.05 12.05 0 01-5.649-5.649l1.293-.97a1.125 1.125 0 00.417-1.173L8.09 3.102a1.125 1.125 0 00-1.09-.852h-1.5A2.25 2.25 0 003.25 4.5"/></svg>
                            <span x-show="demandes.length > 0" x-cloak x-text="demandes.length" class="absolute -top-1 -right-1 bg-coral-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center ring-2 ring-white"></span>
                        </button>
                        <div x-show="open" x-cloak @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-xl border border-slate-200 shadow-lg shadow-slate-200/50 z-30 max-h-96 overflow-y-auto">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-[13px] font-semibold text-slate-900">Demandes de consultation immédiate</p>
                            </div>
                            <template x-if="demandes.length === 0">
                                <p class="text-[12.5px] text-slate-400 text-center py-8">Aucune demande en attente.</p>
                            </template>
                            <template x-for="d in demandes" :key="d.id">
                                <div class="px-4 py-3 border-b border-slate-50">
                                    <p class="text-[12.5px] font-medium text-slate-900" x-text="d.patient.user.name"></p>
                                    <p class="text-[12px] text-slate-500 mt-0.5" x-text="'Consultation ' + d.mode + ' immédiate'"></p>
                                    <div class="flex gap-2 mt-2">
                                        <button @click="fetch('/medecin/rendez-vous/' + d.id + '/refuser', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(() => demandes = demandes.filter(x => x.id !== d.id))" class="text-[11.5px] font-medium border border-slate-200 text-slate-600 px-2.5 py-1 rounded-lg hover:bg-slate-50 transition">Refuser</button>
                                        <button @click="fetch('/medecin/rendez-vous/' + d.id + '/accepter', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } }).then(() => window.location.href = '/salle/' + d.id)" class="text-[11.5px] font-medium bg-navy-900 text-white px-2.5 py-1 rounded-lg hover:bg-navy-800 transition">Accepter</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                @endif
                <div class="w-px h-6 bg-slate-200 shrink-0"></div>

                <div class="relative shrink-0">
                    <button @click="profileOpen = !profileOpen; notifOpen = false" class="w-8 h-8 rounded-full bg-navy-900 text-white flex items-center justify-center text-[11.5px] font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </button>
                    <div x-show="profileOpen" x-cloak @click.outside="profileOpen = false" x-transition class="absolute right-0 mt-2 w-52 bg-white rounded-xl border border-slate-200 shadow-lg shadow-slate-200/50 py-1.5 z-30">
                        <div class="px-3.5 py-2.5 border-b border-slate-100">
                            <p class="text-[13px] font-medium text-slate-900 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[11.5px] text-slate-400">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3.5 py-2 text-[13px] text-slate-700 hover:bg-slate-50">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="7.5" cy="5" r="2.5"/><path d="M2.5 14a5 5 0 0110 0"/></svg>
                            Mon profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left flex items-center gap-2.5 px-3.5 py-2 text-[13px] text-red-600 hover:bg-slate-50">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/></svg>
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-8 pb-24 md:pb-8">
            @yield('content')
        </main>
    </div>

    <nav class="md:hidden fixed bottom-0 inset-x-0 z-30 bg-white border-t border-slate-200 pb-safe">
        @include('partials.bottomnav-'.auth()->user()->role)
    </nav>

    <x-consultation-modal />

    @stack('scripts')
</body>
</html>
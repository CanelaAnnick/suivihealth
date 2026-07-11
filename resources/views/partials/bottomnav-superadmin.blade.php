<div class="grid grid-cols-4">
    <a href="{{ route('superadmin.dashboard') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('superadmin.dashboard') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
        <span class="text-[9.5px] font-medium">Accueil</span>
    </a>
    <a href="{{ route('superadmin.hopitaux.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('superadmin.hopitaux.index') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 21h16.5M4.5 3h15l-.75 18h-13.5L4.5 3zM9 8.25h1.5m3 0H15"/></svg>
        <span class="text-[9.5px] font-medium">Hôpitaux</span>
    </a>
    <a href="{{ route('superadmin.admins.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('superadmin.admins.index') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="text-[9.5px] font-medium">Admins</span>
    </a>
    <a href="{{ route('superadmin.statistiques') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('superadmin.statistiques') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75z"/></svg>
        <span class="text-[9.5px] font-medium">Stats</span>
    </a>
</div>
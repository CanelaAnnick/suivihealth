<div class="grid grid-cols-5">
    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('admin.dashboard') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
        <span class="text-[9px] font-medium">Accueil</span>
    </a>
    <a href="{{ route('admin.medecins.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('admin.medecins.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        <span class="text-[9px] font-medium">Médecins</span>
    </a>
    <a href="{{ route('admin.patients.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('admin.patients.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/></svg>
        <span class="text-[9px] font-medium">Patients</span>
    </a>
    <a href="{{ route('admin.paiements.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('admin.paiements.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 8.25h19.5M2.25 8.25v10.5A2.25 2.25 0 004.5 21h15a2.25 2.25 0 002.25-2.25V8.25M2.25 8.25V6a2.25 2.25 0 012.25-2.25h15A2.25 2.25 0 0121.75 6v2.25"/></svg>
        <span class="text-[9px] font-medium">Paiements</span>
    </a>
    <a href="{{ route('admin.statistiques') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('admin.statistiques') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
        <span class="text-[9px] font-medium">Stats</span>
    </a>
</div>
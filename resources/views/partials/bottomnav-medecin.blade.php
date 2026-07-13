<div class="grid grid-cols-5">
    <a href="{{ route('medecin.dashboard') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('medecin.dashboard') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
        <span class="text-[9px] font-medium">Accueil</span>
    </a>
    <a href="{{ route('medecin.patients') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('medecin.patients') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z"/></svg>
        <span class="text-[9px] font-medium">Patients</span>
    </a>
    <a href="{{ route('medecin.rendezvous') }}" class="relative flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('medecin.rendezvous') ? 'text-navy-900' : 'text-slate-400' }}"
        x-data="{ nb: 0 }" x-init="
            const charger = () => fetch('{{ route('medecin.rendezvous.demandes') }}').then(r => r.json()).then(d => nb = d.length);
            charger(); setInterval(charger, 8000);
        ">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        <span class="text-[9px] font-medium">Rendez-vous</span>
        <span x-show="nb > 0" x-cloak x-text="nb" class="absolute top-0.5 right-3 bg-coral-500 text-white text-[9px] font-bold w-3.5 h-3.5 rounded-full flex items-center justify-center"></span>
    </a>
    <a href="{{ route('medecin.ordonnances') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('medecin.ordonnances') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="text-[9px] font-medium">Ordonn.</span>
    </a>
    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('profile.edit') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="3.5"/><path d="M4.5 20a7.5 7.5 0 0115 0"/></svg>
        <span class="text-[9px] font-medium">Profil</span>
    </a>
</div>
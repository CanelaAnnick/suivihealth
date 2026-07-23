<div x-data="{ moreOpen: false }">
    <div class="grid grid-cols-5">
        <a href="{{ route('patient.dashboard') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.dashboard') ? 'text-navy-900' : 'text-slate-400' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
            <span class="text-[9.5px] font-medium">Accueil</span>
        </a>
        <a href="{{ route('patient.consultation.choix') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.consultation.*') ? 'text-navy-900' : 'text-slate-400' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
            <span class="text-[9.5px] font-medium">Consult.</span>
        </a>
        <a href="{{ route('patient.dossier.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.dossier.*') ? 'text-navy-900' : 'text-slate-400' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            <span class="text-[9.5px] font-medium">Dossier</span>
        </a>
        <a href="{{ route('patient.constantes.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.constantes.*') ? 'text-navy-900' : 'text-slate-400' }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 12h3l2.25-7.5L13.5 19.5l2.25-7.5h4.5"/></svg>
            <span class="text-[9.5px] font-medium">Constantes</span>
        </a>
        <button type="button" @click="moreOpen = true" class="flex flex-col items-center gap-1 py-2.5 text-slate-400">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="5" cy="12" r="1.5" fill="currentColor" stroke="none"/><circle cx="12" cy="12" r="1.5" fill="currentColor" stroke="none"/><circle cx="19" cy="12" r="1.5" fill="currentColor" stroke="none"/></svg>
            <span class="text-[9.5px] font-medium">Plus</span>
        </button>
    </div>

    {{-- Fond sombre --}}
    <div x-show="moreOpen" x-cloak x-transition.opacity @click="moreOpen = false" class="fixed inset-0 bg-slate-900/50 z-40"></div>

    {{-- Panneau coulissant --}}
    <div x-show="moreOpen" x-cloak
        x-transition:enter="transition ease-out duration-250" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full"
        class="fixed bottom-0 inset-x-0 z-50 bg-white rounded-t-2xl pb-safe">
        <div class="flex items-center justify-between px-5 pt-4 pb-2">
            <p class="text-[13px] font-semibold text-slate-900">Plus d'options</p>
            <button @click="moreOpen = false" class="text-slate-400">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>
        <div class="grid grid-cols-4 gap-2 px-4 pb-6 pt-2">
            <a href="{{ route('patient.ordonnances.index') }}" class="flex flex-col items-center gap-1.5 py-3 rounded-xl {{ request()->routeIs('patient.ordonnances.*') ? 'bg-mist text-navy-900' : 'text-slate-500' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-[10.5px] font-medium text-center">Ordonnances</span>
            </a>
            <a href="{{ route('patient.urgence') }}" class="flex flex-col items-center gap-1.5 py-3 rounded-xl {{ request()->routeIs('patient.urgence') ? 'bg-coral-50 text-coral-600' : 'text-coral-500' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                <span class="text-[10.5px] font-medium text-center">Urgence</span>
            </a>
            <a href="{{ route('patient.plaintes.index') }}" class="flex flex-col items-center gap-1.5 py-3 rounded-xl {{ request()->routeIs('patient.plaintes.*') ? 'bg-mist text-navy-900' : 'text-slate-500' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-[10.5px] font-medium text-center">Réclamations</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1.5 py-3 rounded-xl {{ request()->routeIs('profile.edit') ? 'bg-mist text-navy-900' : 'text-slate-500' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="8" r="3.5"/><path d="M4.5 20a7.5 7.5 0 0115 0"/></svg>
                <span class="text-[10.5px] font-medium text-center">Mon profil</span>
            </a>
        </div>
    </div>
</div>
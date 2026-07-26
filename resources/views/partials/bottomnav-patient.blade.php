<div class="grid grid-cols-6">
    <a href="{{ route('patient.dashboard') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.dashboard') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
        <span class="text-[9.5px] font-medium">Accueil</span>
    </a>
    <a href="{{ route('patient.consultation.choix') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.consultation.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
        <span class="text-[9.5px] font-medium">Consult.</span>
    </a>
    <a href="{{ route('patient.dossier.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.dossier.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
        <span class="text-[9.5px] font-medium">Dossier</span>
    </a>
    <a href="{{ route('patient.constantes.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.constantes.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M3.75 12h3l2.25-7.5L13.5 19.5l2.25-7.5h4.5"/></svg>
        <span class="text-[9.5px] font-medium">Constantes</span>
    </a>
    <a href="{{ route('patient.ordonnances.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('patient.ordonnances.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="text-[9.5px] font-medium">Ordonn.</span>
    </a>
    <a href="{{ route('communaute.index') }}" class="flex flex-col items-center gap-1 py-2.5 {{ request()->routeIs('communaute.*') ? 'text-navy-900' : 'text-slate-400' }}">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
        <span class="text-[9.5px] font-medium">Communauté</span>
    </a>

<a href="{{ route('chatbot.index') }}"
   class="fixed bottom-20 right-4 z-40 w-14 h-14 bg-teal-600 hover:bg-teal-700 rounded-full shadow-lg flex items-center justify-center transition">
    <svg width="24" height="24" fill="none" stroke="white" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
        <path d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
    </svg>
</a>

</div>
@php
    $icon = fn($path) => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">'.$path.'</svg>';
@endphp

<x-nav-item :route="route('medecin.dashboard')" :active="$active === 'accueil'" :icon="$icon('<path d=\'M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25\'/>')">
    Accueil
</x-nav-item>
<x-nav-item :route="route('medecin.patients')" :active="$active === 'patients'" :icon="$icon('<path d=\'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z\'/>')">
    Mes patients
</x-nav-item>
<x-nav-item :route="route('medecin.rendezvous')" :active="$active === 'rdv'" :icon="$icon('<path d=\'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5\'/>')">
    Rendez-vous
</x-nav-item>
<x-nav-item :route="route('medecin.ordonnances')" :active="$active === 'ordonnances'" :icon="$icon('<path d=\'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'/>')">
    Ordonnances
</x-nav-item>
<div class="pt-2 mt-2 border-t border-white/10">
    <x-nav-item :route="route('profile.edit')" :active="$active === 'profil'" :icon="$icon('<circle cx=\'12\' cy=\'8\' r=\'3.5\'/><path d=\'M4.5 20a7.5 7.5 0 0115 0\'/>')">
        Mon profil
    </x-nav-item>
</div>
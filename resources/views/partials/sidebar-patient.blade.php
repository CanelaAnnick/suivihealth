@php
    $icon = fn($path) => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">'.$path.'</svg>';
@endphp

<x-nav-item :route="route('patient.dashboard')" :active="$active === 'accueil'" :icon="$icon('<path d=\'M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25\'/>')">
    Accueil
</x-nav-item>
<x-nav-item :route="route('patient.consultation.choix')" :active="$active === 'consultation'" :icon="$icon('<path d=\'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5\'/>')">
    Consultation
</x-nav-item>
<x-nav-item :route="route('patient.dossier.index')" :active="$active === 'dossier'" :icon="$icon('<path d=\'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z\'/>')">
    Dossier médical
</x-nav-item>
<x-nav-item :route="route('patient.constantes.index')" :active="$active === 'constantes'" :icon="$icon('<path d=\'M3.75 12h3l2.25-7.5L13.5 19.5l2.25-7.5h4.5\'/>')">
    Mes constantes
</x-nav-item>
<x-nav-item :route="route('patient.ordonnances.index')" :active="$active === 'ordonnances'" :icon="$icon('<path d=\'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'/>')">
    Ordonnances
</x-nav-item>

<div class="pt-2 mt-2 border-t border-white/10">
    <x-nav-item :route="route('profile.edit')" :active="$active === 'profil'" :icon="$icon('<circle cx=\'12\' cy=\'8\' r=\'3.5\'/><path d=\'M4.5 20a7.5 7.5 0 0115 0\'/>')">
        Mon profil
    </x-nav-item>
</div>
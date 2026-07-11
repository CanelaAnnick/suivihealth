@php
    $icon = fn($path) => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">'.$path.'</svg>';
@endphp

<x-nav-item :route="route('superadmin.dashboard')" :active="$active === 'accueil'" :icon="$icon('<path d=\'M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25\'/>')">
    Accueil
</x-nav-item>
<x-nav-item :route="route('superadmin.hopitaux.index')" :active="$active === 'hopitaux'" :icon="$icon('<path d=\'M3.75 21h16.5M4.5 3h15l-.75 18h-13.5L4.5 3zM9 8.25h1.5m3 0H15M9 12h1.5m3 0H15\'/>')">
    Hôpitaux
</x-nav-item>
<x-nav-item :route="route('superadmin.admins.index')" :active="$active === 'admins'" :icon="$icon('<path d=\'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'/>')">
    Administrateurs
</x-nav-item>
<x-nav-item :route="route('superadmin.statistiques')" :active="$active === 'stats'" :icon="$icon('<path d=\'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z\'/>')">
    Statistiques
</x-nav-item>
<div class="pt-2 mt-2 border-t border-white/10">
    <x-nav-item :route="route('profile.edit')" :active="$active === 'profil'" :icon="$icon('<circle cx=\'12\' cy=\'8\' r=\'3.5\'/><path d=\'M4.5 20a7.5 7.5 0 0115 0\'/>')">
        Mon profil
    </x-nav-item>
</div>
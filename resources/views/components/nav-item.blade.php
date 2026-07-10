@props(['route', 'icon', 'active' => false])

<a href="{{ $route }}" @class([
    'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition',
    'bg-white/10 text-white' => $active,
    'text-slate-400 hover:bg-white/5 hover:text-white' => ! $active,
])>
    <span class="shrink-0">{!! $icon !!}</span>
    {{ $slot }}
</a>
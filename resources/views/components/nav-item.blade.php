@props(['route', 'icon', 'active' => false])

<a href="{{ $route }}" @class([
    'flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium transition',
    'bg-white text-navy-900 shadow-sm' => $active,
    'text-slate-300 hover:bg-white/10 hover:text-white' => ! $active,
])>
    <span class="shrink-0">{!! $icon !!}</span>
    {{ $slot }}
</a>
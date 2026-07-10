@props(['route', 'icon', 'active' => false])

<a href="{{ $route }}" @class([
    'flex items-center gap-2.5 px-2.5 py-2 rounded-md text-[13px] font-medium transition',
    'bg-white text-navy-900' => $active,
    'text-slate-400 hover:bg-white/5 hover:text-white' => ! $active,
])>
    <span class="shrink-0">{!! $icon !!}</span>
    {{ $slot }}
</a>
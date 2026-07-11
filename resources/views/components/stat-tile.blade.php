@props(['icon', 'label', 'value', 'badge' => 'bg-navy-900/5 text-navy-800', 'sub' => null])

<div class="bg-white border border-slate-200 rounded-2xl p-4">
    <div class="w-10 h-10 rounded-xl {{ $badge }} flex items-center justify-center">
        {!! $icon !!}
    </div>
    <p class="text-[12px] text-slate-500 mt-3.5">{{ $label }}</p>
    <p class="text-[20px] font-semibold text-slate-900 mt-0.5 leading-none">{{ $value }}</p>
    @if ($sub)
        <p class="text-[11px] text-slate-400 mt-1.5">{{ $sub }}</p>
    @endif
</div>
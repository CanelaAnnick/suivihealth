@props(['title', 'action' => null])

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <h3 class="text-[13.5px] font-semibold text-slate-900">{{ $title }}</h3>
        @if ($action) {!! $action !!} @endif
    </div>
    <div>{{ $slot }}</div>
</div>
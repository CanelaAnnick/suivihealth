@props(['size' => 'h-9', 'textSize' => 'text-lg', 'textColor' => 'text-white'])

<div class="flex items-center gap-2.5">
    <img src="{{ asset('images/logo-icon.png') }}" alt="SuiviHealth" class="{{ $size }} w-auto object-contain shrink-0">
    <span class="{{ $textSize }} {{ $textColor }} font-bold tracking-tight whitespace-nowrap">SuiviHealth</span>
</div>
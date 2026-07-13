@props(['user', 'size' => 'w-8 h-8', 'text' => 'text-[11.5px]', 'bg' => 'bg-navy-900 text-white'])

@if ($user->photo)
    <img src="{{ asset('uploads/'.$user->photo) }}" class="{{ $size }} rounded-full object-cover">
@else
    <div class="{{ $size }} rounded-full {{ $bg }} flex items-center justify-center {{ $text }} font-semibold">
        {{ strtoupper(substr($user->name, 0, 2)) }}
    </div>
@endif
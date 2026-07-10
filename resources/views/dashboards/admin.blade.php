@extends('layouts.guest')
@section('title', 'Espace Patient — SuiviHealth')
@section('content')

<div class="min-h-screen flex items-center justify-center px-6">
    <div class="text-center">
        <h1 class="font-display text-2xl font-semibold text-navy-900">Bienvenue, {{ auth()->user()->name }}</h1>
        <p class="text-slate-600 mt-2">Espace Admin — en construction</p>
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button class="text-sm text-coral-600 font-medium">Se déconnecter</button>
        </form>
    </div>
</div>
@endsection
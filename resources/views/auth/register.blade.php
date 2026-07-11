@extends('layouts.guest')
@section('title', 'Inscription — SuiviHealth')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
    <a href="{{ route('home') }}" class="mb-8">
        <x-logo class="h-14" />
    </a>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-100 p-8">
        <h1 class="font-display text-2xl font-semibold text-navy-900 mb-1">Créer un compte patient</h1>
        <p class="text-slate-500 text-sm mb-6">Rejoignez SuiviHealth en quelques minutes</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium text-navy-900">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                @error('name') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-navy-900">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                @error('email') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-navy-900">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                @error('password') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-navy-900">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                    class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
            </div>
            <button type="submit" class="w-full bg-coral-500 text-white font-semibold py-3 rounded-lg hover:bg-coral-600 transition">
                S'inscrire
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-teal-600 font-medium hover:underline">Se connecter</a>
        </p>
    </div>
</div>
@endsection
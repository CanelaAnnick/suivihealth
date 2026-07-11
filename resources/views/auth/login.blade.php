@extends('layouts.guest')
@section('title', 'Connexion — SuiviHealth')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
    <a href="{{ route('home') }}" class="mb-8">
        <x-logo class="h-14" />
    </a>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-100 p-8">
        <h1 class="font-display text-2xl font-semibold text-navy-900 mb-1">Connexion</h1>
        <p class="text-slate-500 text-sm mb-6">Accédez à votre espace SuiviHealth</p>

        @if (session('status'))
            <div class="mb-4 text-sm text-teal-600">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium text-navy-900">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                @error('email') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-sm font-medium text-navy-900">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full mt-1 rounded-lg border-slate-200 focus:border-teal-600 focus:ring-teal-600">
                @error('password') <p class="text-coral-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-coral-500">
                    Se souvenir de moi
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-teal-600 hover:underline">Mot de passe oublié ?</a>
                @endif
            </div>
            <button type="submit" class="w-full bg-navy-900 text-white font-semibold py-3 rounded-lg hover:bg-navy-800 transition">
                Se connecter
            </button>
        </form>

        <p class="text-center text-sm text-slate-500 mt-6">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-coral-600 font-medium hover:underline">S'inscrire</a>
        </p>
    </div>
</div>
@endsection
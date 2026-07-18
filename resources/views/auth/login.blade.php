@extends('layouts.guest')
@section('title', 'Connexion — SuiviHealth')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-8">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-100 p-7">

        <div class="flex items-center justify-center mb-6">
            <a href="{{ route('home') }}"><x-logo class="h-10" /></a>
        </div>

        <h1 class="font-semibold text-[18px] text-navy-900 mb-1">Connexion</h1>
        <p class="text-slate-500 text-[13px] mb-5">Accédez à votre espace SuiviHealth</p>

        @if (session('status'))
            <div class="mb-4 text-[13px] text-teal-600">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-3.5">
            @csrf
            <div>
                <label class="text-[12.5px] font-medium text-navy-900">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-teal-600 focus:ring-teal-600">
                @error('email') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-[12.5px] font-medium text-navy-900">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-teal-600 focus:ring-teal-600">
                @error('password') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between text-[12.5px]">
                <label class="flex items-center gap-2 text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-coral-500">
                    Se souvenir de moi
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-teal-600 hover:underline">Mot de passe oublié ?</a>
                @endif
            </div>

            <button type="submit" class="w-full bg-navy-900 text-white font-semibold py-2.5 rounded-lg hover:bg-navy-800 transition text-[13.5px]">
                Se connecter
            </button>
        </form>

        <p class="text-center text-[12.5px] text-slate-500 mt-5">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-coral-600 font-medium hover:underline">S'inscrire</a>
        </p>
    </div>
</div>
@endsection
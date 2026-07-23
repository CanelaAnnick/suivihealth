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

            <div x-data="{ show: false }">
                <label class="text-[12.5px] font-medium text-navy-900">Mot de passe</label>
                <div class="relative mt-1">
                    <input :type="show ? 'text' : 'password'" name="password" required
                        class="w-full rounded-lg border-slate-200 text-[13px] focus:border-teal-600 focus:ring-teal-600 pr-10">
                    <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                        <svg x-show="!show" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.64 0 8.577 3.01 9.964 7.183.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.64 0-8.577-3.01-9.964-7.178z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg x-show="show" x-cloak width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.774 3.162 10.066 7.5a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.243L9.88 9.88"/></svg>
                    </button>
                </div>
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
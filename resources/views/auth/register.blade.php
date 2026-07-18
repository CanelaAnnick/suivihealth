@extends('layouts.guest')
@section('title', 'Inscription — SuiviHealth')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-8">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-100 p-7">

        <div class="flex items-center justify-center mb-6">
            <a href="{{ route('home') }}"><x-logo class="h-10" /></a>
        </div>

        <h1 class="font-semibold text-[18px] text-navy-900 mb-1">Créer un compte patient</h1>
        <p class="text-slate-500 text-[13px] mb-5">Rejoignez SuiviHealth en quelques minutes</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
            @csrf
            <div>
                <label class="text-[12.5px] font-medium text-navy-900">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-teal-600 focus:ring-teal-600">
                @error('name') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-[12.5px] font-medium text-navy-900">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-teal-600 focus:ring-teal-600">
                @error('email') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-[12.5px] font-medium text-navy-900">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-teal-600 focus:ring-teal-600">
                @error('password') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-[12.5px] font-medium text-navy-900">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                    class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-teal-600 focus:ring-teal-600">
            </div>

            <button type="submit" class="w-full bg-coral-500 text-white font-semibold py-2.5 rounded-lg hover:bg-coral-600 transition text-[13.5px]">
                S'inscrire
            </button>
        </form>

        <p class="text-center text-[12.5px] text-slate-500 mt-5">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-teal-600 font-medium hover:underline">Se connecter</a>
        </p>
    </div>
</div>
@endsection
@extends('layouts.guest')
@section('title', 'Mot de passe oublié — SuiviHealth')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
    <a href="{{ route('home') }}" class="mb-8"><x-logo class="h-14" /></a>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-100 p-8">
        <h1 class="font-semibold text-[18px] text-slate-900 mb-1">Mot de passe oublié</h1>
        <p class="text-slate-500 text-[13px] mb-6">Indiquez votre email, nous vous enverrons un lien de réinitialisation.</p>

        @if (session('status'))
            <div class="mb-4 text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('email') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Envoyer le lien</button>
        </form>

        <p class="text-center text-[13px] text-slate-500 mt-6">
            <a href="{{ route('login') }}" class="text-navy-800 font-medium hover:underline">Retour à la connexion</a>
        </p>
    </div>
</div>
@endsection
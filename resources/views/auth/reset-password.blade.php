@extends('layouts.guest')
@section('title', 'Réinitialiser le mot de passe — SuiviHealth')
@section('content')

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
    <a href="{{ route('home') }}" class="mb-8"><x-logo class="h-14" /></a>

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-100 p-8">
        <h1 class="font-semibold text-[18px] text-slate-900 mb-1">Réinitialiser le mot de passe</h1>
        <p class="text-slate-500 text-[13px] mb-6">Choisissez un nouveau mot de passe.</p>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $request->email) }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('email') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Nouveau mot de passe</label>
                <input type="password" name="password" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('password') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Confirmer</label>
                <input type="password" name="password_confirmation" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Réinitialiser</button>
        </form>
    </div>
</div>
@endsection
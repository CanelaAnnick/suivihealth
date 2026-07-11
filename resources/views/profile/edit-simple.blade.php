@extends('layouts.dashboard')
@section('title', 'Mon profil — SuiviHealth')
@section('page-title', 'Mon profil')

@section('sidebar')
    @include('partials.sidebar-'.auth()->user()->role, ['active' => ''])
@endsection

@section('content')
<div class="max-w-lg space-y-5">

    @if (session('status') === 'password-updated')
        <div class="text-[13px] text-teal-700 bg-teal-50 px-3.5 py-2 rounded-lg inline-block">Mot de passe mis à jour.</div>
    @endif

    <x-section-card title="Informations du compte">
        <form method="POST" action="{{ route('profile.update') }}" class="p-5 space-y-4">
            @csrf @method('patch')
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Nom complet</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <button type="submit" class="bg-navy-900 text-white text-[13px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Enregistrer</button>
        </form>
    </x-section-card>

    <x-section-card title="Sécurité — Changer mon mot de passe">
        <form method="POST" action="{{ route('password.update') }}" class="p-5 space-y-4">
            @csrf @method('put')
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Mot de passe actuel</label>
                <input type="password" name="current_password" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('current_password', 'updatePassword') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Nouveau mot de passe</label>
                <input type="password" name="password" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('password', 'updatePassword') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Confirmer le nouveau mot de passe</label>
                <input type="password" name="password_confirmation" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <button type="submit" class="bg-navy-900 text-white text-[13px] font-medium px-4 py-2 rounded-lg hover:bg-navy-800 transition">Mettre à jour le mot de passe</button>
        </form>
    </x-section-card>

</div>
@endsection
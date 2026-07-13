@extends('layouts.dashboard')
@section('title', 'Ajouter un hôpital — SuiviHealth')
@section('page-title', 'Ajouter un hôpital')

@section('sidebar')
    @include('partials.sidebar-superadmin', ['active' => 'hopitaux'])
@endsection

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('superadmin.hopitaux.index') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
        Retour
    </a>

    <form method="POST" action="{{ route('superadmin.hopitaux.store') }}" class="bg-white border border-slate-200 rounded-xl p-6 space-y-5">
        @csrf

        <div>
            <p class="text-[13px] font-semibold text-slate-900 mb-3">Informations de l'hôpital</p>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Nom de l'hôpital</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                    @error('nom') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Région</label>
                    <select name="region" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                        @foreach ($regions as $r)<option value="{{ $r }}">{{ $r }}</option>@endforeach
                    </select>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Adresse</label>
                    <input type="text" name="adresse" value="{{ old('adresse') }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                </div>
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                </div>
            </div>
        </div>

        <div class="pt-5 border-t border-slate-100">
            <p class="text-[13px] font-semibold text-slate-900 mb-3">Compte administrateur de cet hôpital</p>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Nom complet</label>
                <input type="text" name="admin_name" value="{{ old('admin_name') }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <div class="grid sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Email</label>
                    <input type="email" name="admin_email" value="{{ old('admin_email') }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                    @error('admin_email') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-[12.5px] font-medium text-slate-700">Mot de passe temporaire</label>
                    <input type="text" name="admin_password" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Créer l'hôpital et l'administrateur</button>
    </form>
</div>
@endsection
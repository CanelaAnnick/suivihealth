@extends('layouts.dashboard')
@section('title', 'Ajouter un médecin — SuiviHealth')
@section('page-title', 'Ajouter un médecin')

@section('sidebar')
    @include('partials.sidebar-admin', ['active' => 'medecins'])
@endsection

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.medecins.index') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
        Retour
    </a>

    <form method="POST" action="{{ route('admin.medecins.store') }}" class="bg-white border border-slate-200 rounded-xl p-6 space-y-4">
        @csrf
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('name') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('email') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Mot de passe temporaire</label>
            <input type="text" name="password" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800" placeholder="Le médecin pourra le changer dans son profil">
            @error('password') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Spécialité</label>
                <input type="text" name="specialite" value="{{ old('specialite') }}" required placeholder="Ex : Médecine générale, Cardiologie" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Type</label>
                <select name="type" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                    <option value="generaliste">Généraliste</option>
                    <option value="specialiste">Spécialiste</option>
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Région</label>
                <select name="region" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                    @foreach ($regions as $r)
                        <option value="{{ $r }}">{{ $r }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Hôpital</label>
                <input type="text" name="hopital" value="{{ old('hopital') }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-4">
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">N° d'ordre</label>
                <input type="text" name="numero_ordre" value="{{ old('numero_ordre') }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                @error('numero_ordre') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone') }}" class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
            <div>
                <label class="text-[12.5px] font-medium text-slate-700">Tarif (FCFA)</label>
                <input type="number" name="tarif" value="{{ old('tarif', 5000) }}" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            </div>
        </div>

        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Créer le compte médecin</button>
    </form>
</div>
@endsection
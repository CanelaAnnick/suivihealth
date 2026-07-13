@extends('layouts.dashboard')
@section('title', 'Ajouter un administrateur — SuiviHealth')
@section('page-title', 'Ajouter un administrateur')

@section('sidebar')
    @include('partials.sidebar-superadmin', ['active' => 'admins'])
@endsection

@section('content')
<div class="max-w-xl">
    <a href="{{ route('superadmin.admins.index') }}" class="inline-flex items-center gap-1.5 text-[12.5px] text-slate-500 hover:text-slate-900 mb-5">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 3L5 8l6 5"/></svg>
        Retour
    </a>

    <form method="POST" action="{{ route('superadmin.admins.store') }}" class="bg-white border border-slate-200 rounded-xl p-6 space-y-4">
        @csrf
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
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Mot de passe temporaire</label>
            <input type="text" name="password" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
            @error('password') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[12.5px] font-medium text-slate-700">Hôpital rattaché</label>
            <select name="hopital_id" required class="w-full mt-1 rounded-lg border-slate-200 text-[13px] focus:border-navy-800 focus:ring-navy-800">
                <option value="">Sélectionner un hôpital</option>
                @foreach ($hopitaux as $h)
                    <option value="{{ $h->id }}">{{ $h->nom }} ({{ $h->region }})</option>
                @endforeach
            </select>
            @error('hopital_id') <p class="text-red-600 text-[11.5px] mt-1">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="w-full bg-navy-900 text-white text-[13px] font-medium py-2.5 rounded-lg hover:bg-navy-800 transition">Créer le compte administrateur</button>
    </form>
</div>
@endsection
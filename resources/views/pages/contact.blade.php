@extends('layouts.app')
@section('title', 'Contact')
@section('content')

<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-16">
    <div>
        <p class="text-coral-600 font-semibold text-sm tracking-wide uppercase mb-3">Contact</p>
        <h1 class="font-display text-3xl font-semibold text-navy-900 mb-6">Une question ? Écrivez-nous</h1>
        <ul class="space-y-4 text-slate-600">
            <li><strong class="text-navy-900">Adresse :</strong> Akwa, Douala, Cameroun</li>
            <li><strong class="text-navy-900">Téléphone :</strong> +237 6XX XXX XXX</li>
            <li><strong class="text-navy-900">Email :</strong> contact@suivihealth.cm</li>
        </ul>
    </div>

    <form class="space-y-4">
        <div>
            <label class="text-sm font-medium text-navy-900">Nom complet</label>
            <input type="text" class="w-full mt-1 rounded-lg border-slate-200">
        </div>
        <div>
            <label class="text-sm font-medium text-navy-900">Email</label>
            <input type="email" class="w-full mt-1 rounded-lg border-slate-200">
        </div>
        <div>
            <label class="text-sm font-medium text-navy-900">Message</label>
            <textarea rows="4" class="w-full mt-1 rounded-lg border-slate-200"></textarea>
        </div>
        <button type="submit" class="bg-coral-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-coral-600 transition">Envoyer</button>
    </form>
</section>
@endsection
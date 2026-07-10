@extends('layouts.app')
@section('title', 'À propos')
@section('content')

<section class="bg-navy-900 py-20 text-center">
    <p class="text-coral-500 font-semibold text-sm tracking-wide uppercase mb-3">À propos de nous</p>
    <h1 class="font-display text-4xl font-semibold text-white max-w-2xl mx-auto">Une plateforme pensée pour le Cameroun, par des Camerounais</h1>
</section>

<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
    <img src="{{ asset('images/about-team.jpg') }}" class="rounded-2xl w-full h-96 object-cover">
    <div>
        <h2 class="font-display text-2xl font-semibold text-navy-900 mb-4">Notre mission</h2>
        <p class="text-slate-600 leading-relaxed mb-4">SuiviHealth est né d'un constat simple : l'accès à un suivi médical régulier reste difficile pour beaucoup de Camerounais, entre distances, disponibilité des médecins et coût des déplacements.</p>
        <p class="text-slate-600 leading-relaxed">Notre équipe développe une plateforme locale, adaptée aux réalités du terrain, pour connecter patients et médecins vérifiés, partout dans le pays.</p>
    </div>
</section>

<section class="bg-mist py-20">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="font-display text-2xl font-semibold text-navy-900 text-center mb-12">Nos valeurs</h2>
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div><h3 class="font-display font-semibold text-lg mb-2">Confiance</h3><p class="text-slate-600 text-sm">Des médecins vérifiés et des données protégées.</p></div>
            <div><h3 class="font-display font-semibold text-lg mb-2">Accessibilité</h3><p class="text-slate-600 text-sm">Un service pensé pour toutes les régions du pays.</p></div>
            <div><h3 class="font-display font-semibold text-lg mb-2">Proximité</h3><p class="text-slate-600 text-sm">Un suivi humain, même à distance.</p></div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.app')
@section('title', 'Accueil')
@section('content')

{{-- HERO SLIDER --}}
<section class="relative h-[520px] md:h-[600px] overflow-hidden bg-navy-900" x-data="{ slide: 0, slides: 3 }" x-init="setInterval(() => slide = (slide + 1) % slides, 6000)">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-1.jpg') }}" x-show="slide === 0" x-transition:enter.duration.700ms class="w-full h-full object-cover opacity-40">
        <img src="{{ asset('images/hero-2.jpg') }}" x-show="slide === 1" x-transition:enter.duration.700ms class="w-full h-full object-cover opacity-40 absolute inset-0">
        <img src="{{ asset('images/hero-3.jpg') }}" x-show="slide === 2" x-transition:enter.duration.700ms class="w-full h-full object-cover opacity-40 absolute inset-0">
    </div>
    <div class="relative max-w-4xl mx-auto text-center px-6 h-full flex flex-col justify-center">
        <p class="text-coral-500 font-semibold text-xs md:text-sm tracking-wide uppercase mb-4">Consultation & suivi médical au Cameroun</p>
        <h1 class="font-display text-3xl md:text-5xl font-semibold text-white leading-tight">La plus grande richesse, c'est la santé.</h1>
        <p class="mt-6 text-slate-200 text-base md:text-lg">SuiviHealth connecte patients et médecins camerounais pour des consultations en ligne ou présentielles, et un suivi continu.</p>
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="bg-coral-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-coral-600 transition">Prendre rendez-vous</a>
            <a href="{{ route('services') }}" class="border border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:text-navy-900 transition">Voir les services</a>
        </div>
    </div>
    <button @click="slide = (slide - 1 + slides) % slides" class="hidden sm:flex absolute left-6 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 text-white items-center justify-center">‹</button>
    <button @click="slide = (slide + 1) % slides" class="hidden sm:flex absolute right-6 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 text-white items-center justify-center">›</button>
</section>

{{-- STATS --}}
<section class="bg-mist py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div><p class="font-display text-3xl font-semibold text-navy-900">120+</p><p class="text-sm text-slate-600 mt-1">Médecins partenaires</p></div>
        <div><p class="font-display text-3xl font-semibold text-navy-900">5 000+</p><p class="text-sm text-slate-600 mt-1">Patients suivis</p></div>
        <div><p class="font-display text-3xl font-semibold text-navy-900">10</p><p class="text-sm text-slate-600 mt-1">Villes couvertes</p></div>
        <div><p class="font-display text-3xl font-semibold text-navy-900">24/7</p><p class="text-sm text-slate-600 mt-1">Disponibilité</p></div>
    </div>
</section>

{{-- SERVICES TEASER --}}
<section class="max-w-7xl mx-auto px-6 py-24">
    <div class="text-center max-w-2xl mx-auto mb-14">
        <p class="text-coral-600 font-semibold text-sm tracking-wide uppercase mb-3">Nos services</p>
        <h2 class="font-display text-3xl font-semibold text-navy-900">Un accompagnement médical complet</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
            <img src="{{ asset('images/doctor-1.jpg') }}" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="font-display font-semibold text-lg mb-2">Consultation en ligne</h3>
                <p class="text-slate-600 text-sm">Rendez-vous avec un médecin, en ligne ou en présentiel.</p>
            </div>
        </div>
        <div class="rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
            <img src="{{ asset('images/doctor-2.jpg') }}" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="font-display font-semibold text-lg mb-2">Suivi médical continu</h3>
                <p class="text-slate-600 text-sm">Votre dossier et votre historique accessibles à tout moment.</p>
            </div>
        </div>
        <div class="rounded-2xl overflow-hidden border border-slate-100 hover:shadow-lg transition">
            <img src="{{ asset('images/doctor-3.jpg') }}" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="font-display font-semibold text-lg mb-2">Chat, audio & vidéo</h3>
                <p class="text-slate-600 text-sm">Échangez avec votre médecin en toute sécurité.</p>
            </div>
        </div>
    </div>
    <div class="text-center mt-10">
        <a href="{{ route('services') }}" class="text-navy-900 font-semibold hover:text-coral-500">Voir tous les services →</a>
    </div>
</section>

{{-- CTA --}}
<section class="bg-navy-900 py-20 text-center">
    <h2 class="font-display text-3xl font-semibold text-white mb-4">Prêt à commencer votre suivi ?</h2>
    <p class="text-slate-300 mb-8">Inscrivez-vous gratuitement en quelques minutes.</p>
    <a href="{{ route('register') }}" class="inline-block bg-coral-500 text-white font-semibold px-8 py-3 rounded-lg hover:bg-coral-600 transition">S'inscrire</a>
</section>
@endsection
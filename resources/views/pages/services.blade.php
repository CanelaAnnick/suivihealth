@extends('layouts.app')
@section('title', 'Services')
@section('content')

<section class="bg-mist py-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <p class="text-coral-600 font-semibold text-sm tracking-wide uppercase mb-3">Nos services</p>
        <h1 class="font-display text-4xl font-semibold text-navy-900">Des soins accessibles, où que vous soyez au Cameroun</h1>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20 space-y-20">

    <div class="grid md:grid-cols-2 gap-12 items-center">
        <img src="{{ asset('images/consultation.jpg') }}" class="rounded-2xl w-full h-80 object-cover">
        <div>
            <h2 class="font-display text-2xl font-semibold text-navy-900 mb-4">Consultation en ligne / présentielle</h2>
            <p class="text-slate-600 leading-relaxed">Prenez rendez-vous avec un médecin selon votre préférence : en cabinet ou en visioconsultation depuis chez vous. Choisissez la spécialité, le créneau disponible, et recevez une confirmation immédiate.</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="md:order-2">
            <img src="{{ asset('images/doctor-2.jpg') }}" class="rounded-2xl w-full h-80 object-cover">
        </div>
        <div class="md:order-1">
            <h2 class="font-display text-2xl font-semibold text-navy-900 mb-4">Suivi médical continu</h2>
            <p class="text-slate-600 leading-relaxed">Votre dossier médical centralisé regroupe historique de consultations, prescriptions, résultats d'analyses et rappels de traitement — accessible à tout moment depuis votre espace patient.</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-center">
        <img src="{{ asset('images/doctor-3.jpg') }}" class="rounded-2xl w-full h-80 object-cover">
        <div>
            <h2 class="font-display text-2xl font-semibold text-navy-900 mb-4">Chat, appels audio & vidéo</h2>
            <p class="text-slate-600 leading-relaxed">Échangez avec votre médecin par messagerie sécurisée, ou passez en appel audio/vidéo directement depuis la plateforme, sans installer d'application tierce.</p>
        </div>
    </div>

</section>
@endsection
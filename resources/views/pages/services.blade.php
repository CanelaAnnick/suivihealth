@extends('layouts.app')
@section('title', 'Services')
@section('content')

<div class="bg-abyss-900">

    <section class="max-w-4xl mx-auto px-6 pt-20 pb-16 text-center">
        <p class="text-teal-400 font-semibold text-sm tracking-wide uppercase mb-3">Ce que nous proposons</p>
        <h1 class="font-display text-4xl md:text-5xl font-semibold text-white mb-6">
            Nos <span class="text-teal-400">services</span>
        </h1>
        <p class="text-slate-400 text-[15px] leading-relaxed max-w-2xl mx-auto">
            Des soins accessibles et un suivi complet, où que vous soyez au Cameroun.
        </p>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16 border-t border-white/5 space-y-20">

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="rounded-[2rem] overflow-hidden border border-white/10">
                <img src="{{ asset('images/consultation.jpg') }}" class="w-full h-[340px] object-cover">
            </div>
            <div>
                <h2 class="font-display text-2xl font-semibold text-white mb-4">Consultation en ligne / présentielle</h2>
                <p class="text-slate-400 text-[14px] leading-relaxed">Prenez rendez-vous avec un médecin selon votre préférence : en cabinet ou en visioconsultation depuis chez vous. Choisissez la spécialité, le créneau disponible, et recevez une confirmation immédiate.</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="md:order-2 rounded-[2rem] overflow-hidden border border-white/10">
                <img src="{{ asset('images/doctor-2.jpg') }}" class="w-full h-[340px] object-cover">
            </div>
            <div class="md:order-1">
                <h2 class="font-display text-2xl font-semibold text-white mb-4">Suivi médical continu</h2>
                <p class="text-slate-400 text-[14px] leading-relaxed">Votre dossier médical centralisé regroupe historique de consultations, prescriptions, résultats et rappels de traitement — accessible à tout moment depuis votre espace patient.</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="rounded-[2rem] overflow-hidden border border-white/10">
                <img src="{{ asset('images/doctor-3.jpg') }}" class="w-full h-[340px] object-cover">
            </div>
            <div>
                <h2 class="font-display text-2xl font-semibold text-white mb-4">Chat, appels audio & vidéo</h2>
                <p class="text-slate-400 text-[14px] leading-relaxed">Échangez avec votre médecin par messagerie sécurisée, ou passez en appel audio/vidéo directement depuis la plateforme, sans installer d'application tierce.</p>
            </div>
        </div>

    </section>

    <section class="max-w-7xl mx-auto px-6 py-24 border-t border-white/5">
        <div class="text-center mb-16">
            <p class="text-coral-400 font-semibold text-sm tracking-wide uppercase mb-3">Comment ça marche</p>
            <h2 class="font-display text-3xl md:text-4xl font-semibold text-white">En 3 étapes simples</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-teal-500 to-teal-700 flex items-center justify-center text-white font-bold text-[18px] mb-5">01</div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Créez votre compte</h3>
                <p class="text-slate-400 text-[13px] max-w-xs mx-auto">Inscrivez-vous en 2 minutes.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-navy-700 to-navy-900 border border-white/10 flex items-center justify-center text-white font-bold text-[18px] mb-5">02</div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Choisissez un médecin</h3>
                <p class="text-slate-400 text-[13px] max-w-xs mx-auto">Généraliste ou spécialiste, selon vos besoins.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-coral-500 to-coral-700 flex items-center justify-center text-white font-bold text-[18px] mb-5">03</div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Consultez et suivez</h3>
                <p class="text-slate-400 text-[13px] max-w-xs mx-auto">Chat, audio, vidéo, et un dossier à jour.</p>
            </div>
        </div>
    </section>

</div>
@endsection
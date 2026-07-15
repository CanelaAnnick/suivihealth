@extends('layouts.app')
@section('title', 'Accueil')
@section('content')

<div class="bg-abyss-900">

    {{-- HERO --}}
    <section class="relative max-w-7xl mx-auto px-6 pt-16 pb-24 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="inline-flex items-center gap-2 bg-teal-500/10 text-teal-400 text-[11px] font-bold uppercase tracking-wide px-3.5 py-1.5 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-teal-400 rounded-full animate-pulse"></span>
                5 000+ patients suivis au Cameroun
            </span>
            <h1 class="font-display text-4xl md:text-5xl font-semibold text-white leading-tight">
                La plus grande richesse, c'est <span class="text-teal-400">la santé</span>.
            </h1>
            <p class="mt-6 text-slate-400 text-base md:text-lg max-w-lg">
                SuiviHealth connecte patients et médecins camerounais pour des consultations en ligne ou présentielles, et un suivi continu.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-teal-500 to-coral-500 text-white font-semibold px-7 py-3.5 rounded-full hover:opacity-90 transition">Prendre rendez-vous</a>
                <a href="{{ route('services') }}" class="border border-white/20 text-white font-semibold px-7 py-3.5 rounded-full hover:bg-white/5 transition">Découvrir →</a>
            </div>
        </div>

        <div class="relative">
            <div class="rounded-[2rem] overflow-hidden border border-white/10">
                <img src="{{ asset('images/hero-1.jpg') }}" class="w-full h-[420px] object-cover">
            </div>
            <div class="absolute top-6 right-6 bg-abyss-800/90 backdrop-blur border border-white/10 rounded-2xl px-5 py-4">
                <p class="text-teal-400 text-[22px] font-bold leading-none">120+</p>
                <p class="text-[11px] text-slate-400 mt-1">Médecins</p>
            </div>
            <div class="absolute -bottom-6 -left-6 bg-gradient-to-r from-teal-500 to-coral-500 rounded-2xl px-5 py-4 shadow-xl">
                <p class="text-white text-[22px] font-bold leading-none">24/7</p>
                <p class="text-[11px] text-white/80 mt-1">Disponibilité</p>
            </div>
        </div>
    </section>

    {{-- SERVICES --}}
    <section class="max-w-7xl mx-auto px-6 py-24 border-t border-white/5">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-teal-400 font-semibold text-sm tracking-wide uppercase mb-3">Nos services</p>
            <h2 class="font-display text-3xl md:text-4xl font-semibold text-white">Un accompagnement médical complet</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7 hover:border-teal-500/30 transition">
                <div class="w-11 h-11 rounded-xl bg-teal-500/10 flex items-center justify-center mb-5 text-teal-400">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                </div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Consultation en ligne</h3>
                <p class="text-slate-400 text-[13px] leading-relaxed">Rendez-vous avec un médecin, en ligne ou en présentiel.</p>
            </div>
            <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7 hover:border-coral-500/30 transition">
                <div class="w-11 h-11 rounded-xl bg-coral-500/10 flex items-center justify-center mb-5 text-coral-400">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Suivi médical continu</h3>
                <p class="text-slate-400 text-[13px] leading-relaxed">Votre dossier et votre historique accessibles à tout moment.</p>
            </div>
            <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7 hover:border-teal-500/30 transition">
                <div class="w-11 h-11 rounded-xl bg-navy-700/40 flex items-center justify-center mb-5 text-teal-300">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Chat, audio & vidéo</h3>
                <p class="text-slate-400 text-[13px] leading-relaxed">Échangez avec votre médecin en toute sécurité.</p>
            </div>
        </div>
        <div class="text-center mt-14">
            <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-teal-400 font-semibold hover:text-teal-300 transition">
                Voir tous nos services
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8h10m0 0L9 4m4 4l-4 4"/></svg>
            </a>
        </div>
    </section>

    {{-- 3 ÉTAPES --}}
    <section class="max-w-7xl mx-auto px-6 py-24 border-t border-white/5">
        <div class="text-center mb-16">
            <p class="text-coral-400 font-semibold text-sm tracking-wide uppercase mb-3">Comment ça marche</p>
            <h2 class="font-display text-3xl md:text-4xl font-semibold text-white">En 3 étapes simples</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-10 relative">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-teal-500 to-teal-700 flex items-center justify-center text-white font-bold text-[18px] mb-5">01</div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Créez votre compte</h3>
                <p class="text-slate-400 text-[13px] max-w-xs mx-auto">Inscrivez-vous en 2 minutes en tant que patient.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-navy-700 to-navy-900 border border-white/10 flex items-center justify-center text-white font-bold text-[18px] mb-5">02</div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Choisissez un médecin</h3>
                <p class="text-slate-400 text-[13px] max-w-xs mx-auto">Généraliste ou spécialiste, selon votre région.</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-coral-500 to-coral-700 flex items-center justify-center text-white font-bold text-[18px] mb-5">03</div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Consultez et suivez</h3>
                <p class="text-slate-400 text-[13px] max-w-xs mx-auto">Chat, audio, vidéo, et un dossier toujours à jour.</p>
            </div>
        </div>
    </section>

    {{-- APERÇU --}}
    <section class="max-w-7xl mx-auto px-6 py-24 border-t border-white/5 grid md:grid-cols-2 gap-12 items-center">
        <div class="rounded-[2rem] overflow-hidden border border-white/10">
            <img src="{{ asset('images/consultation.jpg') }}" class="w-full h-[380px] object-cover">
        </div>
        <div>
            <p class="text-teal-400 font-semibold text-sm tracking-wide uppercase mb-3">Simple et rapide</p>
            <h2 class="font-display text-3xl font-semibold text-white mb-5">Prenez rendez-vous en quelques clics</h2>
            <ul class="space-y-4">
                <li class="flex gap-3 items-start">
                    <span class="w-6 h-6 rounded-full bg-teal-500/10 text-teal-400 flex items-center justify-center shrink-0 mt-0.5"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 6l3 3 5-6"/></svg></span>
                    <span class="text-slate-300 text-[14px]">Médecins vérifiés, en ligne ou présentiel</span>
                </li>
                <li class="flex gap-3 items-start">
                    <span class="w-6 h-6 rounded-full bg-teal-500/10 text-teal-400 flex items-center justify-center shrink-0 mt-0.5"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 6l3 3 5-6"/></svg></span>
                    <span class="text-slate-300 text-[14px]">Paiement sécurisé Orange Money, MoMo, carte</span>
                </li>
                <li class="flex gap-3 items-start">
                    <span class="w-6 h-6 rounded-full bg-teal-500/10 text-teal-400 flex items-center justify-center shrink-0 mt-0.5"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 6l3 3 5-6"/></svg></span>
                    <span class="text-slate-300 text-[14px]">Consultez depuis chez vous, en toute sécurité</span>
                </li>
            </ul>
            <a href="{{ route('register') }}" class="inline-block mt-8 bg-gradient-to-r from-teal-500 to-coral-500 text-white font-semibold px-7 py-3 rounded-full hover:opacity-90 transition">Commencer maintenant</a>
        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="border-t border-white/5 py-24 text-center relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-coral-500/10 rounded-full blur-3xl"></div>
        <div class="relative max-w-2xl mx-auto px-6">
            <h2 class="font-display text-3xl md:text-4xl font-semibold text-white mb-4">Prêt à rejoindre l'aventure SuiviHealth ?</h2>
            <p class="text-slate-400 mb-8">Rejoignez dès aujourd'hui des milliers de patients qui prennent soin de leur santé, simplement.</p>
            <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-teal-500 to-coral-500 text-white font-semibold px-8 py-3.5 rounded-full hover:opacity-90 transition">Commencer maintenant — c'est gratuit</a>
        </div>
    </section>

</div>
@endsection
@include('partials.google-translate')

    @stack('scripts')
</body>
</html>
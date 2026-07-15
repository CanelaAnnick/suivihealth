@extends('layouts.app')
@section('title', 'À propos')
@section('content')

<div class="bg-abyss-900">

    <section class="max-w-4xl mx-auto px-6 pt-20 pb-16 text-center">
        <p class="text-coral-400 font-semibold text-sm tracking-wide uppercase mb-3">Notre histoire</p>
        <h1 class="font-display text-4xl md:text-5xl font-semibold text-white mb-6">
            À propos de <span class="text-teal-400">SuiviHealth</span>
        </h1>
        <p class="text-slate-400 text-[15px] leading-relaxed max-w-2xl mx-auto">
            Nés d'un constat simple : l'accès à un suivi médical régulier reste difficile pour beaucoup de Camerounais. SuiviHealth connecte patients et médecins vérifiés, partout dans le pays.
        </p>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16 border-t border-white/5 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-teal-400 font-semibold text-sm tracking-wide uppercase mb-3">Notre mission</p>
            <h2 class="font-display text-3xl font-semibold text-white mb-5">Construire les ponts de demain</h2>
            <p class="text-slate-400 text-[14px] leading-relaxed mb-4">
                Notre équipe développe une plateforme locale, adaptée aux réalités du terrain camerounais, entre distances, disponibilité des médecins et coût des déplacements.
            </p>
            <p class="text-slate-400 text-[14px] leading-relaxed">
                Chaque fonctionnalité est pensée pour rapprocher le patient de son médecin, sans compromis sur la qualité des soins.
            </p>
        </div>
        <div class="relative">
            <div class="rounded-[2rem] overflow-hidden border border-white/10">
                <img src="{{ asset('images/about-team.jpg') }}" class="w-full h-[380px] object-cover">
            </div>
            <div class="absolute -bottom-6 -right-6 bg-abyss-800 border border-white/10 rounded-2xl px-6 py-4">
                <p class="text-coral-400 text-[22px] font-bold leading-none">10</p>
                <p class="text-[11px] text-slate-400 mt-1">Régions couvertes</p>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-24 border-t border-white/5">
        <div class="text-center mb-16">
            <p class="text-coral-400 font-semibold text-sm tracking-wide uppercase mb-3">Nos valeurs</p>
            <h2 class="font-display text-3xl md:text-4xl font-semibold text-white">Ce qui nous guide</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7 text-center hover:border-teal-500/30 transition">
                <div class="w-11 h-11 mx-auto rounded-xl bg-teal-500/10 flex items-center justify-center mb-4 text-teal-400">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Confiance</h3>
                <p class="text-slate-400 text-[13px]">Des médecins vérifiés et des données protégées.</p>
            </div>
            <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7 text-center hover:border-coral-500/30 transition">
                <div class="w-11 h-11 mx-auto rounded-xl bg-coral-500/10 flex items-center justify-center mb-4 text-coral-400">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M3.75 21h16.5M4.5 3h15l-.75 18h-13.5L4.5 3z"/></svg>
                </div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Accessibilité</h3>
                <p class="text-slate-400 text-[13px]">Un service pensé pour toutes les régions du pays.</p>
            </div>
            <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7 text-center hover:border-teal-500/30 transition">
                <div class="w-11 h-11 mx-auto rounded-xl bg-navy-700/40 flex items-center justify-center mb-4 text-teal-300">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <h3 class="text-white font-semibold text-[15px] mb-2">Proximité</h3>
                <p class="text-slate-400 text-[13px]">Un suivi humain, même à distance.</p>
            </div>
        </div>
    </section>

</div>
@endsection
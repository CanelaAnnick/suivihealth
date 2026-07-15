@extends('layouts.app')
@section('title', 'Contact')
@section('content')

<div class="bg-abyss-900">

    <section class="max-w-4xl mx-auto px-6 pt-20 pb-16 text-center">
        <p class="text-teal-400 font-semibold text-sm tracking-wide uppercase mb-3">Nous contacter</p>
        <h1 class="font-display text-4xl md:text-5xl font-semibold text-white mb-6">
            Parlons <span class="text-teal-400">ensemble</span>
        </h1>
        <p class="text-slate-400 text-[15px] leading-relaxed max-w-2xl mx-auto">
            Une question, un partenariat hospitalier, ou simplement envie d'en savoir plus ? Nous sommes là pour vous répondre.
        </p>
    </section>

    <section class="max-w-6xl mx-auto px-6 pb-24 border-t border-white/5 pt-16 grid md:grid-cols-2 gap-8">

        <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7">
            <h2 class="text-white font-semibold text-[16px] mb-5">Envoyez-nous un message</h2>
            <form class="space-y-4">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-[12px] font-medium text-slate-400">Nom complet</label>
                        <input type="text" placeholder="Marie Dupont" class="w-full mt-1 rounded-lg bg-abyss-900 border-white/10 text-white text-[13px] placeholder:text-slate-500 focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="text-[12px] font-medium text-slate-400">Adresse email</label>
                        <input type="email" placeholder="marie@exemple.cm" class="w-full mt-1 rounded-lg bg-abyss-900 border-white/10 text-white text-[13px] placeholder:text-slate-500 focus:border-teal-500 focus:ring-teal-500">
                    </div>
                </div>
                <div>
                    <label class="text-[12px] font-medium text-slate-400">Sujet</label>
                    <input type="text" placeholder="Je voudrais en savoir plus..." class="w-full mt-1 rounded-lg bg-abyss-900 border-white/10 text-white text-[13px] placeholder:text-slate-500 focus:border-teal-500 focus:ring-teal-500">
                </div>
                <div>
                    <label class="text-[12px] font-medium text-slate-400">Message</label>
                    <textarea rows="5" placeholder="Dites-nous tout..." class="w-full mt-1 rounded-lg bg-abyss-900 border-white/10 text-white text-[13px] placeholder:text-slate-500 focus:border-teal-500 focus:ring-teal-500"></textarea>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-coral-500 text-white font-semibold py-3 rounded-full hover:opacity-90 transition">Envoyer le message</button>
            </form>
        </div>

        <div class="space-y-6">
            <div class="bg-abyss-800 border border-white/5 rounded-2xl p-7">
                <h2 class="text-white font-semibold text-[16px] mb-5">Informations de contact</h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-teal-500/10 flex items-center justify-center text-teal-400 shrink-0">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-500">Email</p>
                            <p class="text-white text-[13px]">contact@suivihealth.cm</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-coral-500/10 flex items-center justify-center text-coral-400 shrink-0">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.5a1.125 1.125 0 00-.852-1.09l-4.5-1.125a1.125 1.125 0 00-1.173.417l-.97 1.293a12.05 12.05 0 01-5.649-5.649l1.293-.97a1.125 1.125 0 00.417-1.173L8.09 3.102a1.125 1.125 0 00-1.09-.852h-1.5A2.25 2.25 0 003.25 4.5"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-500">Téléphone</p>
                            <p class="text-white text-[13px]">+237 6XX XXX XXX</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-teal-500/10 flex items-center justify-center text-teal-400 shrink-0">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-500">Adresse</p>
                            <p class="text-white text-[13px]">Akwa, Douala, Cameroun</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-coral-500/10 flex items-center justify-center text-coral-400 shrink-0">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-500">Horaires</p>
                            <p class="text-white text-[13px]">Lun–Ven, 8h–18h</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-teal-600 to-navy-900 rounded-2xl p-7">
                <p class="text-teal-100 text-[12px] font-medium">Temps de réponse moyen</p>
                <p class="text-white text-[26px] font-bold mt-1">&lt; 4h</p>
                <p class="text-teal-100 text-[11px] mt-1">En jours ouvrables</p>
            </div>
        </div>

    </section>

</div>
@endsection
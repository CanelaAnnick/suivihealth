<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuiviHealth — Votre santé, suivie avec soin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-navy-900 antialiased">

    {{-- ================= NAVBAR ================= --}}
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100">
        <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            <a href="/" class="flex items-center gap-2">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" class="text-coral-500">
                    <path d="M3 12h4l2-7 4 14 2-7h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="font-display font-semibold text-lg">SuiviHealth</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="#accueil" class="hover:text-navy-900">Accueil</a>
                <a href="#services" class="hover:text-navy-900">Services</a>
                <a href="#apropos" class="hover:text-navy-900">À propos</a>
                <a href="#contact" class="hover:text-navy-900">Contact</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-sm font-medium text-navy-900 hover:text-coral-500">Se connecter</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold bg-navy-900 text-white px-4 py-2 rounded-lg hover:bg-navy-800 transition">
                    S'inscrire
                </a>
            </div>
        </nav>
    </header>

    {{-- ================= HERO ================= --}}
    <section id="accueil" class="relative overflow-hidden bg-mist">
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-24 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-coral-600 font-semibold text-sm tracking-wide uppercase mb-4">Consultation & suivi médical</p>
                <h1 class="font-display text-4xl md:text-5xl font-semibold leading-tight text-navy-900">
                    Votre santé,
                    <span class="text-teal-600">suivie avec soin</span>,
                    où que vous soyez.
                </h1>
                <p class="mt-6 text-slate-600 text-lg leading-relaxed">
                    SuiviHealth connecte patients et médecins pour des consultations en ligne ou présentielles,
                    un suivi médical continu, et des échanges sécurisés par chat, audio ou vidéo.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="bg-coral-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-coral-600 transition">
                        Prendre rendez-vous
                    </a>
                    <a href="#services" class="border border-navy-900 text-navy-900 font-semibold px-6 py-3 rounded-lg hover:bg-navy-900 hover:text-white transition">
                        Découvrir les services
                    </a>
                </div>
            </div>

            {{-- Aperçu app / signature ECG --}}
            <div class="relative">
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-semibold text-slate-500">Prochaine consultation</span>
                        <span class="text-xs bg-teal-500/10 text-teal-600 font-medium px-2 py-1 rounded-full">Confirmée</span>
                    </div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-navy-900 text-white flex items-center justify-center font-semibold text-sm">DB</div>
                        <div>
                            <p class="font-semibold text-sm">Dr. Belinga</p>
                            <p class="text-xs text-slate-500">Aujourd'hui, 15h30 · Vidéo</p>
                        </div>
                    </div>
                    {{-- ligne ECG signature --}}
                    <svg viewBox="0 0 300 60" class="w-full h-14">
                        <polyline points="0,30 60,30 75,10 90,50 105,5 120,30 300,30"
                            fill="none" stroke="#FF6F61" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="mt-4 flex gap-2">
                        <span class="flex-1 bg-mist text-navy-900 text-xs font-medium text-center py-2 rounded-lg">Chat</span>
                        <span class="flex-1 bg-mist text-navy-900 text-xs font-medium text-center py-2 rounded-lg">Appel audio</span>
                        <span class="flex-1 bg-coral-500 text-white text-xs font-medium text-center py-2 rounded-lg">Rejoindre</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= SERVICES ================= --}}
    <section id="services" class="max-w-7xl mx-auto px-6 py-24">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <p class="text-coral-600 font-semibold text-sm tracking-wide uppercase mb-3">Nos services</p>
            <h2 class="font-display text-3xl font-semibold text-navy-900">Un accompagnement médical complet</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white border border-slate-100 rounded-2xl p-8 hover:shadow-lg transition">
                <div class="w-12 h-12 rounded-xl bg-navy-900/5 flex items-center justify-center mb-5">
                    <svg width="22" height="22" fill="none" stroke="#0B2A4A" stroke-width="2"><path d="M2 20v-2a4 4 0 014-4h6a4 4 0 014 4v2M9 10a4 4 0 100-8 4 4 0 000 8z"/></svg>
                </div>
                <h3 class="font-display font-semibold text-lg mb-2">Consultation en ligne</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Prenez rendez-vous avec un médecin disponible, en ligne ou en présentiel, selon vos besoins.</p>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-8 hover:shadow-lg transition">
                <div class="w-12 h-12 rounded-xl bg-teal-600/10 flex items-center justify-center mb-5">
                    <svg width="22" height="22" fill="none" stroke="#1C6E8C" stroke-width="2"><path d="M3 12h4l2-7 4 14 2-7h6"/></svg>
                </div>
                <h3 class="font-display font-semibold text-lg mb-2">Suivi médical continu</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Accédez à votre dossier médical, votre historique de consultations et vos prescriptions à tout moment.</p>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-8 hover:shadow-lg transition">
                <div class="w-12 h-12 rounded-xl bg-coral-500/10 flex items-center justify-center mb-5">
                    <svg width="22" height="22" fill="none" stroke="#FF6F61" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                </div>
                <h3 class="font-display font-semibold text-lg mb-2">Chat, audio & vidéo</h3>
                <p class="text-slate-600 text-sm leading-relaxed">Échangez avec votre médecin par messagerie sécurisée ou passez en appel audio/vidéo en un clic.</p>
            </div>
        </div>
    </section>

    {{-- ================= A PROPOS ================= --}}
    <section id="apropos" class="bg-navy-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-coral-500 font-semibold text-sm tracking-wide uppercase mb-3">À propos</p>
                <h2 class="font-display text-3xl font-semibold mb-6">Pourquoi choisir SuiviHealth ?</h2>
                <ul class="space-y-4 text-slate-200">
                    <li class="flex gap-3"><span class="text-coral-500 font-bold">—</span> Des médecins vérifiés, disponibles selon vos disponibilités.</li>
                    <li class="flex gap-3"><span class="text-coral-500 font-bold">—</span> Un dossier médical centralisé et sécurisé, consultable à tout moment.</li>
                    <li class="flex gap-3"><span class="text-coral-500 font-bold">—</span> Des échanges chiffrés, que ce soit par chat, audio ou vidéo.</li>
                </ul>
            </div>
            <div class="bg-navy-800 rounded-2xl p-8 border border-navy-700">
                <p class="font-display text-xl leading-relaxed">
                    « Le suivi médical ne devrait jamais s'arrêter à la porte du cabinet. »
                </p>
                <p class="mt-4 text-sm text-slate-400">L'équipe SuiviHealth</p>
            </div>
        </div>
    </section>

    {{-- ================= CONTACT ================= --}}
    <section id="contact" class="max-w-7xl mx-auto px-6 py-24 text-center">
        <h2 class="font-display text-3xl font-semibold text-navy-900 mb-4">Prêt à commencer votre suivi ?</h2>
        <p class="text-slate-600 mb-8">Inscrivez-vous en quelques minutes et prenez votre premier rendez-vous.</p>
        <a href="{{ route('register') }}" class="inline-block bg-coral-500 text-white font-semibold px-8 py-3 rounded-lg hover:bg-coral-600 transition">
            S'inscrire gratuitement
        </a>
    </section>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-navy-900 border-t border-navy-800 text-slate-400 text-sm">
        <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="font-display text-white font-semibold">SuiviHealth</span>
            <p>&copy; {{ date('Y') }} SuiviHealth. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>
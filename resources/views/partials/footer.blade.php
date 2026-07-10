<footer class="bg-navy-900 border-t border-navy-800 text-slate-400 text-sm">
    <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-4 gap-10">
        <div>
            <span class="font-display text-white font-semibold text-lg">SuiviHealth</span>
            <p class="mt-3 leading-relaxed">La plateforme camerounaise de consultation et de suivi médical en ligne.</p>
        </div>
        <div>
            <p class="text-white font-medium mb-3">Navigation</p>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="hover:text-white">Accueil</a></li>
                <li><a href="{{ route('services') }}" class="hover:text-white">Services</a></li>
                <li><a href="{{ route('apropos') }}" class="hover:text-white">À propos</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
            </ul>
        </div>
        <div>
            <p class="text-white font-medium mb-3">Contact</p>
            <ul class="space-y-2">
                <li>Douala, Cameroun</li>
                <li>+237 6XX XXX XXX</li>
                <li>contact@suivihealth.cm</li>
            </ul>
        </div>
        <div>
            <p class="text-white font-medium mb-3">Légal</p>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">Conditions d'utilisation</a></li>
                <li><a href="#" class="hover:text-white">Confidentialité</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-navy-800 text-center py-6 text-xs">
        &copy; {{ date('Y') }} SuiviHealth. Tous droits réservés.
    </div>
</footer>
<header class="sticky top-0 z-50 bg-abyss-900/90 backdrop-blur border-b border-white/5" x-data="{ open: false }">
    <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
        <a href="{{ route('home') }}" class="flex items-center">
            <x-logo class="h-10" />
        </a>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-white' : 'hover:text-white transition' }}">Accueil</a>
            <a href="{{ route('apropos') }}" class="{{ request()->routeIs('apropos') ? 'text-white' : 'hover:text-white transition' }}">À propos</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'text-white' : 'hover:text-white transition' }}">Services</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-white' : 'hover:text-white transition' }}">Contact</a>
        </div>

        <div class="hidden md:flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white transition">Se connecter</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold bg-gradient-to-r from-teal-500 to-coral-500 text-white px-5 py-2.5 rounded-full hover:opacity-90 transition">
                S'inscrire
            </a>
        </div>

        <button @click="open = !open" class="md:hidden text-white" aria-label="Menu">
            <svg x-show="!open" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
            <svg x-show="open" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" x-cloak><path d="M4 4l16 16M20 4L4 20"/></svg>
        </button>
    </nav>

    <div x-show="open" x-cloak x-transition class="md:hidden bg-abyss-900 border-t border-white/5 px-6 py-4 space-y-3">
        <a href="{{ route('home') }}" class="block text-sm font-medium text-slate-200">Accueil</a>
        <a href="{{ route('apropos') }}" class="block text-sm font-medium text-slate-200">À propos</a>
        <a href="{{ route('services') }}" class="block text-sm font-medium text-slate-200">Services</a>
        <a href="{{ route('contact') }}" class="block text-sm font-medium text-slate-200">Contact</a>
        <div class="pt-3 border-t border-white/5 flex flex-col gap-2">
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-200">Se connecter</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold bg-gradient-to-r from-teal-500 to-coral-500 text-white text-center px-4 py-2 rounded-full">S'inscrire</a>
        </div>
    </div>
</header>
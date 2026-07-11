<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100" x-data="{ open: false }">
    <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
        <a href="{{ route('home') }}" class="flex items-center">
            <x-logo class="h-11" />
        </a>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-navy-900 font-semibold' : 'hover:text-navy-900' }}">Accueil</a>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'text-navy-900 font-semibold' : 'hover:text-navy-900' }}">Services</a>
            <a href="{{ route('apropos') }}" class="{{ request()->routeIs('apropos') ? 'text-navy-900 font-semibold' : 'hover:text-navy-900' }}">À propos</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-navy-900 font-semibold' : 'hover:text-navy-900' }}">Contact</a>
        </div>

        <div class="hidden md:flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-medium text-navy-900 hover:text-coral-500">Se connecter</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold bg-navy-900 text-white px-4 py-2 rounded-lg hover:bg-navy-800 transition">S'inscrire</a>
        </div>

        <button @click="open = !open" class="md:hidden text-navy-900" aria-label="Menu">
            <svg x-show="!open" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h20M3 13h20M3 20h20"/></svg>
            <svg x-show="open" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" x-cloak><path d="M4 4l18 18M22 4L4 22"/></svg>
        </button>
    </nav>

    <div x-show="open" x-cloak x-transition class="md:hidden bg-white border-t border-slate-100 px-6 py-4 space-y-3">
        <a href="{{ route('home') }}" class="block text-sm font-medium text-slate-700">Accueil</a>
        <a href="{{ route('services') }}" class="block text-sm font-medium text-slate-700">Services</a>
        <a href="{{ route('apropos') }}" class="block text-sm font-medium text-slate-700">À propos</a>
        <a href="{{ route('contact') }}" class="block text-sm font-medium text-slate-700">Contact</a>
        <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
            <a href="{{ route('login') }}" class="text-sm font-medium text-navy-900">Se connecter</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold bg-navy-900 text-white text-center px-4 py-2 rounded-lg">S'inscrire</a>
        </div>
    </div>
</header>
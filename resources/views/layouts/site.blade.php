<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GIES-CI') — Énergie solaire</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans antialiased">

    <header x-data="{ scrolled: false, open: false }" @scroll.window="scrolled = window.scrollY > 20"
        class="fixed top-0 left-0 w-full z-[60] border-b border-slate-200 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/90 shadow-[0_2px_20px_rgba(0,0,0,0.06)]">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 py-3">
            <a href="{{ route('site.accueil') }}" class="shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="GIES-CI" class="h-12 md:h-14 w-auto transition-all duration-300">
            </a>

            <nav class="hidden md:flex items-center gap-7 text-sm font-semibold tracking-wide text-slate-700">
                <a href="{{ route('site.accueil') }}" class="transition-colors duration-200 hover:text-orange-500">Accueil</a>
                <a href="{{ route('site.a-propos') }}" class="transition-colors duration-200 hover:text-orange-500">À propos</a>
                <a href="{{ route('site.services') }}" class="transition-colors duration-200 hover:text-orange-500">Services</a>
                <a href="{{ route('site.realisations') }}" class="transition-colors duration-200 hover:text-orange-500">Réalisations</a>
                <a href="{{ route('site.ressources') }}" class="transition-colors duration-200 hover:text-orange-500">Ressources</a>
                <a href="{{ route('site.contact') }}" class="transition-colors duration-200 hover:text-orange-500">Contact</a>
            </nav>

            <div class="hidden md:flex items-center gap-4">
                <a href="{{ route('site.devis') }}"
                    class="bg-orange-500 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow-lg shadow-orange-500/20 hover:bg-orange-400 transition-all duration-200">
                    Demander un devis
                </a>
                @auth('client')
                <a href="{{ route('client.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 transition-colors duration-200 hover:border-orange-200 hover:text-orange-500" aria-label="Mon espace">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10z" />
                        <path d="M4 22c0-4.418 3.582-8 8-8s8 3.582 8 8H4z" />
                    </svg>
                    <span>Mon espace</span>
                </a>
                @else
                <a href="{{ route('client.login') }}" class="text-slate-500 transition-colors duration-200 hover:text-slate-900" aria-label="Espace client">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10z" />
                        <path d="M4 22c0-4.418 3.582-8 8-8s8 3.582 8 8H4z" />
                    </svg>
                </a>
                @endauth
            </div>

            <button @click="open = !open" class="md:hidden rounded-lg p-2 text-slate-700 transition-colors duration-200 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                    <rect x="3" y="5" width="18" height="3" rx="1.5" />
                    <rect x="3" y="10.5" width="18" height="3" rx="1.5" />
                    <rect x="3" y="16" width="18" height="3" rx="1.5" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-transition @click.away="open = false" x-cloak
            class="md:hidden absolute left-0 right-0 top-full border-t border-slate-200 bg-white p-4 flex flex-col gap-3 text-sm font-semibold text-slate-700 shadow-xl z-50">
            <a href="{{ route('site.accueil') }}" class="transition-colors hover:text-orange-500" @click="open = false">Accueil</a>
            <a href="{{ route('site.a-propos') }}" class="transition-colors hover:text-orange-500" @click="open = false">À propos</a>
            <a href="{{ route('site.services') }}" class="transition-colors hover:text-orange-500" @click="open = false">Services</a>
            <a href="{{ route('site.realisations') }}" class="transition-colors hover:text-orange-500" @click="open = false">Réalisations</a>
            <a href="{{ route('site.ressources') }}" class="transition-colors hover:text-orange-500" @click="open = false">Ressources</a>
            <a href="{{ route('site.contact') }}" class="transition-colors hover:text-orange-500" @click="open = false">Contact</a>
            @auth('client')
            <a href="{{ route('client.dashboard') }}" class="inline-flex items-center gap-2 transition-colors hover:text-orange-500" @click="open = false" aria-label="Mon espace">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10z" />
                    <path d="M4 22c0-4.418 3.582-8 8-8s8 3.582 8 8H4z" />
                </svg>
                <span>Mon espace</span>
            </a>
            @else
            <a href="{{ route('client.login') }}" class="inline-flex items-center gap-2 transition-colors hover:text-orange-500" @click="open = false" aria-label="Espace client">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10z" />
                    <path d="M4 22c0-4.418 3.582-8 8-8s8 3.582 8 8H4z" />
                </svg>
                <span>Espace client</span>
            </a>
            @endauth
            <a href="{{ route('site.devis') }}" class="bg-orange-500 text-white text-center py-2.5 rounded-lg" @click="open = false">Demander un devis</a>
        </div>
    </header>

    <main class="pt-20 sm:pt-24">
        @yield('content')
    </main>

    <footer class="bg-slate-950 text-slate-300 mt-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid gap-10 lg:grid-cols-3">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="GIES-CI" class="h-8 w-auto brightness-0 invert opacity-90">
                        <span class="text-xs uppercase tracking-[0.32em] text-slate-400">GIES-CI</span>
                    </div>
                    <p class="text-sm leading-6 text-slate-400">Conception, installation et maintenance solaire pour professionnels et particuliers. Accompagnement fiable, réactivité et qualité garantie.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('site.devis') }}" class="inline-flex items-center justify-center rounded-full bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/20 hover:bg-orange-400 transition">
                            Demander un devis
                        </a>
                        <a href="{{ route('site.contact') }}" class="inline-flex items-center justify-center rounded-full border border-slate-700 bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-200 hover:border-white/20 hover:text-white transition">
                            Nous contacter
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <div class="font-semibold text-white mb-3 text-sm">Navigation</div>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a href="{{ route('site.accueil') }}" class="hover:text-white transition-colors">Accueil</a></li>
                            <li><a href="{{ route('site.services') }}" class="hover:text-white transition-colors">Services</a></li>
                            <li><a href="{{ route('site.realisations') }}" class="hover:text-white transition-colors">Réalisations</a></li>
                            <li><a href="{{ route('site.ressources') }}" class="hover:text-white transition-colors">Ressources</a></li>
                        </ul>
                    </div>
                    <div>
                        <div class="font-semibold text-white mb-3 text-sm">À propos</div>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a href="{{ route('site.a-propos') }}" class="hover:text-white transition-colors">À propos</a></li>
                            <li><a href="{{ route('site.mentions-legales') }}" class="hover:text-white transition-colors">Mentions légales</a></li>
                            <li><a href="{{ route('site.politique-de-confidentialite') }}" class="hover:text-white transition-colors">Protection des données</a></li>
                            <li><a href="{{ route('site.accueil') }}#faq" class="hover:text-white transition-colors">FAQ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="font-semibold text-white text-sm">Contact</div>
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-5 space-y-3 text-sm text-slate-400">
                        <div>
                            <p class="text-slate-200 font-semibold text-xs uppercase tracking-[0.2em]">Téléphone</p>
                            <p>{{ \App\Models\SiteSetting::where('cle', 'telephone')->value('valeur') ?? '+229 XX XX XX XX' }}</p>
                        </div>
                        <div>
                            <p class="text-slate-200 font-semibold text-xs uppercase tracking-[0.2em]">Email</p>
                            <p>{{ \App\Models\SiteSetting::where('cle', 'email')->value('valeur') ?? 'contact@gies-ci.com' }}</p>
                        </div>
                        <div>
                            <p class="text-slate-200 font-semibold text-xs uppercase tracking-[0.2em]">Adresse</p>
                            <p>{{ \App\Models\SiteSetting::where('cle', 'adresse')->value('valeur') ?? 'Cotonou, Bénin' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-slate-400">
                        <a href="https://facebook.com" target="_blank" rel="noreferrer" class="transition hover:text-white" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.5l.5-4H14V7a1 1 0 0 1 1-1h3z" />
                            </svg>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noreferrer" class="transition hover:text-white" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37a4 4 0 1 1-7.9 1.5 4 4 0 0 1 7.9-1.5z" />
                                <circle cx="17.5" cy="6.5" r="0.5" />
                            </svg>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noreferrer" class="transition hover:text-white" aria-label="LinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z" />
                                <rect x="2" y="9" width="4" height="12" rx="1" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-10 border-t border-white/10 pt-5 text-center text-xs text-slate-500">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <span>© {{ date('Y') }} GIES-CI. Tous droits réservés.</span>
                    <span>Énergie solaire fiable et professionnelle.</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
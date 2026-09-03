@extends('layouts.site')

@section('title', 'Accueil')

@section('content')

<section x-data="{
    current: 0,
    slides: [
        '{{ asset('images/hero/1.jpg') }}',
        '{{ asset('images/hero/2.jpg') }}',
        '{{ asset('images/hero/3.jpg') }}',
        '{{ asset('images/hero/4.jpg') }}'
    ],
    showBadge: false,
    showTitle: false,
    showParagraph: false,
    showButtons: false,
    showStats: false,
    init() {
        setInterval(() => {
            this.current = (this.current + 1) % this.slides.length
        }, 5000)

        setTimeout(() => this.showBadge = true, 100)
        setTimeout(() => this.showTitle = true, 260)
        setTimeout(() => this.showParagraph = true, 440)
        setTimeout(() => this.showButtons = true, 620)
        setTimeout(() => this.showStats = true, 820)
    }
}" class="relative isolate overflow-hidden bg-slate-950 text-white">
    <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
        <template x-for="(slide, index) in slides" :key="index">
            <img x-show="current === index"
                x-transition:enter="transition ease-out duration-[1400ms]"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-[1400ms]"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-105"
                :src="slide"
                alt=""
                class="absolute inset-0 h-full w-full object-cover" />
        </template>

        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
    </div>

    {{-- HERO --}}
    <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-16 sm:py-20">

        <div class="w-full text-left">

            <span x-show="showBadge"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                Énergie solaire • Installation & maintenance
            </span>

            <h1 x-show="showTitle"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                Passez à une énergie plus propre et plus fiable.
            </h1>

            <p x-show="showParagraph"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                Des solutions solaires performantes, conçues pour les particuliers et les entreprises, avec un accompagnement sur mesure.
            </p>

            <div x-show="showButtons"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-8 flex flex-wrap items-center justify-start gap-4">

                <a href="{{ route('site.devis') }}"
                    class="rounded-full bg-orange-500 px-7 py-3.5 font-semibold text-white shadow-lg shadow-orange-500/25 transition-all duration-300 hover:-translate-y-0.5 hover:bg-orange-400">
                    Demander un devis gratuit
                </a>

                <a href="{{ route('site.realisations') }}"
                    class="rounded-full border border-white/20 bg-white/10 px-7 py-3.5 font-semibold text-white backdrop-blur transition-all duration-300 hover:bg-white/20">
                    Voir nos réalisations
                </a>

            </div>

            <div x-show="showStats"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 translate-y-6"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-10 flex flex-row flex-wrap items-center justify-start gap-4 text-sm text-slate-200">

                <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                    <div class="font-semibold text-white">+20 ans</div>
                    <div class="text-slate-300">d'expérience</div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                    <div class="font-semibold text-white">Installation rapide</div>
                    <div class="text-slate-300">et sécurisée</div>
                </div>

            </div>

        </div>
    </div>
</section>

<div class="h-8 bg-white"></div>

<section class="bg-slate-900 py-8 text-white sm:py-10">
    <div class="mx-auto max-w-6xl px-6">
        <div x-data="{
            stats: [
                { label: 'Années d\'expérience', value: 20, unit: '+', current: 0 },
                { label: 'Projets réalisés', value: 150, unit: '+', current: 0 },
                { label: 'Taux de satisfaction', value: 98, unit: '%', current: 0 },
            ],
            animated: false,
            runStats() {
                if (this.animated) return;
                this.animated = true;

                this.stats.forEach((stat, index) => {
                    const duration = 1200 + (index * 180);
                    const start = performance.now();

                    const tick = (now) => {
                        const progress = Math.min((now - start) / duration, 1);
                        const eased = 1 - Math.pow(1 - progress, 3);
                        stat.current = Math.round(stat.value * eased);

                        if (progress < 1) {
                            requestAnimationFrame(tick);
                        }
                    };

                    requestAnimationFrame(tick);
                });
            }
        }" x-intersect.once="runStats()" class="grid gap-4 grid-cols-3 items-stretch">
            <template x-for="(stat, index) in stats" :key="index">
                <div class="group flex h-full w-full max-w-[360px] flex-col justify-between rounded-[24px] border border-white/10 bg-slate-950/60 p-5 shadow-[0_18px_60px_-35px_rgba(15,23,42,0.9)] backdrop-blur-sm transition duration-500 hover:-translate-y-1 hover:border-orange-400/40 hover:bg-slate-950/80"
                     :class="{
                         'justify-self-start': index === 0,
                         'justify-self-center': index === 1,
                         'justify-self-end': index === 2,
                     }">
                    <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-full bg-orange-500/10 text-orange-300 ring-1 ring-orange-400/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v20M2 12h20" />
                        </svg>
                    </div>
                    <div class="text-3xl font-black tracking-tight text-white sm:text-4xl" x-text="stat.current + stat.unit"></div>
                    <div class="mt-2 text-sm leading-6 text-slate-300" x-text="stat.label"></div>
                    <div class="mt-3 text-xs uppercase tracking-[0.28em] text-orange-300/80 opacity-0 transition duration-500 group-hover:opacity-100">
                        + de confiance
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

{{-- SERVICES / PRESTATIONS --}}

<section class="bg-white py-24 text-slate-900">

    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-14">
            <div class="mx-auto max-w-3xl rounded-[32px] border border-slate-200/70 bg-slate-50 p-10 shadow-[0_20px_60px_-40px_rgba(15,23,42,0.1)]">
                <span class="inline-flex rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-orange-600">
                    Nos services
                </span>
                <h2 class="text-4xl font-bold mt-5 tracking-tight text-slate-900">
                    Des prestations solaires premium
                </h2>
                <p class="mt-4 mx-auto max-w-2xl text-sm leading-7 text-slate-600">
                    Nous concevons et installons des solutions solaires performantes pour les particuliers et les entreprises avec un accompagnement transparent et une qualité durable.
                </p>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @foreach($prestations as $service)

            <a href="{{ route('site.services.show', $service) }}"
                x-data="{ show:false, delay: {{ $loop->index }} * 140 }"
                x-intersect.once="if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { show = true } else { setTimeout(() => show = true, delay) }"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                class="group block rounded-[40px] border border-slate-200/80 bg-slate-50 p-8 shadow-[0_20px_80px_-40px_rgba(15,23,42,0.08)] transition-all duration-700 ease-out hover:-translate-y-1 hover:shadow-lg hover:border-orange-500/30 hover:bg-white">

                <div class="inline-flex h-14 w-14 items-center justify-center rounded-[24px] bg-orange-500/10 text-orange-500 shadow-sm shadow-orange-500/10 mb-6">
                    <x-dynamic-component :component="$service->icone ?? 'heroicon-o-sun'" class="h-6 w-6" />
                </div>

                <h3 class="text-xl font-semibold text-slate-900 mb-3">
                    {{ $service->titre }}
                </h3>

                <p class="text-sm leading-7 text-slate-600">
                    {{ $service->description_courte }}
                </p>

                <div class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-orange-500 transition-transform duration-300 group-hover:translate-x-1">
                    <span>Découvrir</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>

            </a>

            @endforeach

        </div>

    </div>

</section>


{{-- RÉALISATIONS --}}

<section class="bg-slate-950 py-16 text-white sm:py-20">

    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-10 text-center sm:mb-12">
            <div class="mx-auto max-w-3xl rounded-[32px] border border-slate-200/10 bg-slate-900/80 p-8 shadow-[0_20px_60px_-40px_rgba(15,23,42,0.35)] backdrop-blur sm:p-10">
                <span class="inline-flex rounded-full bg-orange-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-orange-300">
                    Nos réalisations
                </span>
                <h2 class="mt-5 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Un portfolio qui inspire confiance
                </h2>
                <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-300">
                    Découvrez nos installations solaires les plus réussies, conçues pour un rendement durable et une élégance maîtrisée.
                </p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3 lg:grid-rows-2">

            @foreach($realisations as $realisation)
            @php
                $image = $realisation->media->firstWhere('est_principale', true) ?? $realisation->media->first();
            @endphp

            <a href="{{ route('site.realisations.show', $realisation) }}"
                x-data="{ show:false, delay: {{ $loop->index }} * 140 }"
                x-intersect.once="if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { show = true } else { setTimeout(() => show = true, delay) }"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                class="group block overflow-hidden rounded-[44px] bg-slate-950 shadow-[0_20px_60px_-30px_rgba(15,23,42,0.5)] transition-all duration-700 ease-out hover:-translate-y-1">
                <div class="relative h-72 overflow-hidden rounded-[44px]">
                    @if($image)
                        <img src="{{ Storage::url($image->path) }}" alt="{{ $realisation->titre }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                    @else
                        <div class="h-full bg-slate-800"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/10 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6">
                        <span class="inline-flex rounded-full bg-orange-500/15 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.35em] text-orange-300">Projet</span>
                        <h3 class="mt-4 text-2xl font-semibold text-white">{{ $realisation->titre }}</h3>
                        <p class="mt-2 text-sm text-slate-300">{{ $realisation->lieu }}</p>

                        <div class="mt-5 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-sm font-semibold text-white backdrop-blur-sm transition duration-300 group-hover:bg-orange-500/20">
                            <span>Découvrir</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            @endforeach

        </div>

    </div>

</section>

<section class="relative py-20">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/2 bg-brand-blue/6 pointer-events-none"></div>
    <div class="max-w-6xl mx-auto px-6">
        <div x-data="{ show: false }"
            x-intersect.once="if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { show = true } else { setTimeout(() => show = true, 150) }"
            class="grid gap-8 lg:grid-cols-2 items-stretch">

            <div class="order-2 lg:order-1" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-flex rounded-full bg-brand-blue/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-brand-blue">Notre expertise</span>
                <h2 class="mt-6 text-4xl font-extrabold tracking-tight text-slate-900">Des solutions solaires pensées pour la performance et la durabilité</h2>
                <p class="mt-4 max-w-xl text-lg leading-8 text-slate-600">Nous accompagnons chaque projet depuis l'étude initiale jusqu'à la mise en service et le suivi après-installation. Une équipe technique, des process éprouvés et une exigence qualité à chaque étape.</p>
            </div>

            <div class="group relative order-1 lg:order-2 h-72 md:h-96 lg:h-80 overflow-hidden rounded-[28px] shadow-lg" x-show="show" x-transition:enter="transition ease-out duration-900" x-transition:enter-start="opacity-0 translate-x-8 scale-95" x-transition:enter-end="opacity-100 translate-x-0 scale-100">
                <img src="{{ asset('images/expert/expert.jpg') }}" alt="Illustration expertise" class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-105">
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-white/0 via-white/15 to-white/0 -translate-x-full transition-transform duration-1000 ease-out group-hover:translate-x-full"></div>
            </div>

        </div>
    </div>
</section>

{{-- MÉTHODE --}}

<section class="relative isolate overflow-hidden bg-slate-950 py-20 text-white sm:py-24"
    x-data="{ show: false }"
    x-intersect.once="if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { show = true } else { setTimeout(() => show = true, 150) }">
    <img src="{{ asset('images/hero/3.jpg') }}" alt="Technicien préparant une installation solaire" class="absolute inset-0 h-full w-full object-cover transition duration-[1400ms] ease-out" :class="show ? 'scale-100 opacity-100' : 'scale-105 opacity-70'">
    <div class="absolute inset-0 bg-slate-950/75"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-brand-blue/35"></div>

    <div class="relative mx-auto max-w-6xl px-6">
        <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
            <div x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-flex rounded-full border border-orange-300/30 bg-orange-500/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-orange-200 backdrop-blur-sm">Notre méthode</span>
                <h2 class="mt-6 max-w-2xl text-3xl font-extrabold tracking-tight text-white sm:text-5xl">De l'idée à l'énergie produite, chaque étape compte.</h2>
                <p class="mt-5 max-w-xl text-base leading-8 text-slate-200 sm:text-lg">Une approche structurée pour transformer vos besoins en une installation solaire fiable, lisible et conçue pour durer.</p>
                <a href="{{ route('site.devis') }}" class="mt-8 inline-flex items-center gap-3 rounded-full bg-orange-500 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-950/30 transition duration-300 hover:-translate-y-1 hover:bg-orange-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-950">
                    <span>Parler de votre projet</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>

            <div class="grid gap-3 sm:grid-cols-3 lg:grid-cols-1" x-show="show" x-transition:enter="transition ease-out duration-700 delay-150" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="rounded-[24px] border border-white/15 bg-white/10 p-5 backdrop-blur-md transition duration-300 hover:-translate-y-1 hover:bg-white/15">
                    <span class="text-sm font-bold text-orange-300">01</span>
                    <h3 class="mt-3 font-semibold text-white">Écouter</h3>
                    <p class="mt-1 text-sm leading-6 text-slate-300">Comprendre vos usages et les contraintes du site.</p>
                </div>
                <div class="rounded-[24px] border border-white/15 bg-white/10 p-5 backdrop-blur-md transition duration-300 hover:-translate-y-1 hover:bg-white/15">
                    <span class="text-sm font-bold text-orange-300">02</span>
                    <h3 class="mt-3 font-semibold text-white">Concevoir</h3>
                    <p class="mt-1 text-sm leading-6 text-slate-300">Dimensionner une solution claire et performante.</p>
                </div>
                <div class="rounded-[24px] border border-white/15 bg-white/10 p-5 backdrop-blur-md transition duration-300 hover:-translate-y-1 hover:bg-white/15">
                    <span class="text-sm font-bold text-orange-300">03</span>
                    <h3 class="mt-3 font-semibold text-white">Accompagner</h3>
                    <p class="mt-1 text-sm leading-6 text-slate-300">Rester présents avant, pendant et après la mise en service.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ --}}

<section id="faq" class="relative overflow-hidden bg-slate-50 py-24 text-slate-900 sm:py-28">
    <div class="pointer-events-none absolute right-0 top-0 h-96 w-96 translate-x-1/3 -translate-y-1/3 rounded-full bg-orange-100/60 blur-3xl"></div>
    @php
        $faqs = [
            [
                'question' => 'Quels types de projets GIES-CI réalise-t-elle ?',
                'reponse' => 'GIES-CI intervient principalement dans la réalisation de projets solaires photovoltaïques et d\'infrastructures électriques. Nos prestations couvrent notamment les études et essais préliminaires, le Pull Out Test (POT), le piquetage et l\'installation des pieux, le montage des structures, la pose des panneaux, les raccordements DC, BT et MT, ainsi que les essais et contrôles avant mise en service.',
            ],
            [
                'question' => 'GIES-CI intervient-elle sur des projets industriels ?',
                'reponse' => 'Oui. Nous accompagnons également les entreprises et sites industriels nécessitant des infrastructures électriques, des solutions photovoltaïques ou des systèmes complémentaires tels que l\'éclairage solaire et la vidéosurveillance.',
            ],
            [
                'question' => 'Réalisez-vous des études avant l\'installation ?',
                'reponse' => 'Oui. L\'étude et la préparation technique constituent une étape importante de notre démarche. Elles permettent d\'analyser les besoins du client, les caractéristiques du site et les contraintes techniques afin de définir une solution adaptée.',
            ],
            [
                'question' => 'Comment obtenir un devis ?',
                'reponse' => 'Il suffit de nous transmettre les informations disponibles concernant votre projet à travers notre formulaire de demande de devis. Notre équipe pourra ensuite analyser votre besoin et vous contacter afin d\'obtenir les informations techniques nécessaires à l\'établissement d\'une proposition adaptée.',
            ],
            [
                'question' => 'Quels essais électriques réalisez-vous ?',
                'reponse' => 'Nous réalisons différents essais sur les installations DC et AC, notamment les tests de polarité, de continuité, de résistance d\'isolement, les vérifications de mise à la terre, les mesures de tension à vide et de courant de court-circuit ainsi que différents contrôles de conformité des installations électriques.',
            ],
            [
                'question' => 'Intervenez-vous sur les installations BT et MT ?',
                'reponse' => 'Oui. Nos équipes peuvent intervenir sur les installations basse tension et moyenne tension, notamment pour le tirage et le raccordement des câbles, les liaisons avec les transformateurs, les tableaux électriques et les réseaux d\'évacuation de l\'énergie.',
            ],
            [
                'question' => 'Pouvez-vous réaliser l\'installation complète d\'une centrale photovoltaïque ?',
                'reponse' => 'Oui. Notre expertise couvre plusieurs étapes de réalisation d\'une centrale, notamment les essais géotechniques, l\'implantation, l\'installation des fondations et structures, la pose des modules, le câblage DC et AC, les raccordements électriques, les essais et les contrôles avant mise en service.',
            ],
            [
                'question' => 'Proposez-vous des solutions d\'éclairage solaire ?',
                'reponse' => 'Oui. Nous réalisons l\'installation de systèmes d\'éclairage solaire autonomes comprenant notamment les mâts, panneaux solaires, batteries, contrôleurs et luminaires LED.',
            ],
            [
                'question' => 'Installez-vous des systèmes de vidéosurveillance ?',
                'reponse' => 'Oui. Nous proposons des solutions de vidéosurveillance adaptées aux centrales solaires, sites industriels et autres infrastructures, comprenant l\'installation des caméras, le câblage, les équipements d\'enregistrement, la configuration et, lorsque nécessaire, l\'accès à distance.',
            ],
            [
                'question' => 'Comment obtenir un devis ?',
                'reponse' => 'Il suffit de nous transmettre les informations disponibles concernant votre projet à travers notre formulaire de demande de devis. Notre équipe pourra ensuite analyser votre besoin et vous contacter afin d\'obtenir les informations techniques nécessaires à l\'établissement d\'une proposition adaptée.',
            ],
            [
                'question' => 'Quels éléments faut-il fournir pour une demande de devis ?',
                'reponse' => 'Selon la nature du projet, il peut être utile de fournir la puissance souhaitée, la localisation du site, les plans disponibles, les caractéristiques de l\'installation existante, les besoins énergétiques et toute autre information technique disponible. Plus les informations fournies sont précises, plus notre analyse pourra être pertinente.',
            ],
            [
                'question' => 'GIES-CI accompagne-t-elle ses clients après la réalisation des travaux ?',
                'reponse' => 'Notre accompagnement ne se limite pas à la réalisation des travaux. Nous accordons une importance particulière au suivi technique, à la documentation des essais et à la compréhension des installations par nos clients afin de favoriser leur exploitation dans de bonnes conditions.',
            ],
        ];
    @endphp

    <div class="relative mx-auto max-w-6xl px-6" x-data="{ openIndex: 0, toggle(index) { this.openIndex = this.openIndex === index ? null : index; } }">

        <div class="grid items-start gap-10 lg:grid-cols-[0.85fr_1.15fr] lg:gap-16">

            <div class="space-y-6 lg:sticky lg:top-28">
                <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-[0_24px_70px_-42px_rgba(15,23,42,0.3)] sm:p-10">
                    <span class="inline-flex items-center gap-2 rounded-full bg-orange-50 px-3 py-1.5 text-xs font-bold uppercase tracking-[0.3em] text-orange-600">
                        <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span>
                        FAQ
                    </span>
                    <h2 class="mt-5 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">Questions fréquentes</h2>
                    <p class="mt-4 text-sm leading-7 text-slate-600">Tout ce qu'il faut savoir avant de lancer votre projet solaire avec GIES-CI. Si vous ne trouvez pas la réponse, contactez-nous — nous répondrons rapidement.</p>
                </div>

                <div class="group relative overflow-hidden rounded-[32px] bg-slate-900 shadow-[0_24px_70px_-35px_rgba(15,23,42,0.4)]">
                    <img src="{{ asset('images/faq/hero.jpg') }}" alt="FAQ illustration" class="h-64 w-full object-cover transition duration-700 ease-out group-hover:scale-105 md:h-72">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/10 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-orange-300">GIES-CI</p>
                        <p class="mt-2 text-sm font-medium leading-6 text-white">Une équipe disponible pour vous accompagner.</p>
                    </div>
                </div>

                <div class="rounded-2xl border border-orange-100 bg-orange-50/70 px-5 py-4 text-sm leading-6 text-slate-600">
                    <strong>Astuce :</strong> consultez la section "Comment obtenir un devis" pour préparer vos informations avant la prise de contact.
                </div>
            </div>

            <div class="space-y-3">
                @foreach(array_slice($faqs, 0, 5) as $index => $faq)
                    <div class="group overflow-hidden rounded-[22px] border border-slate-200 bg-white shadow-[0_14px_40px_-32px_rgba(15,23,42,0.4)] transition duration-300 hover:-translate-y-0.5 hover:border-orange-200 hover:shadow-[0_18px_45px_-30px_rgba(234,88,12,0.25)]"
                         :class="openIndex === {{ $index }} ? 'border-orange-300 ring-1 ring-orange-200' : ''">
                        <button
                            type="button"
                            @click="toggle({{ $index }})"
                            :aria-expanded="openIndex === {{ $index }}"
                            aria-controls="faq-answer-{{ $index }}"
                            class="flex w-full items-center justify-between gap-5 px-5 py-5 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500/50 sm:px-6 sm:py-6"
                        >
                            <div class="flex min-w-0 items-start gap-3 sm:gap-4">
                                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-xs font-extrabold text-slate-500 transition group-hover:bg-orange-50 group-hover:text-orange-600 sm:h-9 sm:w-9">{{ sprintf('%02d', $index + 1) }}</span>
                                <span class="text-base font-bold leading-7 text-slate-900 sm:text-lg">{{ $faq['question'] }}</span>
                            </div>

                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition duration-300"
                                  :class="openIndex === {{ $index }} ? 'rotate-180 border-orange-300 bg-orange-500 text-white' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                                </svg>
                            </span>
                        </button>

                        <div
                            id="faq-answer-{{ $index }}"
                            x-show="openIndex === {{ $index }}"
                            x-transition:enter="transition-all ease-out duration-300"
                            x-transition:enter-start="opacity-0 max-h-0"
                            x-transition:enter-end="opacity-100 max-h-96"
                            x-transition:leave="transition-all ease-in duration-200"
                            x-transition:leave-start="opacity-100 max-h-96"
                            x-transition:leave-end="opacity-0 max-h-0"
                            class="overflow-hidden border-t border-slate-100 bg-slate-50/70 px-5 sm:px-6"
                        >
                            <p class="py-5 text-sm leading-7 text-slate-600 sm:py-6 sm:text-base">{{ $faq['reponse'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

</section>

{{-- CALL TO ACTION --}}

<section class="relative isolate overflow-hidden bg-slate-950 py-20 text-white sm:py-24"
    x-data="{ show: false }"
    x-intersect.once="if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) { show = true } else { setTimeout(() => show = true, 150) }">
    <img src="{{ asset('images/all/05.jpg') }}" alt="Installation solaire GIES-CI" class="absolute inset-0 h-full w-full object-cover transition duration-[1400ms] ease-out" :class="show ? 'scale-100 opacity-100' : 'scale-105 opacity-70'">
    <div class="absolute inset-0 bg-slate-950/75"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-brand-blue/35"></div>

    <div class="relative mx-auto max-w-6xl px-6">
        <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
            <div class="max-w-2xl" x-show="show" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-flex rounded-full border border-orange-300/30 bg-orange-500/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-orange-200 backdrop-blur-sm">Parlons de votre projet</span>
                <h2 class="mt-6 text-3xl font-extrabold tracking-tight text-white sm:text-5xl">Un projet solaire ? Parlons-en.</h2>
                <p class="mt-5 max-w-xl text-base leading-8 text-slate-200 sm:text-lg">Recevez un devis personnalisé sous 48h.</p>
            </div>

            <div class="rounded-[24px] border border-white/15 bg-white/10 p-6 text-center backdrop-blur-md transition duration-300 hover:bg-white/15 sm:p-8" x-show="show" x-transition:enter="transition ease-out duration-700 delay-150" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm text-slate-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_12px_rgba(52,211,153,0.8)]"></span>
                    Une équipe à votre écoute
                </div>
                <a href="{{ route('site.devis') }}" class="group mt-6 inline-flex items-center gap-3 rounded-full bg-orange-500 px-7 py-4 text-sm font-bold text-white shadow-lg shadow-orange-950/30 transition duration-300 hover:-translate-y-1 hover:bg-orange-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-300 focus-visible:ring-offset-2 focus-visible:ring-offset-slate-950">
                    <span>Demander un devis</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
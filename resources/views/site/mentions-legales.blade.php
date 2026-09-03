@extends('layouts.site')
@section('title', 'Mentions légales')
@section('content')

<section class="relative isolate overflow-hidden bg-slate-950 text-white">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1600&q=80"
            alt="Installation solaire"
            class="h-full w-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
    </div>

    <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
        <div class="w-full text-left">
            <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                Mentions légales
            </span>
            <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                Mentions légales
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                Informations légales et conditions d’utilisation du site GIES-CI.
            </p>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-6 py-16 md:py-20">
    <div class="space-y-8">
        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Éditeur du site</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>Le site <strong>GIES-CI</strong> est édité par <strong>GIES-CI</strong>, société de droit ivoirien, exerçant dans le domaine des solutions solaires et des infrastructures électriques.</p>
                <p>Le site est hébergé par un prestataire technique spécialisé dans l’hébergement web, dans le respect des obligations légales applicables en Côte d’Ivoire et dans l’Union européenne.</p>
                <p>Les informations contenues sur ce site sont mises à disposition à titre informatif. Elles peuvent être modifiées à tout moment sans préavis.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Coordonnées</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>GIES-CI<br>
                Adresse : à compléter selon l’adresse légale réelle de l’entreprise<br>
                Téléphone : à compléter selon les coordonnées officielles<br>
                E-mail : contact@gies-ci.com (à adapter selon le contact officiel)<br>
                Site web : www.gies-ci.com</p>
                <p>Les coordonnées peuvent être modifiées en fonction des besoins administratifs et commerciaux de l’entreprise.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Utilisation du site</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>L’utilisateur s’engage à utiliser ce site dans le respect des lois et règlements en vigueur, ainsi que des principes de bonne foi. Toute reproduction, représentation, diffusion ou exploitation partielle ou totale des contenus du site sans autorisation préalable est interdite.</p>
                <p>GIES-CI met tout en œuvre pour fournir des informations fiables et à jour. Toutefois, l’entreprise ne peut être tenue responsable des erreurs, omissions ou indisponibilités qui pourraient affecter l’accès ou l’utilisation du site.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">Droit applicable</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>Les présentes mentions légales sont soumises au droit ivoirien. En cas de litige, les tribunaux compétents de Côte d’Ivoire seront seuls compétents.</p>
                <p>Les contenus du site sont protégés par les droits de propriété intellectuelle applicables, notamment le droit d’auteur et les droits voisins.</p>
            </div>
        </div>
    </div>
</section>

@endsection

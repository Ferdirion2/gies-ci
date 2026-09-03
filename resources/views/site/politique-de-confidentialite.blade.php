@extends('layouts.site')
@section('title', 'Protection des données')
@section('content')

<section class="relative isolate overflow-hidden bg-slate-950 text-white">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1600&q=80"
            alt="Protection des données"
            class="h-full w-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/85 to-slate-900/40"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(249,115,22,0.28),_transparent_35%)]"></div>
    </div>

    <div class="relative mx-auto flex min-h-[60vh] max-w-6xl items-center px-6 py-24">
        <div class="w-full text-left">
            <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] text-orange-300 backdrop-blur">
                Protection des données
            </span>
            <h1 class="mt-6 max-w-3xl text-3xl font-extrabold leading-tight sm:text-4xl lg:text-6xl">
                Politique de confidentialité
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300 sm:text-xl">
                Comment GIES-CI collecte, utilise et protège les données personnelles.
            </p>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-6 py-16 md:py-20">
    <div class="space-y-8">
        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">1. Objet et cadre légal</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>La présente politique de confidentialité vise à informer les visiteurs, clients et prospects sur la manière dont GIES-CI collecte, traite et protège les données personnelles, conformément à la législation ivoirienne applicable, notamment la <strong>Loi n° 2013-450 du 19 juin 2013</strong> relative à la protection des données à caractère personnel.</p>
                <p>Les informations collectées sont traitées avec sérieux et dans le respect de la vie privée des personnes concernées.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">2. Données collectées</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>GIES-CI peut collecter les données suivantes :</p>
                <ul>
                    <li>Nom et prénom</li>
                    <li>Adresse e-mail</li>
                    <li>Numéro de téléphone</li>
                    <li>Informations liées à la demande de devis ou de contact</li>
                    <li>Données techniques relatives à la navigation (adresse IP, type de navigateur, pages consultées, etc.)</li>
                </ul>
                <p>Ces données sont collectées principalement via les formulaires de contact, de devis, les demandes de renseignements et les échanges électroniques avec GIES-CI.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">3. Finalités du traitement</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>Les données personnelles collectées sont utilisées pour :</p>
                <ul>
                    <li>Répondre aux demandes de devis et d’information ;</li>
                    <li>Traiter les demandes clients et fournir les services sollicités ;</li>
                    <li>Améliorer la qualité de nos services et la relation client ;</li>
                    <li>Assurer la gestion administrative, comptable et commerciale ;</li>
                    <li>Répondre aux obligations légales et réglementaires.</li>
                </ul>
                <p>GIES-CI ne traite les données que dans le cadre de finalités légitimes et proportionnées.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">4. Conservation des données</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>Les données sont conservées pendant la durée nécessaire à la gestion de la relation commerciale, à la conformité des obligations légales et à l’administration des demandes reçues.</p>
                <p>Au-delà de cette période, les données peuvent être archivées selon les exigences légales applicables ou supprimées si aucune obligation de conservation ne justifie leur maintien.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">5. Droits des personnes concernées</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>Conformément à la réglementation ivoirienne sur la protection des données, toute personne peut exercer ses droits, notamment :</p>
                <ul>
                    <li>Droit d’accès aux données la concernant ;</li>
                    <li>Droit de rectification en cas d’erreur ou d’inexactitude ;</li>
                    <li>Droit d’opposition au traitement ;</li>
                    <li>Droit à l’effacement dans les cas prévus par la loi ;</li>
                    <li>Droit à la portabilité et à la limitation du traitement.</li>
                </ul>
                <p>Pour toute demande relative à ces droits, l’utilisateur peut contacter GIES-CI par e-mail à l’adresse <strong>contact@gies-ci.com</strong> ou par voie de contact directe sur les coordonnées du site.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">6. Sécurité des données</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>GIES-CI met en place des mesures techniques et organisationnelles raisonnables pour protéger les données personnelles contre toute perte, destruction, accès non autorisé ou altération.</p>
                <p>Les données sensibles sont traitées avec une attention particulière, notamment via des outils sécurisés et une gestion rigoureuse des accès.</p>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_32px_80px_-40px_rgba(15,23,42,0.12)] sm:p-8 lg:p-10">
            <span class="text-brand-orange font-semibold text-sm uppercase tracking-wide">7. Modifications de la politique</span>
            <div class="prose prose-lg max-w-none mt-4 text-justify text-gray-600 leading-relaxed">
                <p>GIES-CI se réserve le droit de modifier la présente politique de confidentialité afin de la mettre en conformité avec les évolutions légales, réglementaires ou techniques.</p>
                <p>Les modifications seront publiées sur cette page avec la date de mise à jour.</p>
            </div>
        </div>
    </div>
</section>

@endsection

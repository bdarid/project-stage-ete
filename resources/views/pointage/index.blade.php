<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Pointage Quotidien"
            subtitle="Enregistrez votre présence et consultez votre statut du jour."
        />

    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <div class="max-w-4xl mx-auto">

            <x-erp.card
                title="Pointage du jour"
                subtitle="Votre présence pour aujourd'hui."
            >

                <div class="text-center mb-10">

                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-500/10 mb-5">

                        <svg class="w-10 h-10 text-blue-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>

                        </svg>

                    </div>

                    <h2 class="text-3xl font-bold text-white">

                        {{ \Carbon\Carbon::today()->translatedFormat('l d F Y') }}

                    </h2>

                    <p class="mt-2 text-slate-400">

                        Gérez votre pointage quotidien.

                    </p>

                </div>

                @if(!$pointageAujourdhui)
                <div class="rounded-2xl border border-slate-700 bg-slate-900/40 p-10">

    <div class="flex flex-col items-center">

        <div class="w-24 h-24 rounded-full bg-slate-800 flex items-center justify-center mb-6">

            <svg class="w-12 h-12 text-slate-400"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>

            </svg>

        </div>

        <h3 class="text-2xl font-bold text-white mb-2">
            Vous n'avez pas encore pointé.
        </h3>

        <p class="text-slate-400 text-center max-w-lg mb-8">
            Cliquez sur le bouton ci-dessous pour enregistrer votre heure
            d'arrivée et commencer votre journée de travail.
        </p>

        <form action="{{ route('pointage.entree') }}" method="POST">

            @csrf

            <button
                type="submit"
                class="inline-flex items-center gap-3 px-8 py-4 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold text-lg shadow-lg transition duration-200 hover:scale-105">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>

                </svg>

                Pointer mon arrivée

            </button>

        </form>

    </div>

</div>

@elseif($pointageAujourdhui && !$pointageAujourdhui->heure_depart)
<div class="rounded-2xl border border-green-500/20 bg-green-500/10 p-10">

    <div class="flex flex-col items-center">

        <div class="w-24 h-24 rounded-full bg-green-500/20 flex items-center justify-center mb-6">

            <svg class="w-12 h-12 text-green-400"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 13l4 4L19 7"/>

            </svg>

        </div>

        <h3 class="text-3xl font-bold text-green-400 mb-3">

            Arrivée enregistrée

        </h3>

        <p class="text-slate-300 text-lg">

            Heure d'arrivée :

            <span class="font-bold text-white">

                {{ \Carbon\Carbon::parse($pointageAujourdhui->heure_arrive)->format('H:i') }}

            </span>

        </p>

        <p class="text-slate-400 mt-4 text-center max-w-xl">

            Votre arrivée a bien été enregistrée.
            Lorsque votre journée est terminée, cliquez sur le bouton ci-dessous
            pour enregistrer votre heure de départ.

        </p>

        <form
            action="{{ route('pointage.sortie') }}"
            method="POST"
            class="mt-10">

            @csrf

            <button
                type="submit"
                class="inline-flex items-center gap-3 px-8 py-4 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-lg shadow-lg transition duration-200 hover:scale-105">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M18 12H6"/>

                </svg>

                Pointer mon départ

            </button>

        </form>

    </div>

</div>

@else
<div class="rounded-2xl border border-blue-500/20 bg-blue-500/10 p-10">

    <div class="flex flex-col items-center">

        <div class="w-24 h-24 rounded-full bg-blue-500/20 flex items-center justify-center mb-6">

            <svg class="w-12 h-12 text-blue-400"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 13l4 4L19 7"/>

            </svg>

        </div>

        <h3 class="text-3xl font-bold text-blue-400 mb-3">

            Journée terminée

        </h3>

        <p class="text-slate-300 mb-10">

            Votre présence a été enregistrée avec succès.

        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">

            {{-- Arrivée --}}
            <div class="rounded-xl bg-slate-900/50 border border-slate-700 p-6 text-center">

                <p class="text-slate-400 text-sm uppercase tracking-wider mb-2">
                    Heure d'arrivée
                </p>

                <p class="text-3xl font-bold text-green-400">

                    {{ \Carbon\Carbon::parse($pointageAujourdhui->heure_arrive)->format('H:i') }}

                </p>

            </div>

            {{-- Départ --}}
            <div class="rounded-xl bg-slate-900/50 border border-slate-700 p-6 text-center">

                <p class="text-slate-400 text-sm uppercase tracking-wider mb-2">
                    Heure de départ
                </p>

                <p class="text-3xl font-bold text-red-400">

                    {{ \Carbon\Carbon::parse($pointageAujourdhui->heure_depart)->format('H:i') }}

                </p>

            </div>

        </div>

        @php
            $arrivee = \Carbon\Carbon::parse($pointageAujourdhui->heure_arrive);
            $depart = \Carbon\Carbon::parse($pointageAujourdhui->heure_depart);
            $duree = $arrivee->diff($depart);
        @endphp

        <div class="mt-8 rounded-xl bg-slate-900 border border-slate-700 px-8 py-6 w-full">

            <div class="flex justify-between items-center">

                <span class="text-slate-400">
                    Temps travaillé aujourd'hui
                </span>

                <span class="text-2xl font-bold text-blue-400">

                    {{ $duree->h }}h {{ $duree->i }}min

                </span>

            </div>

        </div>

        <div class="mt-8">

            <span class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-green-500/10 text-green-400 font-semibold">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>

                </svg>

                Merci pour votre journée de travail !

            </span>

        </div>

    </div>

</div>

@endif

            </x-erp.card>

        </div>

    </div>

</x-app-layout>
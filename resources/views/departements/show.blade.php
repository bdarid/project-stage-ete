<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Détails du Département"
            subtitle="Consultez toutes les informations du département."
        />

    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-1">

                    <x-erp.card
                        title="Informations"
                        subtitle="Résumé du département"
                    >

                        <div class="space-y-6" style="padding:10%">

                            <div class="flex items-center gap-4">

                                <div class="w-16 h-16 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 text-2xl font-bold">

                                    {{ strtoupper(substr($departement->nom_departement,0,1)) }}

                                </div>

                                <div>

                                    <h3 class="text-xl font-bold text-white">

                                        {{ $departement->nom_departement }}

                                    </h3>

                                    <p class="text-slate-400">

                                        Département #{{ $departement->id }}

                                    </p>

                                </div>

                            </div>

                            <div class="border-t border-slate-700 pt-5 space-y-4">

                                <div class="flex justify-between">

                                    <span class="text-slate-400">

                                        Employés

                                    </span>

                                    <span class="text-white font-semibold">

                                        {{ $departement->users->count() }}

                                    </span>

                                </div>

                                <div class="flex justify-between">

                                    <span class="text-slate-400">

                                        Objectifs

                                    </span>

                                    <span class="text-white font-semibold">

                                        {{ $departement->objectifs->count() }}

                                    </span>

                                </div>

                                <div class="flex justify-between">

                                    <span class="text-slate-400">

                                        Créé le

                                    </span>

                                    <span class="text-white">

                                        {{ $departement->created_at->format('d/m/Y') }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </x-erp.card>

                </div>

                <div class="lg:col-span-2">
                                    <x-erp.card
                        title="Employés"
                        subtitle="Employés appartenant à ce département"
                        :count="$departement->users->count()"
                        label="Employés"
                    >

                        <div class="space-y-3">

                            @forelse($departement->users as $user)

                                <div class="flex items-center justify-between rounded-xl border border-slate-700 bg-slate-800 hover:bg-slate-700 transition p-4">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">

                                            {{ strtoupper(substr($user->name,0,1)) }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-white">

                                                {{ $user->name }}

                                            </p>

                                            <p class="text-sm text-slate-400">

                                                {{ $user->email }}

                                            </p>

                                        </div>

                                    </div>

                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold">

                                        Employé

                                    </span>

                                </div>

                            @empty

                                <div class="py-10 text-center text-slate-500">

                                    Aucun employé associé.

                                </div>

                            @endforelse

                        </div>

                    </x-erp.card>

                </div>

            </div>

            <div class="mt-6">
                            {{-- Objectifs associés --}}
                <div class="mt-8">

                    <x-erp.card
                        title="Objectifs associés"
                        subtitle="Les objectifs rattachés à ce département."
                        :count="$departement->objectifs->count()"
                        label="Objectifs"
                    >

                        @forelse($departement->objectifs as $objectif)

                            <div class="border border-slate-700 rounded-xl p-5 mb-4 bg-slate-900/30">

                                <div class="flex items-start justify-between">

                                    <div>

                                        <h4 class="text-lg font-semibold text-white">
                                            {{ $objectif->titre_objectif }}
                                        </h4>

                                        <p class="text-slate-400 mt-2">
                                            {{ $objectif->description_objectif }}
                                        </p>

                                    </div>

                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold">
                                        {{ $objectif->etat_avancement_objectif }}%
                                    </span>

                                </div>

                                <div class="mt-5">

                                    <div class="w-full h-2 bg-slate-700 rounded-full overflow-hidden">

                                        <div
                                            class="h-full bg-blue-500 rounded-full"
                                            style="width: {{ $objectif->etat_avancement_objectif }}%">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="py-10 text-center">

                                <svg class="mx-auto w-12 h-12 mb-3 text-slate-500"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>

                                </svg>

                                <p class="text-slate-500">
                                    Aucun objectif associé.
                                </p>

                            </div>

                        @endforelse

                    </x-erp.card>

                </div>
                                <div class="flex justify-end gap-3 mt-8">

                    <a
                        href="{{ route('departements.index') }}"
                        class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition">

                        Retour

                    </a>

                    <a
                        href="{{ route('departements.edit', $departement) }}"
                        class="px-5 py-2.5 rounded-xl bg-yellow-600 hover:bg-yellow-700 text-white font-semibold transition">

                        Modifier

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
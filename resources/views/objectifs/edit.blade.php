<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Modifier un Objectif"
            subtitle="Modifiez les informations de cet objectif."
        >

            <a
                href="{{ route('objectifs.index') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-slate-600 hover:bg-slate-700 rounded-xl font-semibold text-white transition">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7"/>

                </svg>

                Retour

            </a>

        </x-erp.page-header>

    </x-slot>

    <div class="space-y-6">

        <x-erp.alert />

        @if ($errors->any())

            <div class="rounded-xl border border-red-500/30 bg-red-500/10 p-5">

                <h3 class="text-red-400 font-semibold mb-3">
                    Des erreurs sont présentes :
                </h3>

                <ul class="list-disc ml-6 text-red-300 space-y-1">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <x-erp.card
            title="Informations de l'objectif"
            subtitle="Modifiez les informations principales."
        >

            <form
                action="{{ route('objectifs.update',$objectif->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Titre --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-slate-300 mb-2">
                            Titre
                        </label>

                        <input
                            type="text"
                            name="titre_objectif"
                            value="{{ old('titre_objectif',$objectif->titre_objectif) }}"
                            class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>

                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-slate-300 mb-2">
                            Description
                        </label>

                        <textarea
                            name="description_objectif"
                            rows="5"
                            class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>{{ old('description_objectif',$objectif->description_objectif) }}</textarea>

                    </div>

                    {{-- Date début --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-300 mb-2">
                            Date de début
                        </label>

                        <input
                            type="date"
                            name="date_debut_obj"
                            value="{{ old('date_debut_obj',$objectif->date_debut_obj) }}"
                            class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3">

                    </div>

                    {{-- Date fin --}}
                    <div>

                        <label class="block text-sm font-semibold text-slate-300 mb-2">
                            Date de fin
                        </label>

                        <input
                            type="date"
                            name="date_fin_obj"
                            value="{{ old('date_fin_obj',$objectif->date_fin_obj) }}"
                            class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3">

                    </div>

                    {{-- Avancement --}}
<div class="md:col-span-2">

    <label class="block text-sm font-semibold text-slate-300 mb-3">
        Avancement
    </label>

    <div class="flex items-center gap-4">

        <input
            type="range"
            name="etat_avancement_objectif"
            min="0"
            max="100"
            step="1"
            value="{{ old('etat_avancement_objectif', $objectif->etat_avancement_objectif) }}"
            class="w-full h-2 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
            oninput="document.getElementById('progressValue').innerText = this.value + '%'">

        <span
            id="progressValue"
            class="w-16 text-center px-3 py-2 rounded-lg bg-blue-600 text-white font-bold">

            {{ old('etat_avancement_objectif', $objectif->etat_avancement_objectif) }}%

        </span>

    </div>

</div>
                                        {{-- Employés --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-slate-300 mb-3">
                            Employés concernés
                        </label>

                        <div class="border border-slate-700 rounded-xl p-4 bg-slate-900 max-h-72 overflow-y-auto">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                                @foreach($users as $user)

                                    <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-700 hover:border-blue-500 hover:bg-slate-800 cursor-pointer transition">

                                        <input
                                            type="checkbox"
                                            name="users[]"
                                            value="{{ $user->id }}"
                                            class="rounded border-slate-600 text-blue-600 focus:ring-blue-500"

                                            {{ $objectif->users->contains($user->id) ? 'checked' : '' }}>

                                        <div>

                                            <p class="font-medium text-white">
                                                {{ $user->name_users }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Employé
                                            </p>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>

                    

                    </div>
                                        {{-- Employés --}}
                   

                    {{-- Départements --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-semibold text-slate-300 mb-3">
                            Départements associés
                        </label>

                        <div class="border border-slate-700 rounded-xl p-4 bg-slate-900 max-h-72 overflow-y-auto">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                                @foreach($departements as $departement)

                                    <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-700 hover:border-green-500 hover:bg-slate-800 cursor-pointer transition">

                                        <input
                                            type="checkbox"
                                            name="departements[]"
                                            value="{{ $departement->id }}"
                                            class="rounded border-slate-600 text-green-600 focus:ring-green-500"

                                            {{ $objectif->departement->contains($departement->id) ? 'checked' : '' }}>

                                        <div>

                                            <p class="font-medium text-white">
                                                {{ $departement->nom_departement }}
                                            </p>

                                            <p class="text-xs text-slate-500">
                                                Département
                                            </p>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>
                                        </div>

                    {{-- Boutons --}}
                    <div class="mt-8 pt-6 border-t border-slate-700 flex justify-end gap-3">

                        <a
                            href="{{ route('objectifs.index') }}"
                            class="inline-flex items-center px-5 py-3 rounded-xl border border-slate-600 text-slate-300 hover:bg-slate-700 transition">

                            Annuler

                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                            Mettre à jour l'objectif

                        </button>

                    </div>

                </form>

            </div>

        </x-erp.card>

    </div>

</x-app-layout>
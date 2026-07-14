<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Créer un Objectif"
            subtitle="Définissez un nouvel objectif, ses échéances et assignez les équipes concernées."
        />
    </x-slot>

    <div class="space-y-6 pb-12">

        <x-erp.alert />

        <div class="max-w-5xl mx-auto">

            <x-erp.card
                title="Détails de l'objectif"
                subtitle="Remplissez les informations ci-dessous pour créer l'objectif."
            >

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-red-300">
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('objectifs.store') }}" method="POST" class="space-y-8 p-2">

                    @csrf

                    {{-- BLOC 1 : Informations générales --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                                Informations générales
                            </h4>
                        </div>

                        {{-- Titre --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Titre de l'objectif
                            </label>
                            <input
                                type="text"
                                name="titre_objectif"
                                value="{{ old('titre_objectif') }}"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm placeholder-slate-600"
                                placeholder="Ex: Augmenter les ventes de 20%"
                                required>
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Description
                            </label>
                            <textarea
                                name="description_objectif"
                                rows="4"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm placeholder-slate-600"
                                placeholder="Détaillez les attentes et les KPIs de cet objectif..."
                                required>{{ old('description_objectif') }}</textarea>
                        </div>
                    </div>

                    {{-- BLOC 2 : Planification et Suivi --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="md:col-span-3">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                                Planification & Suivi
                            </h4>
                        </div>

                        {{-- Date de début --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Date de début
                            </label>
                            <input
                                type="date"
                                name="date_debut_obj"
                                value="{{ old('date_debut_obj') }}"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                        </div>

                        {{-- Date de fin --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Date de fin
                            </label>
                            <input
                                type="date"
                                name="date_fin_obj"
                                value="{{ old('date_fin_obj') }}"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                        </div>

                        {{-- Avancement --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Avancement initial (%)
                            </label>
                            <input
                                type="number"
                                name="etat_avancement_objectif"
                                min="0"
                                max="100"
                                value="{{ old('etat_avancement_objectif', 0) }}"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                        </div>
                    </div>

                    {{-- BLOC 3 : Assignation --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div class="md:col-span-2">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                                Assignation des ressources
                            </h4>
                        </div>

                        {{-- Employés concernés --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Employés concernés
                            </label>
                            <select
                                name="users[]"
                                multiple
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm h-40 custom-scrollbar">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" class="py-1 px-2 hover:bg-slate-800 rounded-lg">
                                        {{ $user->name_users }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-slate-500 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Maintenez <kbd class="bg-slate-800 text-slate-300 px-1 py-0.5 rounded border border-slate-700 font-mono text-[10px]">CTRL</kbd> (ou <kbd class="bg-slate-800 text-slate-300 px-1 py-0.5 rounded border border-slate-700 font-mono text-[10px]">CMD</kbd>) pour en sélectionner plusieurs.
                            </p>
                        </div>

                        {{-- Départements concernés --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Départements concernés
                            </label>
                            <select
                                name="departements[]"
                                multiple
                                class="w-full rounded-xl border-slate-700 bg-slate-900 text-white focus:border-blue-500 focus:ring-blue-500 shadow-sm h-40 custom-scrollbar">
                                @foreach($departements as $departement)
                                    <option value="{{ $departement->id }}" class="py-1 px-2 hover:bg-slate-800 rounded-lg">
                                        {{ $departement->nom_departement }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-slate-500 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Maintenez <kbd class="bg-slate-800 text-slate-300 px-1 py-0.5 rounded border border-slate-700 font-mono text-[10px]">CTRL</kbd> (ou <kbd class="bg-slate-800 text-slate-300 px-1 py-0.5 rounded border border-slate-700 font-mono text-[10px]">CMD</kbd>) pour en sélectionner plusieurs.
                            </p>
                        </div>
                    </div>

                    {{-- BLOC 4 : Données Avancées --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div class="md:col-span-2">
                            <h4 class="text-sm font-medium text-slate-400 uppercase tracking-wider mb-4 border-b border-slate-700/50 pb-2">
                                Configuration Avancée
                            </h4>
                        </div>

                        {{-- JSON --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-300 mb-2">
                                Fichier JSON <span class="text-slate-500 font-normal">(Optionnel)</span>
                            </label>
                            <textarea
                                name="file_json"
                                rows="5"
                                class="w-full rounded-xl border-slate-700 bg-slate-900 font-mono text-sm text-green-400 focus:border-blue-500 focus:ring-blue-500 shadow-sm placeholder-slate-700"
                                placeholder='{
  "kpi_secondaire": "valeur",
  "budget": 5000
}'>{{ old('file_json') }}</textarea>
                            <p class="text-slate-500 text-xs mt-2">
                                Utilisé pour injecter des paramètres de configuration ou des métadonnées supplémentaires.
                            </p>
                        </div>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex justify-end gap-3 border-t border-slate-700 pt-6 mt-8">
                        <a href="{{ route('objectifs.index') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white transition shadow-sm">
                            Annuler
                        </a>

                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold transition shadow-sm">
                            Créer l'objectif
                        </button>
                    </div>

                </form>

            </x-erp.card>

        </div>
    </div>

</x-app-layout>
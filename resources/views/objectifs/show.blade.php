<x-app-layout>

    <x-slot name="header">
        <x-erp.page-header
            title="Détails de l'objectif"
            subtitle="Vue détaillée : {{ $objectif->titre_objectif }}"
        >
            <div class="flex gap-3">
                <a href="{{ route('objectifs.edit', $objectif->id) }}"
                    class="px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-medium transition shadow-sm">
                    Modifier
                </a>
                <a href="{{ route('objectifs.index') }}"
                    class="px-4 py-2 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-medium transition shadow-sm">
                    Retour
                </a>
            </div>
        </x-erp.page-header>
    </x-slot>

    <div class="space-y-6 pb-12">

        <div class="max-w-5xl mx-auto">

            <x-erp.card
                title="Informations complètes"
                subtitle="Vision globale des paramètres et de la progression."
            >

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-2">

                    {{-- Titre --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Titre</label>
                        <h3 class="text-2xl font-bold text-white">
                            {{ $objectif->titre_objectif }}
                        </h3>
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                        <div class="p-4 bg-slate-950/50 rounded-xl border border-slate-700/50 text-slate-300">
                            {{ $objectif->description_objectif }}
                        </div>
                    </div>

                    {{-- Dates --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Date de début</label>
                        <div class="text-lg text-slate-200 font-medium">
                            {{ $objectif->date_debut_obj ? \Carbon\Carbon::parse($objectif->date_debut_obj)->format('d/m/Y') : 'Non définie' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Date de fin</label>
                        <div class="text-lg text-slate-200 font-medium">
                            {{ $objectif->date_fin_obj ? \Carbon\Carbon::parse($objectif->date_fin_obj)->format('d/m/Y') : 'Non définie' }}
                        </div>
                    </div>

                    {{-- Progression --}}
                    <div class="md:col-span-2">
                        <div class="flex justify-between items-end mb-2">
                            <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Progression</label>
                            <span class="text-blue-400 font-bold">{{ $objectif->etat_avancement_objectif }}%</span>
                        </div>
                        <div class="w-full bg-slate-700 rounded-full h-4 overflow-hidden shadow-inner">
                            <div class="bg-blue-600 h-4 rounded-full transition-all duration-500"
                                style="width: {{ $objectif->etat_avancement_objectif }}%;">
                            </div>
                        </div>
                    </div>

                    {{-- Assignations --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Employés assignés</label>
                        <div class="flex flex-wrap gap-2">
                            @forelse($objectif->users as $user)
                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 text-sm">
                                    {{ $user->name_users }}
                                </span>
                            @empty
                                <span class="text-slate-600 italic text-sm">Aucun employé affecté.</span>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Départements concernés</label>
                        <div class="flex flex-wrap gap-2">
                            @forelse($objectif->departement as $departement)
                                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-slate-800 border border-slate-700 text-slate-300 text-sm">
                                    {{ $departement->nom_departement }}
                                </span>
                            @empty
                                <span class="text-slate-600 italic text-sm">Aucun département.</span>
                            @endforelse
                        </div>
                    </div>

                    {{-- JSON --}}
                    @if(!empty($objectif->file_json))
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Données configuration (JSON)</label>
                            <pre class="bg-slate-950 p-4 rounded-xl border border-slate-700 text-green-400 font-mono text-sm overflow-x-auto shadow-inner">{{ json_encode($objectif->file_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </div>
                    @endif

                </div>

            </x-erp.card>

        </div>

    </div>

</x-app-layout>
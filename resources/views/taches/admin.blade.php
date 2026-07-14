<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="{{ __('Gestion des Tâches (Vue Admin)') }}" subtitle="Suivi en temps réel de l'avancement des tâches et des assignations d'équipe.">
            
        </x-erp.page-header>
    </x-slot>
    <a href="{{ route('taches.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-600/20 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Assigner une tâche
            </a>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de succès --}}
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-500/40 bg-green-500/10 p-4 text-green-400 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Conteneur Principal --}}
            <x-erp.card title="Tâches en cours" subtitle="Vue globale sur l'état d'avancement des collaborateurs.">
                <div class="overflow-x-auto -mx-6">
                    <table class="w-full text-left border-collapse" >
                        <thead >
                            <tr class="border-b border-slate-700/50 text-slate-400 uppercase text-xs tracking-wider">
                                <th class="py-4 px-6 font-semibold">Titre</th>
                                <th class="py-4 px-6 font-semibold">Assigné à</th>
                                <th class="py-4 px-6 font-semibold">Début</th>
                                <th class="py-4 px-6 font-semibold">Fin estimée</th>
                                <th class="py-3 px-6 font-semibold text-center">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50 text-slate-300 text-sm">
                            @foreach($taches as $tache)
                                <tr class="hover:bg-slate-800/30 transition-colors">
                                    {{-- Titre de la tâche --}}
                                    <td class="py-4 px-6 font-semibold text-slate-100">
                                        {{ $tache->titre_taches }}
                                    </td>

                                    {{-- Assignation --}}
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-400 uppercase border border-slate-700/80">
                                                {{ substr($tache->employe_nom ?? 'N', 0, 1) }}
                                            </div>
                                            <span class="font-medium text-slate-200">
                                                {{ $tache->employe_nom ?? 'Non assigné' }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Date Début --}}
                                    <td class="py-4 px-6 text-slate-400">
                                        {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}
                                    </td>

                                    {{-- Date Fin --}}
                                    <td class="py-4 px-6 text-slate-400">
                                        {{ $tache->date_fin ? \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') : '-' }}
                                    </td>

                                    {{-- Statut customisé --}}
                                    <td class="py-4 px-6 text-center">
                                        @if($tache->statut === 'fini')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                                Fini
                                            </span>
                                        @elseif($tache->statut === 'en cours')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                                En cours
                                            </span>
                                        @elseif($tache->statut === 'en retard')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-500/10 text-red-400 border border-red-500/20">
                                                En retard
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-500/10 text-slate-400 border border-slate-500/20">
                                                {{ ucfirst($tache->statut) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-erp.card>

        </div>
    </div>
</x-app-layout>
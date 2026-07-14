<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Gestion des Tâches (Vue Admin)" subtitle="Suivi en temps réel de l'avancement des tâches et des assignations d'équipe." />
    </x-slot>

    <a href="{{ route('taches.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg shadow-blue-600/20 transition mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Assigner une tâche
    </a>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="rounded-2xl border border-green-500/40 bg-green-500/10 p-4 text-green-400 text-sm flex items-center gap-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Barre de Recherche et Filtres --}}
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4 mb-6">
                <form action="{{ route('taches.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par titre ou employé..." 
                           class="flex-1 bg-slate-900 border border-slate-700 rounded-lg text-white px-4 py-2">
                    
                    {{-- Filtre Statut --}}
                    <select name="status" class="bg-slate-900 border border-slate-700 rounded-lg text-white px-4 py-2">
                        <option value="">Tous les statuts</option>
                        <option value="en cours" {{ request('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="fini" {{ request('status') == 'fini' ? 'selected' : '' }}>Fini</option>
                        <option value="en retard" {{ request('status') == 'en retard' ? 'selected' : '' }}>En retard</option>
                    </select>

                    {{-- Nouveau Filtre Priorité --}}
                    <select name="priorite" class="bg-slate-900 border border-slate-700 rounded-lg text-white px-4 py-2">
                        <option value="">Toutes priorités</option>
                        <option value="basse" {{ request('priorite') == 'basse' ? 'selected' : '' }}>Basse</option>
                        <option value="haute" {{ request('priorite') == 'haute' ? 'selected' : '' }}>Haute</option>
                        <option value="urgent" {{ request('priorite') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">Filtrer</button>
                    @if(request()->anyFilled(['search', 'status', 'priorite']))
                        <a href="{{ route('taches.index') }}" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-lg transition">Réinitialiser</a>
                    @endif
                </form>
            </div>

            <x-erp.card title="Tâches en cours" subtitle="Vue globale sur l'état d'avancement des collaborateurs.">
                <div class="overflow-x-auto -mx-6">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-700/50 text-slate-400 uppercase text-xs tracking-wider">
                                <th class="py-4 px-6">Titre</th>
                                <th class="py-4 px-6">Assigné à</th>
                                <th class="py-4 px-6">Début</th>
                                <th class="py-4 px-6">Fin</th>
                                <th class="py-4 px-6">Duree</th>
                                <th class="py-4 px-6 text-center">Statut</th>
                                <th class="py-4 px-6 text-center">Priorité</th>
                                <th class="py-4 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50 text-slate-300 text-sm">
                            @foreach($taches as $tache)
                                <tr class="hover:bg-slate-800/30 transition-colors">
                                    <td class="py-4 px-6 font-semibold text-slate-100">{{ $tache->titre_taches }}</td>
                                    <td class="py-4 px-6">{{ $tache->employe_nom ?? 'Non assigné' }}</td>
                                    <td class="py-4 px-6">{{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}</td>
                                    <td class="py-4 px-6">{{ $tache->date_fin ? \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') : '-' }}</td>
                                    <td class="py-4 px-6">{{ $tache->duree }} days</td>
                                    
                                    {{-- Colonne Statut --}}
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold 
                                            {{ $tache->statut === 'fini' ? 'bg-green-500/10 text-green-400' : 
                                              ($tache->statut === 'en retard' ? 'bg-red-500/10 text-red-400' : 'bg-blue-500/10 text-blue-400') }}">
                                            {{ ucfirst($tache->statut) }}
                                        </span>
                                    </td>

                                    {{-- Colonne Priorité --}}
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold 
                                            {{ $tache->priorite === 'urgent' ? 'bg-red-600/20 text-red-500' : 
                                              ($tache->priorite === 'haute' ? 'bg-orange-500/20 text-orange-500' : 'bg-slate-500/20 text-slate-400') }}">
                                            {{ ucfirst($tache->priorite) }}
                                        </span>
                                    </td>

                                    <td class="py-4 px-6 text-right flex justify-end gap-2 items-center">
                                        <a href="{{ route('taches.edit', $tache->id) }}" class="text-blue-400 hover:text-blue-300 font-semibold text-xs transition">Modifier</a>
                                        <form action="{{ route('taches.destroy', $tache->id) }}" method="POST" onsubmit="return confirm('Supprimer cette tâche ?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 font-semibold text-xs transition">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-6">
                        {{ $taches->links() }}
                    </div>
                </div>
            </x-erp.card>
        </div>
    </div>
</x-app-layout>
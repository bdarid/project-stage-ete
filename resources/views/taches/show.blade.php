<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="Détails de la tâche" subtitle="Consultez les informations complètes de votre mission.">
            <a href="{{ route('taches.employe') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Retour
            </a>
        </x-erp.page-header>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-700 rounded-2xl p-8 shadow-xl">
                
                {{-- En-tête de la carte --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <h1 class="text-3xl font-bold text-white">{{ $tache->titre_taches }}</h1>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 rounded-lg text-sm font-semibold border 
                            {{ $tache->statut === 'fini' ? 'bg-green-500/10 text-green-400 border-green-500/20' : 
                              ($tache->statut === 'en retard' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/20') }}">
                            {{ ucfirst($tache->statut) }}
                        </span>
                        <span class="px-3 py-1 rounded-lg text-sm font-semibold border 
                            {{ $tache->priorite === 'urgent' ? 'bg-red-600/20 text-red-500 border-red-500/20' : 
                              ($tache->priorite === 'haute' ? 'bg-orange-500/20 text-orange-500 border-orange-500/20' : 'bg-slate-500/20 text-slate-400 border-slate-500/20') }}">
                            {{ ucfirst($tache->priorite) }}
                        </span>
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-8">
                    <h3 class="text-slate-400 text-sm font-medium uppercase tracking-wider mb-2">Description</h3>
                    <div class="bg-slate-800/50 border border-slate-700/50 p-4 rounded-xl text-slate-200 leading-relaxed break-all">
                        {{ $tache->description_taches }}
                    </div>
                </div>

                {{-- Grille des dates --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-800 p-4 rounded-xl border border-slate-700">
                        <span class="text-slate-400 text-xs uppercase font-bold">Date de début</span>
                        <p class="text-white text-lg mt-1 font-medium">{{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}</p>
                    </div>
                    @if($tache->date_fin)
                    <div class="bg-slate-800 p-4 rounded-xl border border-slate-700">
                        <span class="text-slate-400 text-xs uppercase font-bold">Échéance</span>
                        <p class="text-white text-lg mt-1 font-medium {{ $tache->statut === 'en retard' ? 'text-red-400' : '' }}">
                            {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
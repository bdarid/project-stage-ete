<x-app-layout>
    <x-slot name="header">
        <x-erp.page-header title="{{ __('Mes Tâches Assignées') }}" subtitle="Consultez et mettez à jour l'état d'avancement de vos missions en cours.">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800 text-xs font-medium text-slate-300 border border-slate-700/80">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                Espace Collaborateur
            </span>
        </x-erp.page-header>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Notification de succès --}}
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-500/40 bg-green-500/10 p-4 text-green-400 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Barre de Recherche et Filtres --}}
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4 mb-6 shadow-sm">
                <form action="{{ route('taches.employe') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher dans mes tâches..." 
                           class="flex-1 bg-slate-900 border border-slate-700 rounded-lg text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    
                    <select name="status" class="bg-slate-900 border border-slate-700 rounded-lg text-white px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Tous les statuts</option>
                        <option value="en cours" {{ request('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="fini" {{ request('status') == 'fini' ? 'selected' : '' }}>Fini</option>
                        <option value="en retard" {{ request('status') == 'en retard' ? 'selected' : '' }}>En retard</option>
                    </select>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition">Rechercher</button>
                    @if(request()->anyFilled(['search', 'status']))
                        <a href="{{ route('taches.employe') }}" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-lg transition text-center flex items-center justify-center">Réinitialiser</a>
                    @endif
                </form>
            </div>

            {{-- Grille de tâches --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($taches as $tache)
                    
                    {{-- Carte de la tâche avec redirection au clic dans un nouvel onglet --}}
                   <a href="{{ route('taches.show', $tache->id) }}" target="_blank" class="block group h-full">
    <div class="relative bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col justify-between hover:border-blue-500/50 hover:shadow-blue-500/10 transition-all duration-300 shadow-xl shadow-black/10 h-full">
                        
                        {{-- Indicateur de couleur supérieur --}}
                        <div class="absolute top-0 left-0 right-0 h-1.5 rounded-t-2xl 
                            {{ $tache->statut === 'fini' ? 'bg-green-500/80' : '' }}
                            {{ $tache->statut === 'en cours' ? 'bg-blue-500/80' : '' }}
                            {{ $tache->statut === 'en retard' ? 'bg-red-500/80' : '' }}">
                        </div>

                        <div class="mb-5 mt-2">
                            {{-- Badges --}}
                            <div class="mb-4 flex gap-2">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border
                                    {{ $tache->statut === 'fini' ? 'bg-green-500/10 text-green-400 border-green-500/20' : 
                                      ($tache->statut === 'en retard' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/20') }}">
                                    {{ ucfirst($tache->statut) }}
                                </span>
                                
                                @if(isset($tache->priorite))
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold border
                                        {{ $tache->priorite === 'urgent' ? 'bg-red-600/20 text-red-500 border-red-500/20' : 
                                          ($tache->priorite === 'haute' ? 'bg-orange-500/20 text-orange-500 border-orange-500/20' : 'bg-slate-500/20 text-slate-400 border-slate-500/20') }}">
                                        {{ ucfirst($tache->priorite) }}
                                    </span>
                                @endif
                            </div>

                            {{-- Titre & Description --}}
                            <h3 class="font-bold text-lg text-slate-100 mb-2 leading-snug group-hover:text-blue-400 transition-colors">{{ $tache->titre_taches }}</h3>
                            <p class="text-sm text-slate-400 leading-relaxed mb-4 line-clamp-3">{{ $tache->description_taches }}</p>
                        </div>

                        {{-- Dates et mise à jour --}}
                        <div class="mt-auto">
                            <div class="space-y-1.5 border-t border-slate-800/80 pt-4 mb-4 text-xs text-slate-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span><strong>Début :</strong> {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}</span>
                                </div>
                                @if($tache->date_fin)

    <div class="flex items-center gap-2">
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>

        <span class="{{ $tache->statut === 'en retard' ? 'text-red-400' : '' }}">
            <strong>Échéance :</strong>
            {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}
        </span>

    </div>

    <div class="flex items-center gap-2">
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>

        <span>
            <strong>Durée :</strong>

            {{
                \Carbon\Carbon::parse($tache->date_debut)
                    ->diffInDays(\Carbon\Carbon::parse($tache->date_fin)) 
            }}

            jour(s)
        </span>

    </div>

@endif
                            </div>

                            {{-- Formulaire de changement de statut --}}
                            {{-- On utilise @click.stop pour empêcher d'ouvrir la page si on clique sur le menu déroulant --}}
                            <div @click.stop>
                                <form action="{{ route('taches.updateStatut', $tache->id) }}" method="POST" class="pt-4 border-t border-slate-800/80 flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <select name="statut" class="text-sm rounded-xl border border-slate-700 bg-slate-900 text-slate-200 px-3 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none transition flex-1 cursor-pointer">
                                        <option value="en cours" {{ $tache->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="fini" {{ $tache->statut == 'fini' ? 'selected' : '' }}>Fini</option>
                                        <option value="en retard" {{ $tache->statut == 'en retard' ? 'selected' : '' }}>En retard</option>
                                    </select>
                                    <button type="submit" class="inline-flex items-center justify-center p-2.5 rounded-xl bg-slate-800 hover:bg-blue-600 border border-slate-700 hover:border-blue-500 text-slate-300 hover:text-white transition" title="Mettre à jour">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-span-full bg-slate-900 border border-slate-800 rounded-2xl p-12 text-center text-slate-500 shadow-xl">
                        <div class="w-16 h-16 rounded-full bg-slate-800/50 flex items-center justify-center mx-auto mb-4 border border-slate-700/50">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                        <h3 class="font-semibold text-slate-200 text-lg mb-1">Aucune tâche trouvée</h3>
                        <p class="text-sm text-slate-400">Aucune tâche ne correspond à vos critères ou vous n'avez pas de tâche en cours.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
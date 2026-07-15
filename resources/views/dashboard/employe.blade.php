<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-100">Tableau de Bord Employé</h2>
    </x-slot>

    <div class="py-8 bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Statistiques Rapides -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-5 bg-slate-800 border border-slate-700 rounded-2xl shadow-sm">
                    <p class="text-xs font-bold text-green-400 uppercase tracking-wider">Heures ce mois</p>
                    <p class="text-3xl font-black text-white mt-2">{{ $heuresMois }}<span class="text-lg text-slate-500">h</span></p>
                </div>
                <div class="p-5 bg-slate-800 border border-slate-700 rounded-2xl shadow-sm">
                    <p class="text-xs font-bold text-blue-400 uppercase tracking-wider">Nombre de taches en cours</p>
                    <p class="text-3xl font-black text-white mt-2">{{ $tachesEnCours }}</p>
                </div>
                <div class="p-5 bg-slate-800 border border-slate-700 rounded-2xl shadow-sm">
                    <p class="text-xs font-bold text-red-400 uppercase tracking-wider">Nombre de taches en retard</p>
                    <p class="text-3xl font-black text-white mt-2">{{ $tachesEnRetard }}</p>
                </div>
                <div class="p-5 bg-slate-800 border border-slate-700 rounded-2xl shadow-sm">
                    <p class="text-xs font-bold text-purple-400 uppercase tracking-wider">Solde Congés</p>
                    <p class="text-3xl font-black text-white mt-2">{{ $soldeConges }} <span class="text-sm text-slate-500">Jours</span></p>
                </div>
                <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
    <h2 class="text-lg font-bold text-white mb-2">
        Mon Profil
    </h2>

    <p class="text-slate-400 text-sm mb-5">
        Modifiez vos informations personnelles et votre mot de passe.
    </p>

    <a href="{{ route('profile.edit') }}"
       class="inline-flex items-center px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
        Accéder au profil
    </a>
</div>
            </div>

            <!-- Contenu Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Liste des Tâches en Retard (Alerte) -->
                <div class="bg-slate-800 border border-red-500/20 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-red-400 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Tâches en retard
                        </h3>
                    </div>
                    <ul class="space-y-3">
                        @forelse($taches->where('statut', 'en retard') as $tache)
                            <li class="p-4 bg-red-500/5 rounded-xl border border-red-500/10 flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-bold text-slate-200">{{ $tache->titre_taches }}</p>
                                    <p class="text-xs text-red-400 mt-1">Échéance : {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}</p>
                                </div>
                                <span class="px-2 py-1 bg-red-500/20 text-red-500 text-[10px] font-bold uppercase rounded">Urgent</span>
                            </li>
                        @empty
                            <p class="text-slate-500 text-sm italic">Aucune tâche en retard. Bravo !</p>
                        @endforelse
                    </ul>
                </div>

                <!-- Liste des Tâches en cours -->
                <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            Tâches en cours
                        </h3>
                    </div>
                    <ul class="space-y-3">
                        @forelse($taches->where('statut', 'en cours') as $tache)
                            <li class="p-4 bg-slate-900/50 rounded-xl border border-slate-700/50 hover:border-slate-600 transition-colors">
                                <p class="text-sm font-medium text-slate-200">{{ $tache->titre_taches }}</p>
                                <p class="text-xs text-slate-500 mt-1">Début : {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}</p>
                            </li>
                        @empty
                            <p class="text-slate-500 text-sm italic">Aucune tâche active.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
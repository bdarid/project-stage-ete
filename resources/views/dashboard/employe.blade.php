<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-100 leading-tight">
                {{ __('Espace Collaborateur - Mon ERP') }}
            </h2>
            <span class="bg-green-500/20 border border-green-500/30 text-green-400 text-xs font-black px-3 py-1.5 rounded-md uppercase tracking-wider shadow-sm">
                Session Employé
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-900 min-h-screen">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-72 bg-slate-800 rounded-2xl shadow-lg border border-slate-700 p-6 shrink-0 h-fit">

                <div class="mb-4 border-b border-slate-700 pb-2 mt-2">
                    <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Mon Profil RH</h3>
                </div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 bg-blue-600/10 text-blue-400 border border-blue-500/20 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Mon Tableau de Bord
                    </a>
                    <a href="{{ route('pointage.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pointer Entrée / Sortie
                    </a>
                    <a href="{{ route('conges') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Mes Demandes de Congés
                    </a>
                </nav>

                <div class="mb-4 border-b border-slate-700 pb-2">
                    <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Mon Travail</h3>
                </div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('taches.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Mes Tâches Assignées
                    </a>
                    <a href="{{ route('produits.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4"></path></svg>
                        Consulter le Stock
                    </a>
                </nav>

                <div class="mb-4 border-b border-slate-700 pb-2">
                    <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Consultation</h3>
                </div>
                <nav class="space-y-1">
                    <a href="{{ route('objectifs.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Objectifs de l'Entreprise
                    </a>
                </nav>
            </aside>

            <main class="flex-1 space-y-6">

                <div class="bg-slate-800 rounded-2xl shadow-sm border border-slate-700 p-6 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Bonjour {{ Auth::user()->name ?? 'Collaborateur' }} 👋</h2>
                        <p class="text-slate-400 text-sm mt-1">Voici le résumé de votre journée et vos tâches en cours.</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-slate-400">Date du jour</p>
                        <p class="text-lg font-bold text-blue-400">{{ now()->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-5 bg-slate-800 border border-slate-700 hover:border-green-500/50 transition-colors rounded-2xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-green-400 uppercase tracking-wider relative z-10">Heures ce mois</p>
                        <p class="text-3xl font-black text-slate-100 mt-2 relative z-10">142<span class="text-lg font-medium text-slate-500">h</span></p>
                    </div>

                    <div class="p-5 bg-slate-800 border border-slate-700 hover:border-amber-500/50 transition-colors rounded-2xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-16 h-16 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-amber-400 uppercase tracking-wider relative z-10">Mes Tâches</p>
                        <p class="text-3xl font-black text-slate-100 mt-2 relative z-10">3 <span class="text-sm font-medium text-slate-500">À faire</span></p>
                    </div>

                    <div class="p-5 bg-slate-800 border border-slate-700 hover:border-purple-500/50 transition-colors rounded-2xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-purple-400 uppercase tracking-wider relative z-10">Solde de Congés</p>
                        <p class="text-3xl font-black text-slate-100 mt-2 relative z-10">18 <span class="text-sm font-medium text-slate-500">Jours</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-100 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Action Rapide
                        </h3>
                        <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-700 rounded-xl bg-slate-800/50">
                            <p class="text-slate-400 text-sm mb-4 text-center">N'oubliez pas de signaler votre arrivée pour que vos heures soient comptabilisées.</p>
                            <form action="{{ route('pointage.index') }}" method="GET">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg shadow-blue-500/30 transition-all flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                                    Pointer mon Entrée
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                À traiter aujourd'hui
                            </h3>
                            <a href="{{ route('taches.index') }}" class="text-sm text-blue-400 hover:text-blue-300 font-medium">Voir tout</a>
                        </div>

                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-700/50 hover:border-slate-600 transition-colors">
                                <div class="mt-0.5">
                                    <input type="checkbox" class="w-4 h-4 rounded border-slate-600 bg-slate-700 text-blue-500 focus:ring-blue-500/50 focus:ring-offset-slate-900">
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-200">Vérifier l'inventaire des produits A</p>
                                    <p class="text-xs text-amber-400 mt-1">Échéance : Aujourd'hui</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-700/50 hover:border-slate-600 transition-colors">
                                <div class="mt-0.5">
                                    <input type="checkbox" class="w-4 h-4 rounded border-slate-600 bg-slate-700 text-blue-500 focus:ring-blue-500/50 focus:ring-offset-slate-900">
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-200">Envoyer le rapport des ventes</p>
                                    <p class="text-xs text-slate-500 mt-1">Échéance : Demain</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </main>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-slate-100 leading-tight">
                {{ __('Tableau de bord - Administration Globale') }}
            </h2>
            <span class="bg-red-500/20 border border-red-500/30 text-red-400 text-xs font-black px-3 py-1.5 rounded-md uppercase tracking-wider shadow-sm">
                Super Admin
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-900 min-h-screen">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-72 bg-slate-800 rounded-2xl shadow-lg border border-slate-700 p-6 shrink-0 h-fit">

                <nav class="space-y-1 mb-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        Dashboard Principal
                    </a>
                </nav>

                <div class="mb-4 border-b border-slate-700 pb-2">
                    <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Ressources Humaines</h3>
                </div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Gestion des Employés
                    </a>
                    <a href="{{ route('pointage.adminindex') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Supervision Pointages
                    </a>
                    <a href="{{ route('conges') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Validation des Congés
                    </a>
                    <a href="{{ route('departements.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m9-7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Départements
                    </a>
                </nav>

                <div class="mb-4 border-b border-slate-700 pb-2">
                    <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Commercial & Finance</h3>
                </div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('achats.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Achats & Fournisseurs
                    </a>
                    <a href="{{ route('ventes.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>
                        Ventes & Facturation
                    </a>
                </nav>

                <div class="mb-4 border-b border-slate-700 pb-2">
                    <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Logistique & Catalogue</h3>
                </div>
                <nav class="space-y-1 mb-8">
                    <a href="{{ route('produits.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4"></path></svg>
                        Catalogue Produits
                    </a>
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Catégories
                    </a>
                    <a href="{{ route('stocks.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                        Mouvements de Stock
                    </a>
                </nav>

                <div class="mb-4 border-b border-slate-700 pb-2">
                    <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-wider">Opérations</h3>
                </div>
                <nav class="space-y-1">
                    <a href="{{ route('taches.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Suivi des Tâches
                    </a>
                    <a href="{{ route('taches.create') }}" class="flex items-center gap-3 px-4 py-2.5 text-blue-400 hover:bg-blue-500/10 hover:text-blue-300 rounded-xl font-semibold transition-colors mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Assigner une Tâche
                    </a>
                    <a href="{{ route('objectifs.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-slate-400 hover:bg-slate-700/50 hover:text-slate-200 rounded-xl font-medium transition-colors mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Objectifs Globaux
                    </a>
                </nav>
            </aside>

            <main class="flex-1 space-y-6">

                <div class="bg-slate-800 rounded-2xl shadow-sm border border-slate-700 p-6 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Bonjour {{ Auth::user()->name_users ?? Auth::user()->name }} 👑</h2>
                        <p class="text-slate-400 text-sm mt-1">Voici la vue d'ensemble de l'ERP pour aujourd'hui.</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-slate-400">Date Système</p>
                        <p class="text-lg font-bold text-red-400">{{ now()->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-5 bg-slate-800 border border-slate-700 hover:border-red-500/50 transition-colors rounded-2xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-red-400 uppercase tracking-wider relative z-10">Alertes Stock</p>
                        <p class="text-3xl font-black text-slate-100 mt-2 relative z-10">2 <span class="text-lg font-medium text-slate-500">Produits</span></p>
                    </div>

                    <div class="p-5 bg-slate-800 border border-slate-700 hover:border-blue-500/50 transition-colors rounded-2xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-blue-400 uppercase tracking-wider relative z-10">Effectif Actif</p>
                        <p class="text-3xl font-black text-slate-100 mt-2 relative z-10">12 / 15 <span class="text-sm font-medium text-slate-500">Présents</span></p>
                    </div>

                    <div class="p-5 bg-slate-800 border border-slate-700 hover:border-green-500/50 transition-colors rounded-2xl shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-green-400 uppercase tracking-wider relative z-10">Bénéfice Net</p>
                        <p class="text-3xl font-black text-slate-100 mt-2 relative z-10">18.4K <span class="text-sm font-medium text-slate-500">DH</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-100 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Actions Rapides
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ route('users.create') }}" class="flex items-center gap-3 p-4 bg-slate-900/50 rounded-xl border border-slate-700/50 hover:border-blue-500/50 hover:bg-slate-800 transition-colors group">
                                <div class="p-2 bg-blue-500/10 text-blue-400 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Nouvel Employé</p>
                                </div>
                            </a>
                            <a href="{{ route('taches.create') }}" class="flex items-center gap-3 p-4 bg-slate-900/50 rounded-xl border border-slate-700/50 hover:border-amber-500/50 hover:bg-slate-800 transition-colors group">
                                <div class="p-2 bg-amber-500/10 text-amber-400 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Assigner Tâche</p>
                                </div>
                            </a>
                            <a href="{{ route('produits.index') }}" class="flex items-center gap-3 p-4 bg-slate-900/50 rounded-xl border border-slate-700/50 hover:border-green-500/50 hover:bg-slate-800 transition-colors group sm:col-span-2">
                                <div class="p-2 bg-green-500/10 text-green-400 rounded-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V5M4 11v10l8 4"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Ajouter un Produit au Catalogue</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                À vérifier d'urgence
                            </h3>
                            <span class="text-xs font-bold bg-slate-700 text-slate-300 px-2 py-1 rounded">3 Notifs</span>
                        </div>

                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 p-3 bg-red-500/5 rounded-xl border border-red-500/20">
                                <div class="mt-0.5 text-red-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-200">Rupture de Stock Imminente</p>
                                    <p class="text-xs text-red-400 mt-0.5">Le produit "Câble RJ45" n'a plus que 2 unités en réserve.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 p-3 bg-slate-900/50 rounded-xl border border-slate-700/50">
                                <div class="mt-0.5 text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-slate-200">Demande de Congé</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Yassine B. a demandé 3 jours (à partir du 15/07).</p>
                                </div>
                                <a href="{{ route('conges') }}" class="text-xs text-blue-500 hover:text-blue-400 font-medium">Gérer</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </main>

        </div>
    </div>
</x-app-layout>

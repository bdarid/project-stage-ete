<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord - Administration') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">

            <aside class="w-full md:w-64 bg-white rounded-xl shadow-sm border border-gray-100 p-5 shrink-0 h-fit">
                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-wider">Menu ERP</h3>
                </div>

                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 bg-blue-50 text-blue-700 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Tableau de bord
                    </a>

                    <div class="pt-4 pb-1">
                        <p class="text-xs font-bold text-gray-400 uppercase">Ressources Humaines</p>
                    </div>
                    <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Employés
                    </a>
                    <a href="{{ route('departements.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Départements
                    </a>
                    <a href="{{ route('pointage.adminindex') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pointages
                    </a>
                    <a href="{{ route('conges') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Congés
                    </a>

                    <div class="pt-4 pb-1">
                        <p class="text-xs font-bold text-gray-400 uppercase">Projets & Objectifs</p>
                    </div>
                    <a href="{{ route('taches.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Tâches
                    </a>
                    <a href="{{ route('objectifs.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Objectifs
                    </a>

                    <div class="pt-4 pb-1">
                        <p class="text-xs font-bold text-gray-400 uppercase">Gestion Commerciale</p>
                    </div>
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Catégories
                    </a>
                    <a href="{{ route('produits.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Produits
                    </a>
                    <a href="{{ route('stocks.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                        Stocks
                    </a>
                    <a href="{{ route('achats.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Achats
                    </a>
                    <a href="{{ route('ventes.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Ventes
                    </a>
                </nav>
            </aside>

            <main class="flex-1">
                
                {{-- SECTIONS STATISTIQUES (KPIs) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-center">
                        <p class="text-sm font-medium text-gray-500 uppercase">Employés</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalEmployes ?? 0 }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-center">
                        <p class="text-sm font-medium text-gray-500 uppercase">Produits</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalProduits ?? 0 }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-center">
                        <p class="text-sm font-medium text-gray-500 uppercase">Valeur Stock</p>
                        <p class="text-2xl font-bold text-green-600 mt-1">{{ number_format($valeurStock ?? 0, 2, ',', ' ') }} DH</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-center">
                        <p class="text-sm font-medium text-gray-500 uppercase">Bénéfice</p>
                        <p class="text-2xl font-bold text-blue-600 mt-1">{{ number_format($totalbenifice ?? 0, 2, ',', ' ') }} DH</p>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Accès Rapide aux Modules</h3>
                </div>

                {{-- GRILLE DES MODULES --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                        <div>
                            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-lg w-fit mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Présences & Pointages</h4>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Consultez les heures d'arrivée et de départ de l'équipe.</p>
                        </div>
                        <a href="{{ route('pointage.index') }}" class="w-full text-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-md text-sm transition-colors">
                            Suivi des présences
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                        <div>
                            <div class="p-3 bg-blue-100 text-blue-600 rounded-lg w-fit mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Gestion des Congés</h4>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Validez ou refusez les demandes de vos collaborateurs en attente.</p>
                        </div>
                        <a href="{{ route('conges') }}" class="w-full text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md text-sm transition-colors">
                            Ouvrir les congés
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                        <div>
                            <div class="p-3 bg-green-100 text-green-600 rounded-lg w-fit mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Gestion des Ventes</h4>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Facturation, suivi des paiements et historique des ventes.</p>
                        </div>
                        <a href="{{ route('ventes.index') }}" class="w-full text-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md text-sm transition-colors">
                            Ouvrir les ventes
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                        <div>
                            <div class="p-3 bg-purple-100 text-purple-600 rounded-lg w-fit mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Utilisateurs & Employés</h4>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Créez des comptes pour vos nouveaux employés et gérez leurs accès.</p>
                        </div>
                        <a href="{{ route('users.index') }}" class="w-full text-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-md text-sm transition-colors">
                            Gérer les employés
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                        <div>
                            <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg w-fit mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Gestion des Tâches</h4>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">Assignez de nouvelles missions à l'équipe et suivez leur avancement.</p>
                        </div>
                        <a href="{{ route('taches.index') }}" class="w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md text-sm transition-colors">
                            Gérer les tâches
                        </a>
                    </div>
                    
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
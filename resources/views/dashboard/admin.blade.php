<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord - Administration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SECTIONS STATISTIQUES (KPIs) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Employés</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalEmployes }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Produits en Catalogue</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalProduits }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Valeur du Stock</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ number_format($valeurStock, 2, ',', ' ') }} DH</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <p class="text-sm font-medium text-gray-500 uppercase">Bénéfice Total</p>
                    <p class="text-2xl font-bold text-blue-600 mt-1">{{ number_format($totalbenifice, 2, ',', ' ') }} DH</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-700 mb-4">Accès Rapide aux Modules</h3>

            {{-- GRILLE DES MODULES (Passée en 4 colonnes pour accueillir les Tâches) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-lg w-fit mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Gestion des Congés</h4>
                        <p class="text-sm text-gray-600 mb-4">Validez ou refusez les demandes de vos collaborateurs en attente.</p>
                    </div>
                    <a href="{{ route('conges') }}" class="w-full text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md text-sm transition-colors">
                        Ouvrir les congés
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="p-3 bg-green-100 text-green-600 rounded-lg w-fit mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Gestion des Produits</h4>
                        <p class="text-sm text-gray-600 mb-4">Gérer le catalogue, ajoutez des stocks et modifiez les prix.</p>
                    </div>
                    <a href="{{ route('produits.index') }}" class="w-full text-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md text-sm transition-colors">
                        Ouvrir les produits
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="p-3 bg-purple-100 text-purple-600 rounded-lg w-fit mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Utilisateurs & Employés</h4>
                        <p class="text-sm text-gray-600 mb-4">Créez des comptes pour vos nouveaux employés et gérez leurs accès.</p>
                    </div>
                    <a href="{{ route('users.index') }}" class="w-full text-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-md text-sm transition-colors">
                        Gérer les employés
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg w-fit mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Gestion des Tâches</h4>
                        <p class="text-sm text-gray-600 mb-4">Assignez de nouvelles missions à l'équipe et suivez leur avancement.</p>
                    </div>
                    <a href="{{ route('taches.index') }}" class="w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md text-sm transition-colors">
                        Gérer les tâches
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

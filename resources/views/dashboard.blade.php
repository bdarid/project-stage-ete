<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espace Employé') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- COLONNE GAUCHE & MILIEU : LES TÂCHES EN COURS --}}
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Mes tâches en cours</h3>
                    
                    @if($mesTaches->isEmpty())
                        <p class="text-sm text-gray-500 bg-gray-50 p-4 rounded-md">Aucune tâche en cours pour le moment. Beau travail ! ✨</p>
                    @else
                        <div class="space-y-3">
                            @foreach($mesTaches as $tache)
                                <div class="p-4 border border-gray-200 rounded-lg flex justify-between items-center bg-gray-50">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $tache->titre }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">Échéance : {{ $tache->date_limite ?? 'Non définie' }}</p>
                                    </div>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded">
                                        {{ $tache->statut }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- COLONNE DROITE : LES ACCÈS RAPIDES DE L'EMPLOYÉ --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">Mes Outils</h3>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <h4 class="font-semibold text-gray-900 mb-1">⏰ Pointage Quotidien</h4>
                        <p class="text-xs text-gray-600 mb-4">Enregistrez vos heures d'arrivée et de départ.</p>
                        <a href="{{ route('pointage.index') }}" class="block text-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-white font-medium rounded-md text-xs uppercase tracking-wider transition-colors">
                            Accéder au Pointage
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <h4 class="font-semibold text-gray-900 mb-1">📅 Mes Congés</h4>
                        <p class="text-xs text-gray-600 mb-4">Suivez le statut de vos demandes et soumettez-en une nouvelle.</p>
                        <a href="{{ route('conges') }}" class="block text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md text-xs uppercase tracking-wider transition-colors">
                            Faire une demande
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
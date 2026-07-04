<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Espace Employé') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Accès rapide aux modules</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('produits.index') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg group transition duration-200">
                        <div class="p-3 bg-blue-500 text-white rounded-md mr-4 group-hover:scale-105 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-blue-900 text-lg">Consulter le Stock Produits</span>
                            <span class="text-sm text-blue-700">Accéder à la gestion et au catalogue des marchandises</span>
                        </div>
                    </a>

                    <a href="{{ route('conges.create') }}" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 border border-purple-200 rounded-lg group transition duration-200">
                        <div class="p-3 bg-purple-500 text-white rounded-md mr-4 group-hover:scale-105 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <span class="block font-bold text-purple-900 text-lg">Demander un Congé</span>
                            <span class="text-sm text-purple-700">Remplir et soumettre une nouvelle demande d'absence</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold">Tâches en cours</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $tachesEnCours }}</p>
                        </div>
                        <div class="text-blue-500 bg-blue-100 p-3 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold">Tâches terminées</p>
                            <p class="text-3xl font-bold text-green-600 mt-1">{{ $tachesTerminees }}</p>
                        </div>
                        <div class="text-green-500 bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-semibold">En retard</p>
                            <p class="text-3xl font-bold text-red-600 mt-1">{{ $tachesEnRetard }}</p>
                        </div>
                        <div class="text-red-500 bg-red-100 p-3 rounded-full">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Suivi opérationnel de mes tâches</h3>
                    <p class="text-sm text-gray-500">Consultez vos missions et mettez à jour votre avancement dès qu'elles sont terminées.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($mesTaches as $tache)
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 flex flex-col justify-between shadow-sm">
                            <div>
                                <div class="flex items-start justify-between mb-3">
                                    <h4 class="font-bold text-gray-900 text-lg leading-tight">{{ $tache->titre_taches }}</h4>
                                    <span class="text-xs px-2.5 py-1 rounded-full font-semibold whitespace-nowrap
                                        {{ $tache->statut === 'fini' ? 'bg-green-100 text-green-800 border border-green-200' : '' }}
                                        {{ $tache->statut === 'en cours' ? 'bg-blue-100 text-blue-800 border border-blue-200' : '' }}
                                        {{ $tache->statut === 'en retard' ? 'bg-red-100 text-red-800 border border-red-200' : '' }}">
                                        {{ ucfirst($tache->statut) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $tache->description_taches }}</p>

                                <div class="text-xs text-gray-500 space-y-1 mb-4 bg-white p-2.5 rounded border border-gray-100">
                                    <p>📅 <strong>Début :</strong> {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}</p>
                                    @if($tache->date_fin)
                                        <p>🏁 <strong>Échéance :</strong> {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                            </div>

                            <form action="{{ route('taches.updateStatut', $tache->id) }}" method="POST" class="mt-4 pt-3 border-t border-gray-200">
                                @csrf
                                @method('PATCH')
                                <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase">Mettre à jour l'état :</label>
                                <div class="flex space-x-2">
                                    <select name="statut" class="text-xs bg-white border border-gray-300 rounded-md py-1.5 px-2 flex-1 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                        <option value="en cours" {{ $tache->statut === 'en cours' ? 'selected' : '' }}>En cours</option>
                                        <option value="fini" {{ $tache->statut === 'fini' ? 'selected' : '' }}>Fini (Terminé)</option>
                                        <option value="en retard" {{ $tache->statut === 'en retard' ? 'selected' : '' }}>En retard</option>
                                    </select>
                                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold px-3 py-1.5 rounded-md shadow-sm transition duration-150">
                                        Valider
                                    </button>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="col-span-full bg-gray-50 p-8 rounded-lg text-center text-gray-500 border border-dashed border-gray-300">
                            🎉 Super ! Aucune tâche ne vous est assignée pour le moment.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

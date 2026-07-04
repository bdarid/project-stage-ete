<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Tâches Assignées') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($mesTaches as $tache)
                    <div class="bg-white rounded-lg shadow-md p-6 border-t-4
                        {{ $tache->statut === 'fini' ? 'border-green-500' : '' }}
                        {{ $tache->statut === 'en cours' ? 'border-blue-500' : '' }}
                        {{ $tache->statut === 'en retard' ? 'border-red-500' : '' }}">

                        <h3 class="font-bold text-lg mb-2">{{ $tache->titre_taches }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $tache->description_taches }}</p>

                        <div class="text-xs text-gray-500 mb-4">
                            <p><strong>Début :</strong> {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}</p>
                            @if($tache->date_fin)
                                <p><strong>Échéance :</strong> {{ \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') }}</p>
                            @endif
                        </div>

                        <form action="{{ route('taches.updateStatut', $tache->id) }}" method="POST" class="mt-4 pt-4 border-t border-gray-100">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center space-x-2">
                                <select name="statut" class="text-sm border-gray-300 rounded flex-1">
                                    <option value="en cours" {{ $tache->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="fini" {{ $tache->statut == 'fini' ? 'selected' : '' }}>Fini</option>
                                    <option value="en retard" {{ $tache->statut == 'en retard' ? 'selected' : '' }}>En retard</option>
                                </select>
                                <button type="submit" class="bg-gray-800 text-white px-3 py-2 rounded text-sm hover:bg-gray-700">
                                    MAJ
                                </button>
                            </div>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-6 rounded-lg shadow text-center text-gray-500">
                        Aucune tâche ne vous est assignée pour le moment.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Tâches (Vue Admin)') }}
            </h2>
            <a href="{{ route('taches.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Assigner une tâche
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-left border-collapse">
                        <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal border-b">
                            <th class="py-3 px-6">Titre</th>
                            <th class="py-3 px-6">Assigné à</th>
                            <th class="py-3 px-6">Début</th>
                            <th class="py-3 px-6">Fin estimée</th>
                            <th class="py-3 px-6 text-center">Statut</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @foreach($taches as $tache)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-6 font-bold">{{ $tache->titre_taches }}</td>
                                <td class="py-3 px-6">{{ $tache->employe_nom ?? 'Non assigné' }}</td>
                                <td class="py-3 px-6">{{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }}</td>
                                <td class="py-3 px-6">{{ $tache->date_fin ? \Carbon\Carbon::parse($tache->date_fin)->format('d/m/Y') : '-' }}</td>
                                <td class="py-3 px-6 text-center">
                                        <span class="py-1 px-3 rounded-full text-xs font-semibold
                                            {{ $tache->statut === 'fini' ? 'bg-green-200 text-green-700' : '' }}
                                            {{ $tache->statut === 'en cours' ? 'bg-blue-200 text-blue-700' : '' }}
                                            {{ $tache->statut === 'en retard' ? 'bg-red-200 text-red-700' : '' }}">
                                            {{ ucfirst($tache->statut) }}
                                        </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

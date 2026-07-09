<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white">
            Gestion des Départements
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 rounded-lg p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-xl overflow-hidden">

                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-xl font-bold text-black">
                        Liste des Départements
                    </h3>
                    <a href="{{ route('departements.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        + Nouveau Département
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-black" >#</th>
                                <th class="px-6 py-3 text-left text-black">Département</th>
                                <th class="px-6 py-3 text-center text-black">Employés</th>
                                <th class="px-6 py-3 text-center text-black">Objectifs</th>
                                <th class="px-6 py-3 text-center text-black">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($departements as $departement)
                            <tr class="border-b hover:bg-gray-50 text-black">
                                <td class="px-6 py-4">
                                    {{ $departement->id }}
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ $departement->nom_departement }}
                                </td>

                                <td class="px-6 py-4 text-center font-medium text-gray-700">
                                    {{$departement->users->count() }}
                                </td>

                                <td class="px-6 py-4 text-center font-medium text-gray-700">
                                    {{ $departement->objectifs->count() }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('departements.show',$departement) }}"
                                           class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                            Voir
                                        </a>
                                        <a href="{{ route('departements.edit',$departement) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                            Modifier
                                        </a>
                                        <form action="{{ route('departements.destroy',$departement) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer ce département ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500">
                                    Aucun département enregistré.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6">
                    {{ $departements->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

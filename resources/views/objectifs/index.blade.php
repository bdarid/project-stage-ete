<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white">
                Gestion des Objectifs
            </h2>

            <a href="{{ route('objectifs.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Nouvel Objectif
            </a>
        </div>
    </x-slot>

    <div class="py-8 text-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-100">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Objectif
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Employés
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-bold uppercase">
                                Département
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Début
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Fin
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Avancement
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold uppercase">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                    @forelse($objectifs as $objectif)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800">
                                    {{ $objectif->titre_objectif }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ Str::limit($objectif->description_objectif,70) }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                @forelse($objectif->users as $user)

                                    <span class="inline-block bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-xs mr-1 mb-1">
                                        {{ $user->name_users }}
                                    </span>

                                @empty

                                    <span class="text-gray-400">
                                        Aucun
                                    </span>

                                @endforelse

                            </td>

                            <td class="px-6 py-4">

                                @forelse($objectif->departement as $dep)

                                    <span class="inline-block bg-green-100 text-green-700 rounded-full px-3 py-1 text-xs mr-1 mb-1">
                                        {{ $dep->nom_departement }}
                                    </span>

                                @empty

                                    <span class="text-gray-400">
                                        Aucun
                                    </span>

                                @endforelse

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $objectif->date_debut_obj ?? '-' }}

                            </td>

                            <td class="px-6 py-4 text-center">

                                {{ $objectif->date_fin_obj ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                <div class="w-full bg-gray-200 rounded-full h-4">

                                    <div
                                        class="bg-blue-600 h-4 rounded-full"
                                        style="width: {{ $objectif->etat_avancement_objectif }}%">
                                    </div>

                                </div>

                                <div class="text-center text-xs mt-1 font-semibold">

                                    {{ $objectif->etat_avancement_objectif }} %

                                </div>

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('objectifs.show',$objectif->id) }}"
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">
                                        Voir
                                    </a>

                                    <a href="{{ route('objectifs.edit',$objectif->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">
                                        Modifier
                                    </a>

                                    <form action="{{ route('objectifs.destroy',$objectif->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Supprimer cet objectif ?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                                            Supprimer
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-10 text-gray-500">

                                Aucun objectif trouvé.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="p-5">

                    {{ $objectifs->links() }}

                </div>

            </div>

        </div>
    </div>

</x-app-layout>

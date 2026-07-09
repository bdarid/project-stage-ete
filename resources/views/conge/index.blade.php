<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Gestion des Congés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">
                        Liste des demandes de congé
                    </h3>

                    <a href="{{ route('conges.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        + Nouvelle demande
                    </a>
                </div>

                <div class="overflow-x-auto border border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Employé
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Type
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Début
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Fin
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Durée
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Solde
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Statut
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Réponse
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($conges as $conge)

                            <tr>

                                <td class="px-6 py-4 text-black">
                                    {{ $conge->user->name_users ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-black">
                                    {{ ucfirst(str_replace('_',' ',$conge->type_conge)) }}
                                </td>

                                <td class="px-6 py-4 text-black">
                                    {{ $conge->date_debut }}
                                </td>

                                <td class="px-6 py-4 text-black">
                                    {{ $conge->date_fin }}
                                </td>

                                <td class="px-6 py-4 text-black">
                                    {{ $conge->duree }} jour(s)
                                </td>

                                <td class="px-6 py-4 text-black">
                                    {{ $conge->solde }} jour(s)
                                </td>

                                <td class="px-6 py-4 text-black">

                                    @if($conge->statut=="en attente")
                                        <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700">
                                            En attente
                                        </span>

                                    @elseif($conge->statut=="en cours")

                                        <span class="px-2 py-1 rounded bg-green-100 text-green-700">
                                            En cours
                                        </span>

                                    @else

                                        <span class="px-2 py-1 rounded bg-red-100 text-red-700">
                                            Hors congé
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4 text-black">

                                    @if($conge->reponse)

                                        {{ ucfirst($conge->reponse) }}

                                    @else

                                        -

                                    @endif

                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">

                                    <a href="{{ route('conges.edit',$conge->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        Modifier
                                    </a>

                                    <form action="{{ route('conges.destroy',$conge->id) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Supprimer cette demande ?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:text-red-900">
                                            Supprimer
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                    Aucune demande de congé.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

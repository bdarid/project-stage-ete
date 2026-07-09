<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white">
                Détails de l'Objectif
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('objectifs.edit', $objectif->id) }}"
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                    Modifier
                </a>

                <a href="{{ route('objectifs.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 text-black">
        <div class="max-w-6xl mx-auto">

            <div class="bg-white shadow rounded-xl p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="md:col-span-2">
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ $objectif->titre_objectif }}
                        </h3>
                    </div>

                    <div class="md:col-span-2">
                        <label class="font-semibold text-gray-600">
                            Description
                        </label>

                        <div class="mt-2 p-4 bg-gray-50 rounded-lg border">
                            {{ $objectif->description_objectif }}
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Date de début
                        </label>

                        <div class="mt-2">
                            {{ $objectif->date_debut_obj ?? 'Non définie' }}
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Date de fin
                        </label>

                        <div class="mt-2">
                            {{ $objectif->date_fin_obj ?? 'Non définie' }}
                        </div>
                    </div>

                    <div class="md:col-span-2">

                        <label class="font-semibold text-gray-600">
                            Progression
                        </label>

                        <div class="mt-3">

                            <div class="w-full bg-gray-200 rounded-full h-6">

                                <div
                                    class="bg-blue-600 h-6 rounded-full text-white text-center text-sm leading-6"
                                    style="width: {{ $objectif->etat_avancement_objectif }}%;">

                                    {{ $objectif->etat_avancement_objectif }}%

                                </div>

                            </div>

                        </div>

                    </div>

                    <div>

                        <label class="font-semibold text-gray-600">
                            Employés assignés
                        </label>

                        <div class="mt-3">

                            @forelse($objectif->users as $user)

                                <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm mr-2 mb-2">

                                    {{ $user->name_users }}

                                </span>

                            @empty

                                <span class="text-gray-400">
                                    Aucun employé affecté.
                                </span>

                            @endforelse

                        </div>

                    </div>

                    <div>

                        <label class="font-semibold text-gray-600">
                            Départements concernés
                        </label>

                        <div class="mt-3">

                            @forelse($objectif->departement as $departement)

                                <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm mr-2 mb-2">

                                    {{ $departement->nom_departement }}

                                </span>

                            @empty

                                <span class="text-gray-400">
                                    Aucun département.
                                </span>

                            @endforelse

                        </div>

                    </div>

                    @if(!empty($objectif->file_json))

                        <div class="md:col-span-2">

                            <label class="font-semibold text-gray-600">
                                Données JSON
                            </label>

                            <pre class="mt-3 bg-gray-900 text-green-400 rounded-lg p-5 overflow-x-auto text-sm">{{ json_encode($objectif->file_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Créer un Objectif
            </h2>

            <a href="{{ route('objectifs.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto">

            @if ($errors->any())
                <div class="mb-5 bg-red-100 border border-red-300 text-red-700 rounded-lg p-4">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow rounded-xl p-8">

                <form action="{{ route('objectifs.store') }}" method="POST">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label class="font-semibold">
                                Titre de l'objectif
                            </label>

                            <input
                                type="text"
                                name="titre_objectif"
                                value="{{ old('titre_objectif') }}"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="font-semibold">
                                Description
                            </label>

                            <textarea
                                name="description_objectif"
                                rows="5"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                required>{{ old('description_objectif') }}</textarea>
                        </div>

                        <div>
                            <label class="font-semibold">
                                Date de début
                            </label>

                            <input
                                type="date"
                                name="date_debut_obj"
                                value="{{ old('date_debut_obj') }}"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="font-semibold">
                                Date de fin
                            </label>

                            <input
                                type="date"
                                name="date_fin_obj"
                                value="{{ old('date_fin_obj') }}"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="font-semibold">
                                Avancement (%)
                            </label>

                            <input
                                type="number"
                                name="etat_avancement_objectif"
                                min="0"
                                max="100"
                                value="{{ old('etat_avancement_objectif',0) }}"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="font-semibold">
                                Employés concernés
                            </label>

                            <select
                                name="users[]"
                                multiple
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm h-48">

                                @foreach($users as $user)

                                    <option value="{{ $user->id }}">
                                        {{ $user->name_users }}
                                    </option>

                                @endforeach

                            </select>

                            <p class="text-gray-500 text-sm mt-1">
                                Maintenez CTRL (Windows) ou CMD (Mac) pour sélectionner plusieurs employés.
                            </p>
                        </div>

                        <div>
                            <label class="font-semibold">
                                Départements concernés
                            </label>

                            <select
                                name="departements[]"
                                multiple
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm h-48">

                                @foreach($departements as $departement)

                                    <option value="{{ $departement->id }}">
                                        {{ $departement->nom_departement }}
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="font-semibold">
                                Fichier JSON (optionnel)
                            </label>

                            <textarea
                                name="file_json"
                                rows="6"
                                class="w-full mt-2 rounded-lg border-gray-300 shadow-sm"
                                placeholder='{"cle":"valeur"}'>{{ old('file_json') }}</textarea>

                            <p class="text-gray-500 text-sm mt-1">
                                Facultatif. Tu peux laisser ce champ vide.
                            </p>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3">

                        <a href="{{ route('objectifs.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                            Annuler
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                            Créer l'objectif
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
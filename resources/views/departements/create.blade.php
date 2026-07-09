<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white">
            Nouveau Département
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 rounded-lg p-4 mb-6">
                    <ul class="list-disc ml-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-xl p-8">

                <form action="{{ route('departements.store') }}" method="POST">
                    @csrf

                    {{-- Nom du département --}}
                    <div class="mb-6">
                        <label class="font-semibold text-gray-700">
                            Nom du département
                        </label>
                        <input
                            type="text"
                            name="nom_departement"
                            value="{{ old('nom_departement') }}"
                            class="w-full border border-gray-300 rounded-lg mt-2 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-black"
                            required>
                    </div>

                    {{-- Employés (Checkboxes) --}}
                    <div class="mb-6">
                        <label class="font-semibold text-gray-700">
                            Employés
                        </label>

                        <div class="border border-gray-200 rounded-lg p-4 mt-2 max-h-48 overflow-y-auto bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($users as $user)
                                    <label class="flex items-center gap-3 bg-white p-2.5 rounded-md border border-gray-100 hover:border-gray-300 cursor-pointer transition-colors shadow-sm">
                                        <input
                                            type="checkbox"
                                            name="users[]"
                                            value="{{ $user->id }}"
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            {{ is_array(old('users')) && in_array($user->id, old('users')) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700 font-medium">
                                            {{ $user->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Objectifs (Checkboxes) --}}
                    <div class="mb-6">
                        <label class="font-semibold text-gray-700">
                            Objectifs du département
                        </label>

                        <div class="border border-gray-200 rounded-lg p-4 mt-2 max-h-48 overflow-y-auto bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($objectifs as $objectif)
                                    <label class="flex items-center gap-3 bg-white p-2.5 rounded-md border border-gray-100 hover:border-gray-300 cursor-pointer transition-colors shadow-sm">
                                        <input
                                            type="checkbox"
                                            name="objectifs[]"
                                            value="{{ $objectif->id }}"
                                            class="rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                                            {{ is_array(old('objectifs')) && in_array($objectif->id, old('objectifs')) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700 font-medium">
                                            {{ $objectif->titre_objectif }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex justify-end gap-4 mt-8">
                        <a href="{{ route('departements.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            Annuler
                        </a>
                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            Enregistrer
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assigner une nouvelle tâche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('taches.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Assigner à (Employé) *</label>
                            <select name="user_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Choisir un employé --</option>
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->id }}">{{ $employe->name }} ({{ $employe->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Titre de la tâche *</label>
                            <input type="text" name="titre_taches" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Description de la mission *</label>
                            <textarea name="description_taches" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Date de début *</label>
                                <input type="date" name="date_debut" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Date de fin estimée</label>
                                <input type="date" name="date_fin" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('taches.index') }}" class="text-gray-500 hover:text-gray-700 px-4 py-2 mr-2">Annuler</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Enregistrer la tâche
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

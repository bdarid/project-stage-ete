<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Modifier l\'employé') }} : {{ $user->name_users ?? $user->name }}
        </h2>
    </x-slot>

    <div class="py-12 text-black">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Affichage des erreurs de validation s'il y en a --}}
                @if ($errors->any())
                    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Action qui pointe vers update et la méthode PUT requise par Laravel --}}
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name_users" class="block text-sm font-medium text-gray-700">Nom complet</label>
                        <input type="text" name="name_users" id="name_users" value="{{ old('name_users', $user->name_users ?? $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    {{-- Sélection du Rôle Spatie --}}
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Rôle de l'utilisateur</label>
                        <select name="role" id="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="CIN" class="block text-sm font-medium text-gray-700">Numéro de CIN</label>
                            <input type="text" name="CIN" id="CIN" value="{{ old('CIN', $user->CIN) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                            {{-- Gestion sécurisée du format de date pour éviter l'erreur sur le champ input de type date --}}
                            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $user->date_naissance ? (is_string($user->date_naissance) ? date('Y-m-d', strtotime($user->date_naissance)) : $user->date_naissance->format('Y-m-d')) : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-100 pt-4">
                        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-150">Annuler</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150 shadow-sm">Mettre à jour</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

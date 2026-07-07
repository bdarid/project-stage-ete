<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Gestion des Catégories
            </h2>
            <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium shadow-sm transition-colors">
                + Nouvelle Catégorie
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nom de la Catégorie</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Catégorie Parente</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $categorie)
                            <tr class="hover:bg-blue-50 transition duration-150">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $categorie->nom_categorie }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($categorie->parent)
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $categorie->parent->nom_categorie }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm italic">Catégorie Principale</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600 truncate max-w-xs">
                                    {{ $categorie->description_categorie ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('categories.show', $categorie->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm transition-colors">
                                            Voir
                                        </a>
                                        <a href="{{ route('categories.edit', $categorie->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm transition-colors">
                                            Éditer
                                        </a>
                                        <form method="POST" action="{{ route('categories.destroy', $categorie->id) }}" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-sm transition-colors">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12 text-gray-500 bg-gray-50">
                                    Aucune catégorie enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-5 border-t border-gray-100 bg-gray-50">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
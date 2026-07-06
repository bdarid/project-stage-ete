<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Détails de l'Achat
            </h2>

            <a href="{{ route('achats.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow-xl rounded-xl overflow-hidden">

                <div class="bg-blue-600 text-white px-6 py-4">
                    <h3 class="text-xl font-bold">
                        Achat #{{ $achat->id }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-8">

                    <div>
                        <label class="font-semibold text-gray-600">
                            Produit
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $achat->produit->nom_produit ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Catégorie
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $achat->categorie->nom_categorie ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Fournisseur
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $achat->nom_fournisseur }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Utilisateur
                        </label>

                        <p class="mt-1 text-lg">
                            {{ $achat->users->name_users ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Prix d'achat
                        </label>

                        <p class="mt-1 text-lg text-red-600 font-bold">
                            {{ number_format($achat->prix_achat,2) }} DH
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Prix de vente
                        </label>

                        <p class="mt-1 text-lg text-green-600 font-bold">
                            {{ number_format($achat->prix_vente,2) }} DH
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Bénéfice unitaire
                        </label>

                        <p class="mt-1 text-lg text-blue-600 font-bold">
                            {{ number_format($achat->prix_vente - $achat->prix_achat,2) }} DH
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Quantité achetée
                        </label>

                        <p class="mt-1">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-semibold">
                                {{ $achat->quantite }}
                            </span>
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Valeur totale d'achat
                        </label>

                        <p class="mt-1 text-xl font-bold text-red-500">
                            {{ number_format($achat->prix_achat * $achat->quantite,2) }} DH
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Valeur totale de vente
                        </label>

                        <p class="mt-1 text-xl font-bold text-green-500">
                            {{ number_format($achat->prix_vente * $achat->quantite,2) }} DH
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Bénéfice potentiel
                        </label>

                        <p class="mt-1 text-xl font-bold text-blue-600">
                            {{ number_format(($achat->prix_vente - $achat->prix_achat) * $achat->quantite,2) }} DH
                        </p>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">
                            Date d'achat
                        </label>

                        <p class="mt-1">
                            {{ \Carbon\Carbon::parse($achat->date_achat)->format('d/m/Y') }}
                        </p>
                    </div>

                </div>

                <div class="border-t px-8 py-6">

                    <label class="font-semibold text-gray-600">
                        Commentaire
                    </label>

                    <div class="mt-2 bg-gray-100 rounded-lg p-4 min-h-[120px]">
                        {{ $achat->commentaire ?: 'Aucun commentaire.' }}
                    </div>

                </div>

                <div class="border-t px-8 py-6 flex justify-end gap-4">

                    <a href="{{ route('achats.edit',$achat->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg">
                        Modifier
                    </a>

                    <form action="{{ route('achats.destroy',$achat->id) }}"
                          method="POST"
                          onsubmit="return confirm('Supprimer cet achat ?')">

                        @csrf
                        @method('DELETE')

                        <button
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg">
                            Supprimer
                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
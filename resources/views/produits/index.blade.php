<x-app-layout>

    <x-slot name="header">

        <x-erp.page-header
            title="Gestion des Produits"
            subtitle="Consultez et gérez le catalogue des produits."
        >

            

        </x-erp.page-header>

    </x-slot>
    <a href="{{ route('produits.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                + Nouveau Produit

            </a>

    <div class="space-y-6">

        <x-erp.alert />

        <x-erp.card
            title="Catalogue Produits"
            subtitle="Tous les produits enregistrés."
            :count="$produits->total()"
            label="Produits"
        >

            <div class="overflow-x-auto">
                <div class="bg-slate-800 border border-slate-700 rounded-2xl p-4 mb-6">

    <form method="GET" action="{{ route('produits.index') }}"
          class="grid grid-cols-1 md:grid-cols-5 gap-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Nom ou référence..."
            class="rounded-xl bg-slate-900 border border-slate-700 text-white px-4 py-2">

        <select
            name="categorie"
            class="rounded-xl bg-slate-900 border border-slate-700 text-white px-4 py-2">

            <option value="">Toutes les catégories</option>

            @foreach($categories as $categorie)

                <option value="{{ $categorie->id }}"
                    {{ request('categorie') == $categorie->id ? 'selected' : '' }}>

                    {{ $categorie->nom_categorie }}

                </option>

            @endforeach

        </select>

        <select
            name="createur"
            class="rounded-xl bg-slate-900 border border-slate-700 text-white px-4 py-2">

            <option value="">Tous les créateurs</option>

            @foreach($users as $user)

                <option value="{{ $user->id }}"
                    {{ request('createur') == $user->id ? 'selected' : '' }}>

                    {{ $user->name_users }}

                </option>

            @endforeach

        </select>

        <select
            name="statut"
            class="rounded-xl bg-slate-900 border border-slate-700 text-white px-4 py-2">

            <option value="">Tous les statuts</option>
            <option value="stock" {{ request('statut')=='stock'?'selected':'' }}>
                En stock
            </option>

            <option value="faible" {{ request('statut')=='faible'?'selected':'' }}>
                Stock faible
            </option>

            <option value="rupture" {{ request('statut')=='rupture'?'selected':'' }}>
                Rupture
            </option>

        </select>

        <div class="flex gap-2">

            <button
                class="flex-1 bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-semibold">

                Rechercher

            </button>

            <a href="{{ route('produits.index') }}"
               class="px-4 bg-slate-700 hover:bg-slate-600 rounded-xl text-white flex items-center">

                Réinitialiser

            </a>

        </div>

    </form>

</div>

                <table class="min-w-full">

                    <thead class="bg-slate-900/40 border-b border-slate-700">

                        <tr class="text-slate-400 uppercase text-xs tracking-wider">

                            <th class="px-6 py-4 text-left">Produit</th>
                            <th class="px-6 py-4 text-left">Créé par</th>

                            <th class="px-6 py-4 text-center">Prix Vente</th>

                            <th class="px-6 py-4 text-center">Prix Achat</th>

                            <th class="px-6 py-4 text-center">Stock</th>

                            <th class="px-6 py-4 text-center">Expiration</th>

                            <th class="px-6 py-4 text-center">Statut</th>

                            <th class="px-6 py-4 text-right">Actions</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-700">

                        @forelse($produits as $produit)

                            <tr class="hover:bg-slate-700/30 transition">

                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-4">

                                        <div class="w-11 h-11 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 font-bold">

                                            {{ strtoupper(substr($produit->nom_produit,0,1)) }}

                                        </div>

                                        <div>

                                            <p class="font-semibold text-white">

                                                {{ $produit->nom_produit }}

                                            </p>

                                            <p class="text-xs text-slate-500">

                                                Réf : {{ $produit->reference }}

                                            </p>

                                        </div>

                                    </div>

                                </td>
                                <td class="px-6 py-5">

    <div class="flex items-center gap-3">

        <div class="w-10 h-10 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400 font-bold">

            {{ strtoupper(substr($produit->user->name_users ?? '-', 0, 1)) }}

        </div>

        <div>

            <p class="font-semibold text-white">
                {{ $produit->user->name_users ?? 'Inconnu' }}
            </p>

            <p class="text-xs text-slate-500">
                Créateur
            </p>

        </div>

    </div>

</td>

                                <td class="px-6 py-5 text-center text-white">

                                    {{ number_format($produit->prix_vente_moy,2) }} DH

                                </td>

                                <td class="px-6 py-5 text-center text-white">

                                    {{ number_format($produit->prix_achat_moy,2) }} DH

                                </td>

                                <td class="px-6 py-5 text-center">

                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 font-semibold">

                                        {{ $produit->quantite_produit }}

                                    </span>

                                </td>

                                <td class="px-6 py-5 text-center text-slate-300">

                                    {{ $produit->date_expiration }}

                                </td>

                                <td class="px-6 py-5 text-center">

                                    @if($produit->quantite_produit == 0)

                                        <span class="inline-flex px-3 py-1 rounded-full bg-red-500/10 text-red-400 font-semibold">

                                            Rupture

                                        </span>

                                    @elseif($produit->quantite_produit <= 5)

                                        <span class="inline-flex px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 font-semibold">

                                            Stock faible

                                        </span>

                                    @else

                                        <span class="inline-flex px-3 py-1 rounded-full bg-green-500/10 text-green-400 font-semibold">

                                            En stock

                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('produits.edit',$produit->id) }}"
                                           class="px-3 py-2 rounded-lg bg-yellow-600 hover:bg-yellow-700 text-white text-sm">

                                            Modifier

                                        </a>

                                        <form
                                            action="{{ route('produits.destroy',$produit->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Supprimer ce produit ?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm">

                                                Supprimer

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="py-14 text-center text-slate-500">

                                    <svg class="mx-auto w-12 h-12 mb-3 opacity-50"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>

                                    </svg>

                                    Aucun produit enregistré.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
            @if(method_exists($produits, 'links'))

    <div class="px-6 py-5 border-t border-slate-700 flex justify-between items-center">

        <p class="text-sm text-slate-400">

            Affichage de

            <span class="font-semibold text-white">
                {{ $produits->firstItem() }}
            </span>

            à

            <span class="font-semibold text-white">
                {{ $produits->lastItem() }}
            </span>

            sur

            <span class="font-semibold text-white">
                {{ $produits->total() }}
            </span>

            produits

        </p>

        {{ $produits->links() }}

    </div>

@endif

        </x-erp.card>

    </div>

</x-app-layout>
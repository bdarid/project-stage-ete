<x-app-layout>
    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-2xl font-bold text-white mb-8">Tableau de bord Administrateur</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 bg-slate-800 border border-slate-700 rounded-2xl">
                    <p class="text-slate-400 text-sm">Employés</p>
                    <p class="text-3xl font-bold text-white">{{ $totalEmployes }}</p>
                </div>
                <div class="p-6 bg-slate-800 border border-slate-700 rounded-2xl">
                    <p class="text-slate-400 text-sm">Produits</p>
                    <p class="text-3xl font-bold text-white">{{ $totalProduits }}</p>
                </div>
                <div class="p-6 bg-slate-800 border border-slate-700 rounded-2xl">
                    <p class="text-slate-400 text-sm">Valeur Stock</p>
                    <p class="text-3xl font-bold text-white">{{ number_format($valeurStock, 2) }} €</p>
                </div>
                <div class="p-6 bg-slate-800 border border-slate-700 rounded-2xl">
                    <p class="text-slate-400 text-sm">Bénéfice Total</p>
                    <p class="text-3xl font-bold text-green-400">{{ number_format($totalbenifice, 2) }} €</p>
                </div>
                <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
    <h2 class="text-lg font-bold text-white mb-2">
        Mon Profil
    </h2>

    <p class="text-slate-400 text-sm mb-5">
        Modifiez vos informations personnelles et votre mot de passe.
    </p>

    <a href="{{ route('profile.edit') }}"
       class="inline-flex items-center px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
        Accéder au profil
    </a>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
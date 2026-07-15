<section>

    <header class="mb-6">
        <h2 class="text-xl font-bold text-white">
            Informations du compte
        </h2>

        <p class="mt-2 text-sm text-slate-400">
            Consultez les informations de votre compte ERP.
        </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <p class="text-sm text-slate-400">Nom</p>
            <p class="mt-1 text-white font-semibold">
                {{ $user->name }}
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-400">Adresse e-mail</p>
            <p class="mt-1 text-white font-semibold">
                {{ $user->email }}
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-400">Rôle</p>
            <p class="mt-1">
                @foreach($user->roles as $role)
                    <span class="inline-flex px-3 py-1 rounded-lg bg-blue-600/20 text-blue-400 text-sm">
                        {{ $role->name }}
                    </span>
                @endforeach
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-400">Compte créé le</p>
            <p class="mt-1 text-white font-semibold">
                {{ $user->created_at->format('d/m/Y') }}
            </p>
        </div>

    </div>

</section>
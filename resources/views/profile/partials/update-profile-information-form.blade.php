<section>

    <header class="mb-6">
        <h2 class="text-xl font-bold text-white">
            Informations du profil
        </h2>

        <p class="mt-2 text-sm text-slate-400">
            Modifiez votre nom et votre adresse e-mail.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"
          action="{{ route('profile.update') }}"
          class="space-y-6">

        @csrf
        @method('patch')

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">
                Nom
            </label>

            <input
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-500/20">

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">
                Adresse e-mail
            </label>

            <input
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-500/20">

            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">

            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                Enregistrer

            </button>

            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-green-400 text-sm">

                    Profil mis à jour.

                </p>

            @endif

        </div>

    </form>

</section>
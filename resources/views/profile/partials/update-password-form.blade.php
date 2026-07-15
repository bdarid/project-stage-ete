<section>

    <header class="mb-6">
        <h2 class="text-xl font-bold text-white">
            Modifier le mot de passe
        </h2>

        <p class="mt-2 text-sm text-slate-400">
            Choisissez un mot de passe sécurisé pour protéger votre compte.
        </p>
    </header>

    <form method="post"
          action="{{ route('password.update') }}"
          class="space-y-6">

        @csrf
        @method('put')

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">
                Mot de passe actuel
            </label>

            <input
                type="password"
                name="current_password"
                autocomplete="current-password"
                class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-500/20">

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">
                Nouveau mot de passe
            </label>

            <input
                type="password"
                name="password"
                autocomplete="new-password"
                class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-500/20">

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">
                Confirmation du mot de passe
            </label>

            <input
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
                class="w-full rounded-xl border border-slate-700 bg-slate-900 text-white px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-500/20">
        </div>

        <div class="flex items-center gap-4">

            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

                Mettre à jour

            </button>

            @if (session('status') === 'password-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-green-400 text-sm">

                    Mot de passe mis à jour.

                </p>

            @endif

        </div>

    </form>

</section>
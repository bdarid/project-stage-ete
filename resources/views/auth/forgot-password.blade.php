<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Mot de passe oublié - ERP') }}</title>

    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-slate-900 text-slate-100 antialiased font-sans">

<div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute inset-0 hidden md:flex opacity-10 pointer-events-none select-none">
        <div class="w-64 bg-slate-800 border-r border-slate-700 h-full p-4 space-y-4">
            <div class="h-8 bg-slate-700 rounded w-3/4"></div>
            <div class="space-y-2 pt-8">
                <div class="h-6 bg-slate-700 rounded"></div>
                <div class="h-6 bg-slate-700 rounded w-5/6"></div>
                <div class="h-6 bg-slate-700 rounded w-4/5"></div>
            </div>
        </div>
        <div class="flex-1 p-8 grid grid-cols-3 gap-6">
            <div class="h-32 bg-slate-800 border border-slate-700 rounded-xl"></div>
            <div class="h-32 bg-slate-800 border border-slate-700 rounded-xl"></div>
            <div class="h-32 bg-slate-800 border border-slate-700 rounded-xl"></div>
            <div class="col-span-3 h-64 bg-slate-800 border border-slate-700 rounded-xl"></div>
        </div>
    </div>

    <div class="absolute inset-0 backdrop-blur-sm bg-slate-900/50 pointer-events-none"></div>

    <div class="relative w-full max-w-md bg-slate-800/90 backdrop-blur-md shadow-2xl rounded-2xl border border-slate-700 overflow-hidden z-10 transition-all">

        <div class="px-8 pt-8 pb-4 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-blue-950/60 text-blue-400 mb-4 shadow-sm border border-blue-900/50">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Mot de passe oublié ?</h2>
            <p class="text-sm text-slate-400 mt-2 leading-relaxed">
                {{ __('Entrez votre adresse e-mail. Un nouveau mot de passe automatique vous sera immédiatement attribué et envoyé par e-mail.') }}
            </p>
        </div>

        @if (session('status'))
            <div class="mx-8 mb-4 text-sm font-medium p-3 rounded-xl bg-green-950/40 text-green-400 border border-green-900/50 shadow-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="px-8 pb-8 space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">
                    {{ __('Adresse Email Professionnelle') }}
                </label>
                <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path>
                            </svg>
                        </span>
                    <input id="email" class="block w-full pl-10 pr-4 py-3 bg-slate-900/60 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm"
                           type="email" name="email" :value="old('email')" required autofocus placeholder="votre.nom@ensam.com" />
                </div>
                @if ($errors->has('email'))
                    <p class="mt-2 text-xs text-red-400 font-medium">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-200 cursor-pointer">
                    <span>{{ __('Générer mon mot de passe') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </div>

            <div class="text-center pt-2 border-t border-slate-700/60 mt-4">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-blue-400 hover:text-blue-300 transition-colors py-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>{{ __('Retour à la page de connexion') }}</span>
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

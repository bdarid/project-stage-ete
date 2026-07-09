<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-width=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Connexion - Solution ERP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-slate-900 overflow-hidden">

<div class="fixed inset-0 z-0 flex pointer-events-none select-none opacity-40">
    <div class="w-64 bg-slate-800 hidden md:flex flex-col border-r border-slate-700">
        <div class="h-16 flex items-center px-6 border-b border-slate-700">
            <div class="w-8 h-8 bg-blue-500 rounded-md"></div>
            <div class="ml-3 h-4 w-24 bg-slate-600 rounded"></div>
        </div>
        <div class="p-4 space-y-6 mt-4">
            <div class="h-6 w-3/4 bg-slate-700 rounded"></div>
            <div class="h-6 w-1/2 bg-slate-700 rounded"></div>
            <div class="h-6 w-2/3 bg-slate-700 rounded"></div>
            <div class="h-6 w-3/4 bg-slate-700 rounded"></div>
        </div>
    </div>
    <div class="flex-1 p-8 hidden sm:block">
        <div class="h-8 w-48 bg-slate-800 rounded mb-8"></div>
        <div class="grid grid-cols-3 gap-6 mb-6">
            <div class="h-32 bg-slate-800 rounded-xl border border-slate-700"></div>
            <div class="h-32 bg-slate-800 rounded-xl border border-slate-700"></div>
            <div class="h-32 bg-slate-800 rounded-xl border border-slate-700"></div>
        </div>
        <div class="h-64 bg-slate-800 rounded-xl border border-slate-700 w-2/3"></div>
    </div>
</div>

<div class="relative z-10 flex items-center justify-center min-h-screen p-4 backdrop-blur-sm bg-slate-900/40">
    <div class="bg-white rounded-2xl shadow-2xl p-8 sm:p-10 w-full max-w-md">

        <div class="flex flex-col items-center mb-8">
            <div class="w-14 h-14 bg-[#1e293b] rounded-xl flex items-center justify-center mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 text-center">Solution ERP Intégrée</h2>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5 relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3"
                       placeholder="Adresse E-Mail">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <div class="mb-6 relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3"
                       placeholder="Mot de passe">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 text-blue-600">
                    </div>
                    <label for="remember_me" class="ml-2 text-sm font-medium text-gray-600">Se souvenir de moi</label>
                </div>
            </div>

            <button type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-3.5 text-center transition duration-200 shadow-md">
                CONNEXION
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mt-6">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline font-medium">
                        Mot de passe oublié ?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

</body>
</html>

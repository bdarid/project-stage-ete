<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mon ERP') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-100 bg-slate-900">

<div class="min-h-screen bg-slate-900">

    @include('layouts.navigation')

    @if (isset($header))
        <header class="bg-slate-800 border-b border-slate-700 shadow-sm relative z-40">
            <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <div class="max-w-8xl mx-auto py-8 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
        
       @if(Auth::user()->hasRole('Admin'))
    @include('layouts.side')
    @elseif(Auth::user()->hasRole('Employe'))
    @include('layouts.sideemp')
    @endif

        <main class="flex-1 w-full min-w-0">
            {{ $slot }}
        </main>
        
    </div>
</div>
</body>
</html>
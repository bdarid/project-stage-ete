@props([
    'type' => 'success'
])

@php

$config = [

    'success' => [
        'session' => 'success',
        'class' => 'bg-green-500/10 border-green-500/20 text-green-400',
    ],

    'error' => [
        'session' => 'error',
        'class' => 'bg-red-500/10 border-red-500/20 text-red-400',
    ],

    'warning' => [
        'session' => 'warning',
        'class' => 'bg-yellow-500/10 border-yellow-500/20 text-yellow-400',
    ],

];

@endphp

@if(session($config[$type]['session']))

<div class="rounded-2xl border p-4 {{ $config[$type]['class'] }}">

    {{ session($config[$type]['session']) }}

</div>

@endif
@props([
    'color' => 'slate'
])

@php

$colors = [

'red' => 'bg-red-500/10 text-red-400',

'green' => 'bg-green-500/10 text-green-400',

'blue' => 'bg-blue-500/10 text-blue-400',

'yellow' => 'bg-yellow-500/10 text-yellow-400',

'slate' => 'bg-slate-700 text-slate-300',

];

@endphp

<span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$color] }}">
    {{ $slot }}
</span>
@props([
'title',
'value',
'color'=>'blue'
])

@php

$colors=[

'blue'=>'text-blue-400 bg-blue-500/10',

'green'=>'text-green-400 bg-green-500/10',

'red'=>'text-red-400 bg-red-500/10',

'yellow'=>'text-yellow-400 bg-yellow-500/10'

];

@endphp

<div class="bg-slate-800 rounded-2xl border border-slate-700 p-6">

<div class="text-slate-400 text-sm">

{{ $title }}

</div>

<div class="mt-4 text-3xl font-bold {{ $colors[$color] }} inline-block px-4 py-2 rounded-xl">

{{ $value }}

</div>

</div>
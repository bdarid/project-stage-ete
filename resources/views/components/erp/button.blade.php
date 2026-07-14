@props([
    'color'=>'blue',
    'href'=>null,
    'type'=>'button'
])

@php

$colors=[

'blue'=>'bg-blue-600 hover:bg-blue-700 text-white',

'red'=>'bg-red-600 hover:bg-red-700 text-white',

'green'=>'bg-green-600 hover:bg-green-700 text-white',

'gray'=>'bg-slate-700 hover:bg-slate-600 text-slate-200',

];

@endphp

@if($href)

<a
href="{{ $href }}"
{{ $attributes->merge([
'class'=>"inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold transition ".$colors[$color]
]) }}>

{{ $slot }}

</a>

@else

<button
type="{{ $type }}"
{{ $attributes->merge([
'class'=>"inline-flex items-center gap-2 px-5 py-3 rounded-xl font-semibold transition ".$colors[$color]
]) }}>

{{ $slot }}

</button>

@endif
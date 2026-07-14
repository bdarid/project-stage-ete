@props([
'title',
'description'=>null
])

<div>

<h2 class="text-2xl font-bold text-white">

{{ $title }}

</h2>

@if($description)

<p class="text-slate-400 mt-1">

{{ $description }}

</p>

@endif

</div>
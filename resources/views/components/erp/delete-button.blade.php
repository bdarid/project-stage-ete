@props([
'action'
])

<form

action="{{ $action }}"

method="POST"

onsubmit="return confirm('Supprimer cet élément ?')">

@csrf

@method('DELETE')

<button

class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm transition">

Supprimer

</button>

</form>
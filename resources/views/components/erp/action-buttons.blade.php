@props([
    'edit',
    'delete'
])

<div class="flex justify-end gap-2">

    <a href="{{ $edit }}"
       class="px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition">
        Modifier
    </a>

    <form action="{{ $delete }}"
          method="POST"
          onsubmit="return confirm('Êtes-vous sûr ?')">

        @csrf
        @method('DELETE')

        <button
            class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition">

            Supprimer

        </button>

    </form>

</div>
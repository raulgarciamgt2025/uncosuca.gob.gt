@props(['id', 'modal_edit', 'modal_delete'])
<button
    class="btn btn-sm btn-primary"
    wire:click="$emit('openModal', '{{ $modal_edit }}', {{ json_encode(['id' => $id ])  }})"
    title="Editar">
    <i class="fa-solid fa-pen-to-square"></i>
</button>
<button
    class="btn btn-sm btn-danger"
    wire:click="$emit('openModal', '{{ $modal_delete }}', {{ json_encode(['id' => $id ])  }})"
    title="Editar">
    <i class="fa-solid fa-trash"></i>
</button>

@props(['company_id'])

<button
    class="btn btn-sm btn-primary"
    wire:click="$emit('openModal', 'companies.edit-modal', {{ json_encode(['company' => $company_id ])  }})"
    title="Editar">
    <i class="fa-solid fa-pen-to-square"></i>
</button>
<button
    class="btn btn-sm btn-success"
    wire:click="$emit('openModal', 'companies.modal-add-document', {{ json_encode(['company' => $company_id ])  }})"
    title="Agregar documento">
    <i class="fa-solid bi-folder-plus"></i>
</button>

@props(['company_id'])

<button
    style="background-color: #b9baf6"
    class="btn btn-sm"
    title="Historial de trámites"
    wire:click="$emit('openModal', 'companies.history-modal', {{ json_encode(['company' => $company_id ]) }})">
    <i class="fa-solid fa-clock-rotate-left"></i>
</button>
<button
    class="btn btn-sm btn-secondary"
    title="Documentos adicionales"
    wire:click="$emit('openModal', 'companies.documents-modal', {{ json_encode(['company' => $company_id ]) }})">
    <i class="fa-solid fa-file-pdf"></i>
</button>

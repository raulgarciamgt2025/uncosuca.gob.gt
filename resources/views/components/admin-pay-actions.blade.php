@props(['pay_id', 'status', 'row'])

<div class="btn-group" role="group">
    <!-- View Details Button -->
    <button
        class="btn btn-sm btn-info"
        wire:click="$emit('openModal', 'pays.admin.view-pay-modal', {{ json_encode(['pay' => $pay_id ])  }})"
        title="Ver detalles">
        <i class="fa-solid fa-eye"></i>
    </button>

    <!-- Approve Button (only show if not already approved) -->
    @if($status != 2)
        <button
            class="btn btn-sm btn-success"
            onclick="if(confirm('¿Está seguro de aprobar este pago?')) { @this.call('changePayStatus', {{ $pay_id }}, 2) }"
            title="Aprobar">
            <i class="fa-solid fa-check"></i>
        </button>
    @endif

    <!-- Reject Button (only show if not already rejected) -->
    @if($status != 3)
        <button
            class="btn btn-sm btn-danger"
            onclick="if(confirm('¿Está seguro de rechazar este pago?')) { @this.call('changePayStatus', {{ $pay_id }}, 3) }"
            title="Rechazar">
            <i class="fa-solid fa-times"></i>
        </button>
    @endif
</div>

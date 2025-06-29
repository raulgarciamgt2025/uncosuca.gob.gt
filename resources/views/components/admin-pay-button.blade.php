@props(['pay_id', 'status'])

@switch($status)
    @case(1)
        <button
            class="btn btn-sm btn-primary"
            wire:click="$emit('openModal', 'pays.admin.pay-modal', {{ json_encode(['pay' => $pay_id ])  }})">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            Revisar
        </button>
    @break
    @default
        @break
@endswitch


@props(['pay_id', 'status'])

@switch($status)
    @case(0)
        <button
            class="btn btn-sm btn-success"
            wire:click="$emit('openModal', 'pays.users.pay-modal', {{ json_encode(['pay' => $pay_id ])  }})">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            Pagar
        </button>
    @break
    @case(3)
        <button
            class="btn btn-sm btn-info"
            wire:click="$emit('openModal', 'pays.users.pay-modal', {{ json_encode(['pay' => $pay_id ])  }})">
            <i class="fa-solid fa-hand-holding-dollar"></i>
            Modificar
        </button>
        @break
    @default
        @break
@endswitch


<div>
    <div class="card-header p-2">
        <h3>Cargar datos de pago</h3>
    </div>
    <div class="card-body p-2">
        <h4 class="text-center">
            <strong>
                {{ $months[$pay->mount < 10 ? ltrim($pay->mount, '0') : $pay->mount].' '.$pay->year }}
            </strong>
        </h4>
        @php
        if (count($corrections) > 0) {
            $show_subscribers_number = key_exists('subscribers_number', $corrections) ? null : 'disabled';
            $show_ticket_number = key_exists('ticket_number', $corrections) ?  null : 'disabled';
            $show_ticket_file = key_exists('ticket_file', $corrections) ?  null : 'disabled';
        }
        @endphp
        <form wire:submit.prevent="submit">
            <div class="row">
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.number
                        label="NÚMERO DE SUSCRIPTORES"
                        name="subscribers_number"
                        disabled="{{ $show_subscribers_number ?? null }}"
                        wire:model="subscribers_number"
                    >
                    </x-inputs.number>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.number
                        disabled="disabled"
                        label="MONTO A PAGAR"
                        name="subscribers_number"
                        wire:model="subscribers_number"
                    >
                    </x-inputs.number>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        disabled="{{ $show_ticket_number ?? null }}"
                        label="NÚMERO DE FORMULARIO SAT"
                        name="ticket_number"
                        wire:model="ticket_number"
                    >
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.file
                        disabled="{{ $show_ticket_file ?? null }}"
                        label="FORMULARIO SAT"
                        name="ticket_file"
                        description="Carga el formulario de la SAT en PDF."
                        wire:model="ticket_file"
                    >
                    </x-inputs.file>
                </x-inputs.group>
            </div>
        </form>
    </div>
   <div class="card-footer text-end">
       <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar <i class="fa-solid fa-xmark"></i></button>
       <button class="btn btn-success" wire:click="submit">Guardar <i class="fa-regular fa-paper-plane"></i></button>
   </div>
</div>


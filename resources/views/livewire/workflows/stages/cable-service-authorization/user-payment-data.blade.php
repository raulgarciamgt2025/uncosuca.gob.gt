<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Datos de pago - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}  {{ $this->workflowRequest->start_date->format('d/m/Y') }}</strong>
    </h2>
    <div class="card-body">
        <div class="alert alert-primary text-center">
            <h5><strong>Instrucciones: </strong>Carga todos los datos solicitados</h5>
        </div>
        <form wire:submit.prevent="submit">
            <h3>Datos para Resolución:</h3>
            <hr class="my-2">
            <div class="row">
                @if($this->corrections ?? null)
                    @if($this->corrections['voucher'] ?? null)
                        <x-inputs.group class="col-lg-6">
                            <x-inputs.file
                                label="BOLETA O COMPROBANTE DE PAGO"
                                description="Suba el comprobante de pago correspondiente"
                                name="voucher"
                                wire:model="voucher"/>
                        </x-inputs.group>
                    @else
                        @php
                            unset($this->rules['voucher'])
                        @endphp
                    @endif
                @else
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.file
                            label="BOLETA O COMPROBANTE DE PAGO"
                            description="Suba el comprobante de pago correspondiente"
                            name="voucher"
                            wire:model="voucher"/>
                    </x-inputs.group>
                @endif
                <x-inputs.group class="col-lg-6">
                    @if($this->corrections ?? null)
                        @if($this->corrections['subscribers_number'] ?? null)
                            <x-inputs.text
                                label="NÚMERO DE SUSCRIPTORES"
                                name="subscribers_number"
                                wire:model="subscribers_number"/>
                        @else
                            <x-inputs.text
                                label="NÚMERO DE SUSCRIPTORES"
                                disabled
                                name="subscribers_number"
                                value="{{ $this->last_stage['subscribers_number'] ?? '' }}"/>
                            @php
                                unset($this->rules['subscribers_number'])
                            @endphp
                        @endif
                        @else
                        <x-inputs.text
                            label="NÚMERO DE SUSCRIPTORES"
                            name="subscribers_number"
                            wire:model="subscribers_number"/>
                    @endif

                </x-inputs.group>
                <x-inputs.group class="col-lg-6">
                    @if($this->corrections ?? null)
                        @if($this->corrections['voucher_number'] ?? null)
                            <x-inputs.text
                                label="NÚMERO DE BOLETA"
                                name="voucher_number"
                                wire:model="voucher_number"/>
                        @else
                            <x-inputs.text
                                label="NÚMERO DE SUSCRIPTORES"
                                disabled
                                name="subscribers_number"
                                value="{{ $this->last_stage['voucher_number'] ?? '' }}"/>
                            @php
                                unset($this->rules['voucher_number'])
                            @endphp
                        @endif
                    @else
                        <x-inputs.text
                            label="NÚMERO DE BOLETA"
                            name="voucher_number"
                            wire:model="voucher_number"/>
                    @endif
                </x-inputs.group>
                <x-inputs.group class="col-lg-6">
                    @if($this->corrections ?? null)
                        @if($this->corrections['voucher_amount'] ?? null)
                            <x-inputs.text
                                label="MONTO DE BOLETA"
                                name="voucher_amount"
                                wire:model="voucher_amount"/>
                        @else
                            <x-inputs.text
                                label="MONTO DE BOLETA"
                                disabled
                                name="subscribers_number"
                                value="{{ $this->last_stage['voucher_amount'] ?? '' }}"/>
                            @php
                                unset($this->rules['voucher_amount'])
                            @endphp
                        @endif
                        @else
                        <x-inputs.text
                            label="MONTO DE BOLETA"
                            name="voucher_amount"
                            wire:model="voucher_amount"/>
                    @endif
                </x-inputs.group>
            </div>
        </form>
        <hr class="my-2">
        <button type="button" class="btn btn-primary" wire:click="submit">
            <div wire:loading.remove wire:target="submit">
                <i class="fas fa-save"></i>
                Enviar datos
            </div>
            <div wire:loading wire:target="submit">
                <div class="spinner-border text-white" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </button>
    </div>
</div>




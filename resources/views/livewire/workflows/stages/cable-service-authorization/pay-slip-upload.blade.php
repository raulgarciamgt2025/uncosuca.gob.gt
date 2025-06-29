<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Carga de boleta de pago - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}</strong>
    </h2>
    <div class="card-body">
        <div class="row">
            <x-inputs.group class="col-lg-6">
                <x-inputs.file
                    label="BOLETA DE PAGO"
                    description="Carga la boleta de pago en formato PDF"
                    name="pay_slip"
                    wire:model="pay_slip"/>
            </x-inputs.group>
            <x-inputs.group class="col-lg-6">
                <x-inputs.text
                    label="Observaciones"
                    name="adicional_data"
                    placeholder="Este campo es opcional"
                    wire:model="adicional_data"/>
            </x-inputs.group>
        </div>
        <p>
            <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#expedient" role="button" aria-expanded="false" aria-controls="collapseExample">
                VER EXPEDIENTE <i class="fa-solid fa-eye"></i>
            </a>
            <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#resolution" role="button" aria-expanded="false" aria-controls="collapseExample">
                VER RESOLUCIÓN FIRMADA <i class="fa-solid fa-file-pdf"></i>
            </a>
        </p>
        <div class="collapse" id="expedient">
            @include('livewire.components.view-data')
        </div>
        <div class="collapse" id="resolution">
            <div style="text-align: center">
                <div class="form-switch" style="display: inline-flex">
                    <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $this->previous_stage['authorization'] }}">
                        <h4>Resolución firmada <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                    </a>
                </div>
                <br>
                <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $this->previous_stage['authorization'] }}"></iframe>
            </div>
        </div>
        <hr class="my-2">
        <button type="button" wire:click="submit" class="btn btn-primary">Enviar datos</button>
    </div>
</div>



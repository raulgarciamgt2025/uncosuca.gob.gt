<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Autorización y Envío de Documentos - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}</strong>
    </h2>
    <div class="card-body">
        <hr class="my-2">
        <h3>Resolución firmada:</h3>
        <hr class="my-2">
        <div style="text-align: center">
            <div class="form-switch" style="display: inline-flex">
                <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $this->previous_stage['authorization'] }}">
                    <h4>Resolución firmada <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                </a>
            </div>
            <br>
            <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $this->previous_stage['authorization'] }}"></iframe>
        </div>
        <hr class="my-2">
        <button type="button" class="btn btn-primary" wire:click="submit">
            <div wire:loading.remove wire:target="submit">
                <i class="fas fa-save"></i>
                Enviar resolución
            </div>
            <div wire:loading wire:target="submit">
                <div class="spinner-border text-white" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </button>
    </div>
</div>



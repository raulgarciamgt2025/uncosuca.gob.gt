<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Revisión de requisitos - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}</strong>
    </h2>
    <div class="card-body">
        <form>
            <div class="alert alert-primary text-center">
                <h5><strong>Instrucciones: </strong>Seleccione los datos que deben corregirse.</h5>
            </div>
            @if($this->last_stage->json)
                <div class="alert alert-danger text-center">
                    <h5><strong>Motivo de rechazo: </strong>{{ json_decode($this->last_stage->json, true)['reject_motive'] ?? '' }}</h5>
                </div>
            @endif
            @if(count($this->form))
                <h3>Formulario:</h3>
                <hr class="my-2">
                @foreach($form as $key => $field)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="{{ 'inputs.'.$key }}" wire:model="{{ 'inputs.'.$key }}">
                                <strong>{{ mb_strtoupper($field['description']) }}:</strong>
                                {{ $field['response'] }}
                            </div>
                        </li>
                    </ul>
                @endforeach
            @endif
            @if(count($this->seller))
                <h3>Datos del vendedor</h3>
                <hr class="my-2">
                @foreach($this->seller as $key => $field)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="{{ 'inputs.'.$key }}" wire:model="{{ 'inputs.'.$key }}">
                                <strong>{{ mb_strtoupper($field['description']) }}:</strong>
                                {{ $field['response'] }}
                            </div>
                        </li>
                    </ul>
                @endforeach
                <hr class="my-2">
                <h3>Datos del comprador o nuevo propietario</h3>
                <hr class="my-2">
                @foreach($this->new_owner as $key => $field)
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" name="{{ 'inputs.'.$key }}" wire:model="{{ 'inputs.'.$key }}">
                                <strong>{{ mb_strtoupper($field['description']) }}:</strong>
                                {{ $field['response'] }}
                            </div>
                        </li>
                    </ul>
                @endforeach
            @endif
            <hr class="my-2">
            <h3>Documentos:</h3>
            <hr class="my-2">
            @php($first_item = true)
            <ul wire:ignore class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($documents as $name => $document)
                    @php($selected = $first_item ? 'active' : '')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link border {{ $selected }}" data-bs-toggle="pill"
                                data-bs-target="#document-{{ $name }}" type="button" role="tab"
                                aria-controls="#document-{{ $name }}" aria-selected="true">{{  mb_strtoupper($document['description'] ?? '') }}</button>
                    </li>
                    @php($first_item = false)
                @endforeach
            </ul>
            <div wire:ignore class="tab-content text-center" id="pills-tabContent">
                @php($first_item = true)
                @foreach($documents as $name => $document)
                    @php($selected = $first_item ? 'active' : '')
                    <div class="tab-pane fade show {{ $selected }} " id="document-{{ $name }}" role="tabpanel" aria-labelledby="{{ $name }}">
                        <div class="form-switch" style="display: inline-flex">
                            <input class="form-check-input" type="checkbox"
                                   wire:model="inputs.{{ $name }}">
                            &nbsp;
                            <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $document['url']}}">
                                <h4>{{ $document['description'] }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                            </a>
                        </div>
                        <br>
                        @if($document['url'] ?? null)
                            <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $document['url'] }}"></iframe>
                        @else
                            <br>
                            <div class="alert alert-danger text-center">
                                <h5>No se ha cargado este documento</h5>
                            </div>
                        @endif
                    </div>
                    @php($first_item = false)
                @endforeach
            </div>
            <hr class="my-2">
        </form>
        @if($workflowRequest->workflow->type > 1)
            @if($this->workflowRequest->company)
                <div class="alert alert-primary" role="alert">
                    Empresa asociada al trámite: {{ $this->workflowRequest->company->mercantile_name ?? '' }}
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    ¿A qué empresa pertenece este trámite?
                </div>
                <div class="col-lg-6">
                    <x-inputs.select
                        label="Asignar empresa trámite"
                        name="company"
                        id="company"
                        wire:model="company">
                        <option value="">Seleccione una empresa</option>
                        @foreach(\App\Models\Company::get(['id', 'mercantile_name']) as $company_item)
                            <option value="{{ $company_item->id }}">{{ $company_item->mercantile_name }}</option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <br>
            @endif
        @endif
        <button type="button" wire:click="showConfirmModal" class="btn btn-primary">Confirmar revisión</button>
        <button type="button" wire:click="showRejectedModal" class="btn btn-danger">Anular proceso</button>
    </div>
    <x-modal wire:model="confirm_modal" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DATOS A CORREGIR</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('confirm_modal')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach($this->rejected_inputs ?? [] as $key => $value)
                        @php($description = $this->form[$key]['description'] ?? $this->documents[$key]['description'] ??
                            $this->seller[$key]['description'] ?? $this->new_owner[$key]['description'])
                        @php($this->json[$key] = $description)
                        <li>
                            {{ $description }}
                        </li>
                    @endforeach
                </ul>
                <x-inputs.textarea
                    name="observations"
                    label="Observaciones adicionales"
                    wire:model="observations">
                </x-inputs.textarea>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('confirm_modal')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="submit">
                    <div wire:loading.remove wire:target="submit">
                        <i class="fas fa-save"></i>
                        Continuar
                    </div>
                    <div wire:loading wire:target="submit">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
    <x-modal wire:model="rejected_modal" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¡ESTA ACCIÓN ANULARÁ POR COMPLETO EL PROCESO!</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('rejected_modal')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <x-inputs.textarea
                    name="observations"
                    label="Indica el motivo"
                    wire:model="observations">
                </x-inputs.textarea>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('rejected_modal')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="rejected">
                    <div wire:loading.remove wire:target="rejected">
                        <i class="fas fa-save"></i>
                        Continuar
                    </div>
                    <div wire:loading wire:target="rejected">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            let select = $('#company')
            select.select2().on('change', function() {
                @this.set('company', $(this).val());
            })
            Livewire.hook('message.processed', () => {
                select.select2().on('change', function() {
                    @this.set('company', $(this).val());
                })
            });
        });
    </script>
@endpush


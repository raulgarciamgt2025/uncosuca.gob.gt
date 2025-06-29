<div class="card p-0">
    <h2 class="card-title px-4 row">
        <div class="col">
            <strong>Empresas</strong>
        </div>
        <div class="col text-end">
            <button type="submit" class="btn btn-sm btn-outline-success" wire:click="showModal"><i class="fa-solid fa-file-excel"></i> Importar</button>
        </div>

    </h2>
    <div class="card-body">
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('companies') }}"><i class="fa-solid fa-rotate"></i> Recargar</a>
            <button type="submit" class="btn btn-sm btn-success " wire:click="excelExport"><i class="fa-solid fa-file-excel"></i> Exportar</button>
            @if($this->companies_beat)
                <button type="submit" class="btn btn-sm btn-info " wire:click="showCompaniesBeat(false)"><i class="fa-regular fa-rectangle-list"></i> Todas las empresas</button>
            @else
                <button type="submit" class="btn btn-sm btn-info " wire:click="showCompaniesBeat(true)"><i class="fa-regular fa-rectangle-list"></i> Empresas por vencer</button>
            @endif
        </div>
        @if($this->companies_beat)
            <div class="alert alert-info col-lg-3"><strong>Mostrando empresas por vencer</strong></div>
            <livewire:companies.company-table to_beat="true" to_map="false"/>
        @else
            <div class="alert alert-info col-lg-3"><strong>Mostrando todas las empresas</strong></div>
            <livewire:companies.company-table to_beat="false" to_map="false"/>
        @endif
    </div>
    <x-modal wire:model="modalImport" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cargar empresas</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modalImport')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <button class="btn btn-sm btn-success" wire:click="downloadFormat"><i class="fa-solid fa-download"></i> Descargar formato</button>
                <br><br>
                <label class="label"><strong>Seleccione un archivo excel (.xlsx)</strong></label>
                <input class="form-control" type="file" wire:model="file" wire:click="clearErrors" accept=".xlsx">
                @error('file')
                @include('components.inputs.partials.error')
                @enderror
                @if($errors_array)
                    @if(!$errors_array['result'] ?? null)
                        <br>
                        <div class="alert alert-danger">
                            <strong> {{ $errors_array['message'] }}</strong>
                            @if (is_array($errors_array['errors'])))
                                <div class="accordion">
                                    @foreach($errors_array['errors'] ?? [] as $key => $error)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="panel-{{$key}}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#close-{{$key}}" aria-expanded="false" aria-controls="close-{{$key}}">
                                                    <strong>Fila {{ $key }}</strong>
                                                </button>
                                            </h2>
                                            <div id="close-{{$key}}" class="accordion-collapse collapse" aria-labelledby="panel-{{$key}}">
                                                <div class="accordion-body">
                                                    <ul class="list-group">
                                                        @foreach($error as $item)
                                                            <li class="list-group-item">{{ $item }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @else
                        @php
                            $this->emit('showAlert', ['success', $errors_array['message']])
                        @endphp
                    @endif
                @endif

            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modalImport')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="import">
                    <div wire:loading.remove wire:target="import">
                        <i class="fas fa-save"></i>
                        Continuar
                    </div>
                    <div wire:loading wire:target="import">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
</div>

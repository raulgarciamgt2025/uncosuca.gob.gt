<div class="card">
    <div class="card-header">
        <h3 class="card-title">Nuevo trámite</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workflowsAvailable['workflows'] as $workflow)
                    @php
                        $disabled = '';
                        $tile = 'Haga clic para iniciar';
                        if (in_array($workflow->type, $workflowsAvailable['user_workflows_request'])) {
                            $disabled = 'disabled';
                            $tile = 'Ya has realizado este proceso';
                        }
                        $type = $workflow->double_process == 1 ? '(Individual o Jurídico)' : '';
                    @endphp
                    <tr>
                        <td>{{$workflow['name'] .' '. $type }}</td>
                        <td class="text-right">
                            <div class="btn-group-md text-center">
                                @if($workflow->double_process == 1)
                                    <div class="btn-group">
                                        <button class="btn btn-outline-primary" wire:click="showRequirementsModal({{ $workflow }})">
                                            Requisitos
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button
                                            class="btn btn-outline-success {{$disabled}}"
                                            wire:click="$emit('openModal', 'components.process-type-modal',
                                            {{ json_encode(['workflow' => $workflow])  }})">Iniciar <i class="fa-solid fa-circle-play"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="btn-group">
                                        <button class="btn btn-outline-primary" wire:click="showRequirementsModal({{ $workflow }})">
                                            Requisitos
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button
                                            wire:click="create({{ json_encode($workflow) }})"
                                            class="btn btn-outline-success" {{$disabled}} title="{{ $tile }}">
                                            Iniciar <i class="fa-solid fa-circle-play"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-modal wire:model="requirements" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $workflow_requirements['name'] ?? '' }}</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('requirements')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="max-height: 550px; overflow-y: auto;">
                    @include('livewire.components.requirements')
                </div>

            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    wire:click="$toggle('requirements')"
                >
                    <i class="fas fa-times"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </x-modal>
</div>

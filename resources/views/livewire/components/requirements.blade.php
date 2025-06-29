@if($workflow_requirements['double_process'] ?? null == 1)
    <p class="text-center">
        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#individual" role="button"
           aria-expanded="false" aria-controls="collapseExample">
            Individual
            <i class="fa-solid fa-eye"></i>
        </a>
        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#juridic" role="button"
           aria-expanded="false" aria-controls="collapseExample">
            Jurídico
            <i class="fa-solid fa-eye"></i>
        </a>
    </p>
    <div class="collapse" id="individual">
        @if(count($requirements_fields['individual'] ?? [] ))
            <h4 class="text-center">Persona individual</h4>
            <h5>Formulario:</h5>
            <hr class="my-2">
            @foreach($requirements_fields['individual']['form'] ?? [] as $key => $field)
                <ul class="list-group">
                    <li class="list-group-item">
                        {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }}
                    </li>
                </ul>
            @endforeach
            <hr class="my-2">
            <h5>Documentos en PDF:</h5>
            <hr class="my-2">
            @foreach($requirements_fields['individual']['documents'] ?? [] as $key => $field)
                <ul class="list-group">
                    <li class="list-group-item">
                        {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }} <br>
                        <p><small>{{ $field['description'] ?? '' }}</small></p>
                    </li>
                </ul>
            @endforeach
        @endif
    </div>
    <div class="collapse" id="juridic">
        @if(count($requirements_fields['juridic'] ?? []))
            <h4 class="text-center">Persona Jurídica</h4>
            <h5>Formulario:</h5>
            <hr class="my-2">
            @foreach($requirements_fields['juridic']['form'] ?? [] as $key => $field)
                <ul class="list-group">
                    <li class="list-group-item">
                        {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }}
                    </li>
                </ul>
            @endforeach
            <hr class="my-2">
            <h5>Documentos en PDF:</h5>
            <hr class="my-2">
            @foreach($requirements_fields['juridic']['documents'] ?? [] as $key => $field)
                <ul class="list-group">
                    <li class="list-group-item">
                        {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }} <br>
                        <p><small>{{ $field['description'] ?? '' }}</small></p>
                    </li>
                </ul>
            @endforeach
        @endif
    </div>
@else
    @if($requirements_fields['seller'] ?? null)
        <h4 class="text-center">Persona Individual o Jurídica</h4>
        <h5>Datos del vendedor:</h5>
        <hr class="my-2">
        @foreach($requirements_fields['seller']['form'] ?? [] as $key => $field)
            <ul class="list-group">
                <li class="list-group-item">
                    {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }}
                </li>
            </ul>
        @endforeach
        <hr class="my-2">
        <h5>Datos del comprador o nuevo propietario:</h5>
        <hr class="my-2">
        @foreach($requirements_fields['new_owner']['form'] ?? [] as $key => $field)
            <ul class="list-group">
                <li class="list-group-item">
                    {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }}
                </li>
            </ul>
        @endforeach
        <hr class="my-2">
        <h5>Documentos en PDF:</h5>
        <hr class="my-2">
        @foreach($requirements_fields['documents'] ?? [] as $key => $field)
            <ul class="list-group">
                <li class="list-group-item">
                    {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }} <br>
                    <p><small>{{ $field['description'] ?? '' }}</small></p>
                </li>
            </ul>
        @endforeach
    @else
        @if(count($requirements_fields['form'] ?? []))
            <h4 class="text-center">Persona Individual o Jurídica</h4>
            <h5>Formulario:</h5>
            <hr class="my-2">
            @foreach($requirements_fields['form'] ?? [] as $key => $field)
                <ul class="list-group">
                    <li class="list-group-item">
                        {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }}
                    </li>
                </ul>
            @endforeach
            <hr class="my-2">
            <h5>Documentos en PDF:</h5>
            <hr class="my-2">
            @foreach($requirements_fields['documents'] ?? [] as $key => $field)
                <ul class="list-group">
                    <li class="list-group-item">
                        {{ ucfirst(mb_strtolower($field['label'] ?? '', 'UTF-8')) }} <br>
                        <p><small>{{ $field['description'] ?? '' }}</small></p>
                    </li>
                </ul>
            @endforeach
        @endif
    @endif
@endif

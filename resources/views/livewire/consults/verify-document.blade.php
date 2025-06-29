<div class="card p-2">
    <h2 class="card-title px-4 text-center">
        <strong>UNIDAD DE CONTROL Y SUPERVISIÓN DE CABLE - UNCOSU <br> SISTEMA DE TRÁMITES EN LÍNEA</strong>
        <hr class="my-2">
    </h2>
    <div class="card-body">
        <h4 class="card-title p-0"><strong>&nbsp;DATOS DE LA EMPRESA</strong></h4>
        <ul class="list-group">
            <li class="list-group-item"><strong>NOMBRE O DENOMINACIÓN SOCIAL: </strong>
                {{ $first_stage['form']['mercantile_company_name']['response'] ?? $first_stage['form']['social_denomination']['response'] ?? '' }}
            </li>
            <li class="list-group-item"><strong>PROPIETARIO O REPRESENTANTE LEGAL: </strong>
                {{ $first_stage['form']['owner_name']['response'] ?? $first_stage['form']['legal_representative_name']['response'] ?? '' }}
            </li>
        </ul>
        <h4 class="card-title text-center">Documento Auténtico Firmado Electrónicamente <br>Vigente del <strong>{{ $this->begin_date }} al {{ $this->end_date }}</strong></h4>
        <a class="link-dark text-center" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $this->resolution['authorization'] ?? '' }}">
            <h4>Abrir en enlace externo <i class="fa-solid fa-square-arrow-up-right"></i></h4>
        </a>
        <iframe style="width: 100%; height: 60rem"  src="/storage/{{  $this->resolution['authorization'] ?? '' }}"></iframe>
        <hr class="my-2">
    </div>
</div>

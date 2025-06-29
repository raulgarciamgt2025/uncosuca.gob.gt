<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @auth()
            <li class="nav-heading">PROCESOS</li>
            @can('Dashboard')
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Dashboard</span>
                </a>
            @endif
            @can('viewHistory', \App\Models\User::class)
                <a class="nav-link collapsed" href="{{ route('consults') }}">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Monitoreo</span>
                </a>
            @endcan
            @can('Crear solicitudes')
                <a class="nav-link collapsed" href="{{ route('workflows-new-request') }}">
                    <i class="fa-solid fa-file-medical"></i>
                    <span>Nuevo proceso</span>
                </a>
            @endcan
            @can('Lista solicitudes asignadas')
                <a class="nav-link collapsed" href="{{ route('workflows-review-requests') }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span>Revisión</span>
                </a>
            @endcan
            @can('Lista mis solicitudes')
                <a class="nav-link collapsed" href="{{ route('workflows-my-requests') }}">
                    <i class="fa-solid fa-file-contract"></i>
                    <span>Mis procesos</span>
                </a>
            @endcan
            @can('Mis quejas')
                <a class="nav-link collapsed" href="{{ route('applicant-complaints') }}">
                    <i class="fa-solid fa-file-circle-exclamation"></i>
                    <span>Mis quejas</span>
                </a>
            @endcan
            @can('Lista empresas')
                <li class="nav-heading">EMPRESAS</li>
                <a class="nav-link collapsed" href="{{ route('companies') }}">
                    <i class="fa-solid fa-satellite-dish"></i>
                    <span>&nbsp;Expedientes</span>
                </a>
            @endcan
            @can('Mapa privado')
                <a class="nav-link collapsed" href="{{ route('private-map') }}">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>&nbsp;Mapa</span>
                </a>
            @endcan
            @can('Lista pagos')
                <a class="nav-link collapsed" href="{{ route('pays') }}">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span>&nbsp;Pagos</span>
                </a>
            @endcan
            @can('Lista supervisiones')
                <a class="nav-link collapsed" href="{{ route('visits') }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span>&nbsp;Supervisiones</span>
                </a>
            @endcan
            @can('Mis supervisiones')
                <a class="nav-link collapsed" href="{{ route('my-visits') }}">
                    <i class="fa-solid fa-house-signal"></i>
                    <span>&nbsp;Mis supervisiones</span>
                </a>
            @endcan
            @can('Lista canales')
                <a class="nav-link collapsed" href="{{ route('channels') }}">
                    <i class="fa-solid fa-tower-broadcast"></i>
                    <span>&nbsp;Canales</span>
                </a>
            @endcan
            @can('Lista categorías')
                <a class="nav-link collapsed" href="{{ route('channels-category') }}">
                    <i class="fa-solid fa-bookmark"></i>
                    <span>&nbsp;Categorías</span>
                </a>
            @endcan
            @can('Mis pagos')
                <a class="nav-link collapsed" href="{{ route('my-pays') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>&nbsp;Mis pagos</span>
                </a>
            @endcan
            @can('view-any', App\Models\User::class)
                <li class="nav-heading">PANEL DE ADMINISTRACIÓN</li>
                <a class="nav-link collapsed" href="{{ route('users.index') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>&nbsp;Usuarios</span>
                </a>
            @endcan
            @can('view-any', App\Models\Department::class)
                <a class="nav-link collapsed" href="{{ route('departments.index') }}">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span>&nbsp;Departamentos</span>
                </a>
            @endcan
            @can('Lista quejas')
                <a class="nav-link collapsed" href="{{ route('applicant-complaints') }}">
                    <i class="fa-solid fa-file-circle-exclamation"></i>
                    <span>&nbsp;Quejas</span>
                </a>
            @endcan
            @can('Lista roles')
                <li class="nav-heading">CONTROL DE ACCESO</li>
                <a class="nav-link collapsed" href="{{ route('roles.index') }}">
                    <i class="fa-solid fa-user-lock"></i>
                    <span>Roles</span>
                </a>
            @endcan
            @can('Lista permisos')
                <a class="nav-link collapsed" href="{{ route('permissions.index') }}">
                    <i class="fa-solid fa-lock"></i>
                    <span>&nbsp;Permisos</span>
                </a>
            @endcan
        @else
            <a class="nav-link collapsed" href="{{ route('public-map') }}">
                <i class="fa-solid fa-map-location-dot"></i>
                <span>&nbsp;Mapa</span>
            </a>
        @endauth
        <li class="nav-heading">¿NECESITAS AYUDA?</li>
        <a class="nav-link collapsed" href="{{ route('contact') }}">
            <i class="fa-solid fa-phone"></i>
            <span>Contáctanos</span>
        </a>
    </ul>
</aside>

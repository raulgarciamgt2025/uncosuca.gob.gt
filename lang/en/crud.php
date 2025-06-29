<?php

return [
    'common' => [
        'actions' => 'Acciones',
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'new' => 'Nuevo',
        'cancel' => 'Cancelar',
        'attach' => 'Adjuntar',
        'detach' => 'Despegar',
        'save' => 'Guardar',
        'delete' => 'Eliminar',
        'delete_selected' => 'Eliminar seleccionados',
        'search' => 'Buscar',
        'back' => 'Regresar',
        'are_you_sure' => '¿Está seguro?',
        'no_items_found' => 'No se encontraron registros',
        'created' => 'Creado correctamente',
        'saved' => 'Guardado correctamente',
        'removed' => 'Eliminado correctamente',
    ],

    'usuarios' => [
        'name' => 'Usuarios',
        'index_title' => 'Lista de usuarios',
        'new_title' => 'Nuevo usuario',
        'create_title' => 'Crear usuario',
        'edit_title' => 'Modificar usuario',
        'show_title' => 'Detalle del usuario',
        'inputs' => [
            'name' => 'Nombres',
            'surname' => 'Apellidos',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'cui' => 'CUI',
            'nit' => 'NIT',
            'type' => 'Tipo',
            'active' => 'Activo',
        ],
    ],

    'departamentos' => [
        'name' => 'Departamentos',
        'index_title' => 'Lista de departamentos',
        'new_title' => 'Nuevo departamento',
        'create_title' => 'Crear departamento',
        'edit_title' => 'Modificar departamento',
        'show_title' => 'Detalle del departamento',
        'inputs' => [
            'name' => 'Nombre',
            'manager_id' => 'Responsable',
            'active' => 'Activo',
            'description' => 'Descripción',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Lista de roles',
        'create_title' => 'Crear rol',
        'edit_title' => 'Actualizar rol',
        'show_title' => 'Ver rol',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],

    'permissions' => [
        'name' => 'Permisos',
        'index_title' => 'Lista de permisos',
        'create_title' => 'Crear permiso',
        'edit_title' => 'Editar permiso',
        'show_title' => 'Ver permiso',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],
];

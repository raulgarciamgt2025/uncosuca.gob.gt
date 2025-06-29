<?php

namespace Database\Seeders;

use App\Models\Workflow;
use Illuminate\Database\Seeder;

class WorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workflows = [
            [
                'name' => 'AUTORIZACIÓN PARA PRESTAR SERVICIO DE CABLE',
                'description' => '',
                'type' => 1,
                'double_process' => 1,
                'stages' => [
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 0,
                        'description' => 'Recolección y Revisión de requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización'
                    ],
                    [
                        'department' => 2,
                        'manager' => 0,
                        'description' => 'Validación Legal'
                    ],
                    [
                        'department' => 2,
                        'manager' => 1,
                        'description' => 'Firma - Jurídico'
                    ],
                    [
                        'department' => 3,
                        'manager' => 1,
                        'description' => 'Firma - Dirección'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Carga de boleta de pago'
                    ],
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Carga de boleta pagada'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización y envío de documentos '
                    ]
                ],
                'requirements' => [
                    'individual' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'owner_name',
                                'label' => 'NOMBRE DE PROPIETARIO',
                                'placeholder' => 'NOMBRE DE PROPIETARIO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'occupation',
                                'label' => 'OCUPACIÓN',
                                'placeholder' => 'OCUPACIÓN',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nationality',
                                'label' => 'NACIONALIDAD',
                                'placeholder' => 'NACIONALIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_of_distribution',
                                'label' => 'LUGAR DONDE SE DISTRIBUIRÁ LA SEÑAL POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE DISTRIBUIRÁ LA SEÑAL POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_channels',
                                'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'co_owners',
                                'label' => 'COPROPIETARIOS (Separados por coma)',
                                'placeholder' => 'COPROPIETARIOS (Separados por coma)',
                                'required' => ''
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipality',
                                'label' => 'PERMISO MUNICIPAL',
                                'description' => 'Copia del permiso Municipal en el que se autoriza el USO DE VÍAS PÚBLICAS de los lugares que prestará el servicio',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_plan',
                                'label' => 'Plano o croquis',
                                'description' => 'Plano o Croquis del lugar de distribución de señal, con indicación clara del área o zona que cubrirá dicha red',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Estos datos deben coincidir con lo indicado en el formulario',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_patent',
                                'label' => 'Patente de Empresa Mercantil',
                                'description' => 'Copia autenticada de la Patente de Empresa Mercantil',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_sworn_declaration',
                                'label' => 'DECLARACIÓN JURADA Y CERTIFICACIÓN DETALLADA',
                                'description' => 'Si el interesado careciere de facturas contables del equipo que posee, deberá presentar declaración jurada y certificación detallada, extendida por notario y contador autorizado.',
                                'required' => 'required'
                            ],
                        ]
                    ],
                    'juridic' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'social_denomination',
                                'label' => 'DENOMINACIÓN SOCIAL',
                                'placeholder' => 'DENOMINACIÓN SOCIAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'legal_representative_name',
                                'label' => 'Nombre del representante legal',
                                'placeholder' => 'Nombre del representante legal',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_of_distribution',
                                'label' => 'LUGAR DONDE SE DISTRIBUIRÁ LA SEÑAL POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE DISTRIBUIRÁ LA SEÑAL POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_channels',
                                'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI DEL REPRESENTANTE LEGAL',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del representante legal',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI DEL REPRESENTANTE LEGAL',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del representante legal',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_writing',
                                'label' => 'ESCRITURA CONSTITUTIVA Y SUS MODIFICACIONES',
                                'description' => 'Copia legalizada de la escritura constitutiva y sus modificaciones',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_company_patent',
                                'label' => 'PATENTE DE SOCIEDAD',
                                'description' => 'Copia simple de la Patente de Sociedad',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_commercial_company_patent',
                                'label' => 'PATENTE DE EMPRESA MERCANTIL',
                                'description' => 'Copia simple de la Patente de Empresa Mercantil',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_appointment_of_legal_representative',
                                'label' => 'nombramiento del Representante Legal',
                                'description' => 'Copia legalizada del nombramiento del Representante Legal y su inscripción en el Registro Mercantil',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipality',
                                'label' => 'PERMISO MUNICIPAL',
                                'description' => 'Copia del permiso Municipal en el que se autoriza el USO DE VÍAS PÚBLICAS de los lugares que prestará el servicio',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_plan',
                                'label' => 'Plano o croquis',
                                'description' => 'Plano o Croquis del lugar de distribución de señal, con indicación clara del área o zona que cubrirá dicha red',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Estos datos deben coincidir con lo indicado en el formulario',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_sworn_declaration',
                                'label' => 'DECLARACIÓN JURADA Y CERTIFICACIÓN DETALLADA',
                                'description' => 'Si el interesado careciere de facturas contables del equipo que posee, deberá presentar declaración jurada y certificación detallada, extendida por notario y contador autorizado.',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable',
                                'required' => 'required'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Solicitud de Ampliación de Cobertura para Empresas Distribuidoras de Señal por Cable',
                'description' => '',
                'type' => 2,
                'double_process' => 1,
                'stages' => [
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 0,
                        'description' => 'Recolección y Revisión de requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización'
                    ],
                    [
                        'department' => 2,
                        'manager' => 0,
                        'description' => 'Validación Legal'
                    ],
                    [
                        'department' => 2,
                        'manager' => 1,
                        'description' => 'Firma - Jurídico'
                    ],
                    [
                        'department' => 3,
                        'manager' => 1,
                        'description' => 'Firma - Dirección'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización y envío de documentos '
                    ]
                ],
                'requirements' => [
                    'individual' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'owner_name',
                                'label' => 'NOMBRE DE PROPIETARIO',
                                'placeholder' => 'NOMBRE DE PROPIETARIO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nationality',
                                'label' => 'NACIONALIDAD',
                                'placeholder' => 'NACIONALIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_of_extension',
                                'label' => 'LUGAR DONDE SE AMPLIARÁ LA COBERTURA DE SEÑAL POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE AMPLIARÁ LA COBERTURA DE SEÑAL POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'taxes_paid',
                                'label' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'placeholder' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'co_owners',
                                'label' => 'COPROPIETARIOS (Separados por coma)',
                                'placeholder' => 'COPROPIETARIOS (Separados por coma)',
                                'required' => ''
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Contratos y/o certificaciones de los canales que transmite actualizados y con autorización para la nueva área de cobertura',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipality',
                                'label' => 'PERMISO MUNICIPAL',
                                'description' => 'Copia del permiso Municipal en el que se autoriza el USO DE VÍAS PÚBLICAS del nuevo lugar donde prestará el servicio',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_plan',
                                'label' => 'Plano o croquis',
                                'description' => 'Plano o Croquis del lugar de distribución de señal, con indicación clara del área o zona que cubrirá dicha red',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_sworn_declaration',
                                'label' => 'DECLARACIÓN JURADA Y CERTIFICACIÓN DETALLADA',
                                'description' => 'Si el interesado careciere de facturas contables del equipo nuevo que posee, deberá presentar declaración jurada y certificación detallada, extendida por notario y contador autorizado',
                                'required' => 'required'
                            ],
                        ],
                    ],
                    'juridic' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'social_denomination',
                                'label' => 'DENOMINACIÓN SOCIAL',
                                'placeholder' => 'DENOMINACIÓN SOCIAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_phone',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓN TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓN TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'legal_representative_name',
                                'label' => 'NOMBRE REPPRESENTANTE LEGAL',
                                'placeholder' => 'NOMBRE REPPRESENTANTE LEGAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_of_extension',
                                'label' => 'LUGAR DONDE SE AMPLIARÁ LA COBERTURA DE SEÑAL POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE AMPLIARÁ LA COBERTURA DE SEÑAL POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'taxes_paid',
                                'label' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'placeholder' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del representante legal',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_appointment_legal_representative',
                                'label' => 'NOMBRAMIENTO DEL REPRESENTANTE LEGAL',
                                'description' => 'Copia legalizada del nombramiento del Representante Legal y su inscripción en el Registro Mercantil',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Contratos y/o certificaciones de los canales que transmite actualizados y con autorización para la nueva área de cobertura',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipality',
                                'label' => 'PERMISO MUNICIPAL',
                                'description' => 'Copia del permiso Municipal en el que se autoriza el USO DE VÍAS PÚBLICAS del nuevo lugar donde prestará el servicio',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_society_patent',
                                'label' => 'PATENTE DE LA SOCIEDAD',
                                'description' => 'Patente de la sociedad',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_company_patent',
                                'label' => 'PATENTE DE LA EMPRESA',
                                'description' => 'Patente de la empresa',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_plan',
                                'label' => 'Plano o croquis',
                                'description' => 'Plano o Croquis del nuevo lugar de distribución de señal, con indicación clara del área o zona que cubrirá dicha red',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_sworn_declaration',
                                'label' => 'DECLARACIÓN JURADA Y CERTIFICACIÓN DETALLADA',
                                'description' => 'Si el interesado careciere de facturas contables del equipo nuevo que posee, deberá presentar declaración jurada y certificación detallada, extendida por notario y contador autorizado',
                                'required' => 'required'
                            ],
                        ],
                    ],
                ]
            ],
            [
                'name' => 'Solicitud de Renovación de Autorización para Transmisión de Señales por Cable',
                'description' => '',
                'type' => 3,
                'double_process' => 1,
                'stages' => [
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 0,
                        'description' => 'Recolección y Revisión de requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización'
                    ],
                    [
                        'department' => 2,
                        'manager' => 0,
                        'description' => 'Validación Legal'
                    ],
                    [
                        'department' => 2,
                        'manager' => 1,
                        'description' => 'Firma - Jurídico'
                    ],
                    [
                        'department' => 3,
                        'manager' => 1,
                        'description' => 'Firma - Dirección'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización y envío de documentos '
                    ]
                ],
                'requirements' => [
                    'individual' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'owner_name',
                                'label' => 'NOMBRE DE PROPIETARIO',
                                'placeholder' => 'NOMBRE DE PROPIETARIO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'occupation',
                                'label' => 'OCUPACIÓN',
                                'placeholder' => 'OCUPACIÓN',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nationality',
                                'label' => 'NACIONALIDAD',
                                'placeholder' => 'NACIONALIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_of_distribution',
                                'label' => 'LUGAR DONDE SE DISTRIBUIRÁ LA SEÑAL POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE DISTRIBUIRÁ LA SEÑAL POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_channels',
                                'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'date',
                                'name' => 'license_expiration',
                                'label' => 'FECHA DE VENCIMIENTO DE LA LICENCIA DE AUTORIZACIÓN EMITIDA POR UNCOSU',
                                'placeholder' => 'FECHA DE VENCIMIENTO DE LA LICENCIA DE AUTORIZACIÓN EMITIDA POR UNCOSU',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'taxes_paid',
                                'label' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'placeholder' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'co_owners',
                                'label' => 'COPROPIETARIOS (Separados por coma)',
                                'placeholder' => 'COPROPIETARIOS (Separados por coma)',
                                'required' => ''
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipality',
                                'label' => 'PERMISO MUNICIPAL',
                                'description' => 'Copia del permiso Municipal en el que se autoriza el USO DE VÍAS PÚBLICAS del nuevo lugar donde prestará el servicio',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_plan',
                                'label' => 'Plano o croquis',
                                'description' => 'Plano o Croquis del lugar de distribución de señal, con indicación clara del área o zona que cubrirá dicha red',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Contratos y/o certificaciones de los canales que transmite. (debe coincidir con lo indicado en el formulario)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_mercantile_company_patent',
                                'label' => 'PATENTE DE EMPRESA MERCANTIL',
                                'description' => 'Copia autenticada de la Patente de Empresa Mercantil',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_sworn_declaration',
                                'label' => 'DECLARACIÓN JURADA Y CERTIFICACIÓN DETALLADA',
                                'description' => 'Si el interesado careciere de facturas contables del equipo nuevo que posee, deberá presentar declaración jurada y certificación detallada, extendida por notario y contador autorizado',
                                'required' => 'required'
                            ],
                        ],
                    ],
                    'juridic' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'social_denomination',
                                'label' => 'DENOMINACIÓN SOCIAL',
                                'placeholder' => 'DENOMINACIÓN SOCIAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTARÁ INSTALADA LA ESTACIÓN TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'legal_representative_name',
                                'label' => 'NOMBRE REPPRESENTANTE LEGAL',
                                'placeholder' => 'NOMBRE REPPRESENTANTE LEGAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_of_distribution',
                                'label' => 'LUGAR DONDE SE DISTRIBUIRA LA SEÑAL POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE DISTRIBUIRA LA SEÑAL POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_channels',
                                'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'date',
                                'name' => 'license_expiration',
                                'label' => 'FECHA DE VENCIMIENTO DE LA LICENCIA DE AUTORIZACIÓN EMITIDA POR UNCOSU',
                                'placeholder' => 'FECHA DE VENCIMIENTO DE LA LICENCIA DE AUTORIZACIÓN EMITIDA POR UNCOSU',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'taxes_paid',
                                'label' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'placeholder' => 'ESTÁ AL DÍA EN EL IMPUESTO DE CABLE?',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del representante legal',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_writing',
                                'label' => 'ESCRITURA CONSTITUTIVA Y SUS MODIFICACIONES',
                                'description' => 'Copia legalizada de la escritura constitutiva y sus modificaciones',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_company_patent',
                                'label' => 'PATENTE DE SOCIEDAD',
                                'description' => 'Copia simple de la Patente de Sociedad',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_commercial_company_patent',
                                'label' => 'PATENTE DE EMPRESA MERCANTIL',
                                'description' => 'Copia simple de la Patente de Empresa Mercantil',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_appointment_of_legal_representative',
                                'label' => 'nombramiento del Representante Legal',
                                'description' => 'Copia legalizada del nombramiento del Representante Legal y su inscripción en el Registro Mercantil',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipality',
                                'label' => 'PERMISO MUNICIPAL',
                                'description' => 'Copia del permiso Municipal vigente en el que se autoriza el USO DE VÍAS PÚBLICAS de los lugares que prestará el servicio',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Contratos y/o certificaciones de los canales que transmite. (debe coincidir con lo indicado en el formulario)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_plan',
                                'label' => 'Plano o croquis',
                                'description' => 'Plano o Croquis del lugar de distribución de señal, con indicación clara del área o zona que cubrirá dicha red',
                                'required' => 'required'
                            ],
                        ],
                    ],
                ]
            ],
            [
                'name' => 'Solicitud de Autorización de Compra-Venta de Empresas Distribuidoras de Señal por Cable',
                'description' => '',
                'type' => 4,
                'double_process' => 0,
                'stages' => [
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 0,
                        'description' => 'Recolección y Revisión de requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización'
                    ],
                    [
                        'department' => 2,
                        'manager' => 0,
                        'description' => 'Validación Legal'
                    ],
                    [
                        'department' => 2,
                        'manager' => 1,
                        'description' => 'Firma - Jurídico'
                    ],
                    [
                        'department' => 3,
                        'manager' => 1,
                        'description' => 'Firma - Dirección'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización y envío de documentos '
                    ]
                ],
                'requirements' => [
                    'seller' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'name_or_social_denomination',
                                'label' => 'DENOMINACIÓN SOCIAL O NOMBRE DE PROPIETARIO',
                                'placeholder' => 'DENOMINACIÓN SOCIAL O NOMBRE DE PROPIETARIO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'DPI DEL PROPIETARIO O REPRESENTANTE LEGAL',
                                'placeholder' => 'DPI DEL PROPIETARIO O REPRESENTANTE LEGAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_originally',
                                'label' => 'LUGAR DONDE SE ORIGINA LA RED DE DISTRIBUCIÓN POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE ORIGINA LA RED DE DISTRIBUCIÓN POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_channels',
                                'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                    ],
                    'new_owner' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'new_owner_name_or_social_denomination',
                                'label' => 'DENOMINACIÓN SOCIAL O NOMBRE DE PROPIETARIO',
                                'placeholder' => 'DENOMINACIÓN SOCIAL O NOMBRE DE PROPIETARIO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'new_owner_mercantile_company_name',
                                'label' => 'NOMBRE DE EMPRESA MERCANTIL',
                                'placeholder' => 'NOMBRE DE EMPRESA MERCANTIL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'new_owner_legal_representative_name',
                                'label' => 'NOMBRE DEL REPPRESENTANTE LEGAL',
                                'placeholder' => 'NOMBRE DEL REPPRESENTANTE LEGAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'new_owner_dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'new_owner_nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'new_owner_nationality',
                                'label' => 'NACIONALIDAD',
                                'placeholder' => 'NACIONALIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'new_owner_address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'new_owner_mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'new_owner_phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'new_owner_email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'new_owner_department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'new_owner_municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'new_owner_village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                    ],
                    'documents' => [
                        [
                            'name' => 'documents_writing',
                            'label' => 'ESCRITURA CONSTITUTIVA Y SUS MODIFICACIONES',
                            'description' => 'Copia legalizada de la escritura constitutiva y sus modificaciones. (si fuere el caso)',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_company_patent',
                            'label' => 'PATENTE DE SOCIEDAD',
                            'description' => 'Copia simple de la Patente de Sociedad del COMPRADOR y VENDEDOR. (si fuere el caso)',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_commercial_company_patent',
                            'label' => 'PATENTE DE EMPRESA MERCANTIL',
                            'description' => 'Copia simple de la patente de empresa mercantil del COMPRADODR y VENDEDOR',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_pdf_dpi',
                            'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                            'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario actual y del nuevo propietario o representante legal',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_act_of_appointment',
                            'label' => 'ACTA DE NOMBRAMIENTO E INSCRIPCIÓN EN EL REGISTRO MERCANTIL',
                            'description' => 'Copia legalizada del Acta de Nombramiento del Representante Legal y su inscripción en el Registro Mercantil del comprador. (si fuere el caso)',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_bill',
                            'label' => 'MINUTA O PROMESA DE COMPRA-VENTA',
                            'description' => 'Minuta o Promesa de compra-venta o Cesión de Derechos',
                            'required' => 'required'
                        ],
                    ],
                ]
            ],
            [
                'name' => 'Solicitud de Cancelación de Licencia para Empresas Distribuidoras de Señal por Cable. (Persona Individual o Jurídica)',
                'description' => '',
                'type' => 5,
                'double_process' => 0,
                'stages' => [
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 0,
                        'description' => 'Recolección y Revisión de requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización'
                    ],
                    [
                        'department' => 2,
                        'manager' => 0,
                        'description' => 'Validación Legal'
                    ],
                    [
                        'department' => 2,
                        'manager' => 1,
                        'description' => 'Firma - Jurídico'
                    ],
                    [
                        'department' => 3,
                        'manager' => 1,
                        'description' => 'Firma - Dirección'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización y envío de documentos '
                    ]
                ],
                'requirements' =>  [
                    'form' => [
                        [
                            'type' => 'text',
                            'name' => 'social_denomination',
                            'label' => 'DENOMINACIÓN SOCIAL',
                            'placeholder' => 'DENOMINACIÓN SOCIAL',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'mercantile_company_name',
                            'label' => 'NOMBRE EMPRESA MERCANTIL',
                            'placeholder' => 'NOMBRE EMPRESA MERCANTIL',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'nit',
                            'label' => 'NÚMERO DE NIT',
                            'placeholder' => 'NÚMERO DE NIT',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'address_to_notify',
                            'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                            'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'mobile_number',
                            'label' => 'NÚMERO DE CELULAR',
                            'placeholder' => 'NÚMERO DE CELULAR',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'phone_number',
                            'label' => 'NÚMERO TELEFÓNICO',
                            'placeholder' => 'NÚMERO TELEFÓNICO',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'email',
                            'name' => 'email',
                            'label' => 'CORREO ELECTRÓNICO',
                            'placeholder' => 'CORREO ELECTRÓNICO',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'earth_station_address',
                            'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓN TERRENA',
                            'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓN TERRENA',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'legal_representative_name',
                            'label' => 'NOMBRE REPPRESENTANTE LEGAL',
                            'placeholder' => 'NOMBRE REPPRESENTANTE LEGAL',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'dpi',
                            'label' => 'NÚMERO DE DPI',
                            'placeholder' => 'NÚMERO DE DPI',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'place_originally',
                            'label' => 'LUGAR DONDE SE ORIGINA LA RED DE DISTRIBUCIÓN POR CABLE',
                            'placeholder' => 'LUGAR DONDE SE ORIGINA LA RED DE DISTRIBUCIÓN POR CABLE',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'reason',
                            'label' => 'RAZÓN POR LA QUE SOLICITA CANCELAR LA LICENCIA PARA OPERAR',
                            'placeholder' => 'RAZÓN POR LA QUE SOLICITA CANCELAR LA LICENCIA PARA OPERAR',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'department',
                            'label' => 'Departamento',
                            'placeholder' => 'Departamento',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'municipality',
                            'label' => 'Municipio',
                            'placeholder' => 'Municipio',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'village',
                            'label' => 'Aldea',
                            'placeholder' => 'Aldea',
                            'required' => ''
                        ],
                    ],
                    'documents' => [
                        [
                            'name' => 'documents_pdf_dpi',
                            'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                            'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario o representante legal',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_company_patent',
                            'label' => 'PATENTE DE SOCIEDAD',
                            'description' => 'Copia simple de la Patente de Sociedad (si fuere el caso)',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_commercial_company_patent',
                            'label' => 'PATENTE DE EMPRESA MERCANTIL',
                            'description' => 'Copia simple de la Patente de Empresa Mercantil',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_appointment_of_legal_representative',
                            'label' => 'nombramiento del Representante Legal',
                            'description' => 'Copia legalizada del nombramiento del Representante Legal y su inscripción en el Registro Mercantil (si fuere el caso)',
                            'required' => 'required'
                        ],
                    ],
                ]
            ],
            [
                'name' => 'Solicitud de Cambio de Razón Social para Empresas Distribuidoras de Señal por Cable. (Persona individual o Jurídica)',
                'description' => '',
                'type' => 6,
                'double_process' => 0,
                'stages' => [
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 0,
                        'description' => 'Recolección y Revisión de requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización'
                    ],
                    [
                        'department' => 2,
                        'manager' => 0,
                        'description' => 'Validación Legal'
                    ],
                    [
                        'department' => 2,
                        'manager' => 1,
                        'description' => 'Firma - Jurídico'
                    ],
                    [
                        'department' => 3,
                        'manager' => 1,
                        'description' => 'Firma - Dirección'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización y envío de documentos '
                    ]
                ],
                'requirements' => [
                    'form' => [
                        [
                            'type' => 'text',
                            'name' => 'name_owner_of_unit',
                            'label' => 'NOMBRE DEL PROPIETARIO REGISTRADO EN LA UNIDAD',
                            'placeholder' => 'NOMBRE DEL PROPIETARIO REGISTRADO EN LA UNIDAD',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'mercantile_company_name_of_unit',
                            'label' => 'NOMBRE DE LA EMPRESA MERCANTIL REGISTRADA EN LA UNIDAD',
                            'placeholder' => 'NOMBRE DE LA EMPRESA MERCANTIL REGISTRADA EN LA UNIDAD',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'registered_entity_name',
                            'label' => 'NOMBRE DE LA ENTIDAD A REGISTRAR',
                            'placeholder' => 'NOMBRE DE LA ENTIDAD A REGISTRAR',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'mercantile_company_name_register',
                            'label' => 'NOMBRE DE LA EMPRESA MERCANTIL A REGISTRAR',
                            'placeholder' => 'NOMBRE DE LA EMPRESA MERCANTIL A REGISTRAR',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'representative_name',
                            'label' => 'NOMBRE DEL REPRESENTATE LEGAL',
                            'placeholder' => 'NOMBRE DEL REPRESENTATE LEGAL',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'dpi',
                            'label' => 'NÚMERO DE DPI',
                            'placeholder' => 'NÚMERO DE DPI',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'nit',
                            'label' => 'NÚMERO DE NIT',
                            'placeholder' => 'NÚMERO DE NIT',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'nationality',
                            'label' => 'NACIONALIDAD',
                            'placeholder' => 'NACIONALIDAD',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'address_to_notify',
                            'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                            'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'mobile_number',
                            'label' => 'NÚMERO DE CELULAR',
                            'placeholder' => 'NÚMERO DE CELULAR',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'phone_number',
                            'label' => 'NÚMERO TELEFÓNICO',
                            'placeholder' => 'NÚMERO TELEFÓNICO',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'email',
                            'name' => 'email',
                            'label' => 'CORREO ELECTRÓNICO',
                            'placeholder' => 'CORREO ELECTRÓNICO',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'earth_station_address',
                            'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓ TERRENA',
                            'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓ TERRENA',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'number_of_subscribers',
                            'label' => 'CANTIDAD DE SUSCRIPTORES',
                            'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'number',
                            'name' => 'number_of_channels',
                            'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                            'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'department',
                            'label' => 'Departamento',
                            'placeholder' => 'Departamento',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'municipality',
                            'label' => 'Municipio',
                            'placeholder' => 'Municipio',
                            'required' => 'required'
                        ],
                        [
                            'type' => 'text',
                            'name' => 'village',
                            'label' => 'Aldea',
                            'placeholder' => 'Aldea',
                            'required' => ''
                        ],
                    ],
                    'documents' => [
                        [
                            'name' => 'documents_pdf_dpi',
                            'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                            'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario actual y del nuevo propietario o representante legal',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_rtu',
                            'label' => 'RTU ACTUALIZADO',
                            'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_writing',
                            'label' => 'ESCRITURA CONSTITUTIVA Y SUS MODIFICACIONES',
                            'description' => 'Copia legalizada de la escritura constitutiva y sus modificaciones.',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_company_patent',
                            'label' => 'PATENTE DE SOCIEDAD',
                            'description' => 'Copia simple de la Patente de Sociedad',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_commercial_company_patent',
                            'label' => 'PATENTE DE EMPRESA MERCANTIL',
                            'description' => 'Copia simple de la patente de Empresa Mercantil registrada en la Unidad',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_act_of_appointment',
                            'label' => 'ACTA DE NOMBRAMIENTO E INSCRIPCIÓN EN EL REGISTRO MERCANTIL',
                            'description' => 'Copia legalizada del Acta de Nombramiento del Representante Legal y su inscripción en el Registro Mercantil.',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_contracts',
                            'label' => 'Contratos y/o certificaciones de los canales que transmite',
                            'description' => 'Contratos y/o certificaciones de los canales que transmite a nombre de la entidad. (los mismos debe coincidir con lo indicado en el formulario)',
                            'required' => 'required'
                        ],
                        [
                            'name' => 'documents_permission_municipal',
                            'label' => 'Cesión de Derechos donde se realizó la negociación',
                            'description' => 'Copia del permiso Municipal donde se haga constar el cambio de razón social.',
                            'required' => 'required'
                        ],
                    ]
                ]
            ],
            [
                'name' => 'Solicitud de Cambio de Nombre o Propietario para Empresas Distribuidoras de Señales de Cable',
                'description' => '',
                'type' => 7,
                'double_process' => 1,
                'stages' => [
                    [
                        'department' => null,
                        'manager' => null,
                        'description' => 'Requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 0,
                        'description' => 'Recolección y Revisión de requisitos'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización'
                    ],
                    [
                        'department' => 2,
                        'manager' => 0,
                        'description' => 'Validación Legal'
                    ],
                    [
                        'department' => 2,
                        'manager' => 1,
                        'description' => 'Firma - Jurídico'
                    ],
                    [
                        'department' => 3,
                        'manager' => 1,
                        'description' => 'Firma - Dirección'
                    ],
                    [
                        'department' => 1,
                        'manager' => 1,
                        'description' => 'Autorización y envío de documentos '
                    ]
                ],
                'requirements' => [
                    'individual' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'owner_name',
                                'label' => 'NOMBRE DE PROPIETARIO',
                                'placeholder' => 'NOMBRE DE PROPIETARIO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nationality',
                                'label' => 'NACIONALIDAD',
                                'placeholder' => 'NACIONALIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓN TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓN TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'place_originally',
                                'label' => 'LUGAR DONDE SE ORIGINA LA RED DE DISTRIBUCIÓN POR CABLE',
                                'placeholder' => 'LUGAR DONDE SE ORIGINA LA RED DE DISTRIBUCIÓN POR CABLE',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'previous_mercantile_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL ANTERIOR',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL ANTERIOR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'actual_mercantile_name',
                                'label' => 'NOMBRE EMPRESA MERCANTIL ACTUAL',
                                'placeholder' => 'NOMBRE EMPRESA MERCANTIL ACTUAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_channels',
                                'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'co_owners',
                                'label' => 'COPROPIETARIOS (Separados por coma)',
                                'placeholder' => 'COPROPIETARIOS (Separados por coma)',
                                'required' => ''
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario registrado en esta Unidad de Control y Supervisión -UNCOSU- y del nuevo propietario (si fuere el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable del nuevo propietario',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_patent_of_mercantile_company',
                                'label' => 'Patente de empresa mercantil',
                                'description' => 'Copia legalizada de la patente de empresa mercantil, del nuevo propietario o a nombre de la nueva empresa (según el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_buy_sell',
                                'label' => 'Cesión de Derechos donde se realizó la negociación',
                                'description' => 'Copia simple de la Compra-venta o cesión de Derechos donde se realizó la negociación',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Contratos y/o certificaciones de los canales que transmite con el NUEVO NOMBRE de la Empresa Mercantil o nuevo propietario (según el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipal',
                                'label' => 'Cesión de Derechos donde se realizó la negociación',
                                'description' => 'Copia simple del permiso Municipal donde se establezca el cambio realizado',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_uncoscu_authorization',
                                'label' => 'Autorización de la UNCOSU sobre la viabilidad del cambio',
                                'description' => 'Adjuntar autorización de la UNCOSU sobre la viabilidad del cambio de propietario o cambio de nombre de empresa',
                                'required' => 'required'
                            ],
                        ],
                    ],
                    'juridic' => [
                        'form' => [
                            [
                                'type' => 'text',
                                'name' => 'name_owner_of_unit',
                                'label' => 'NOMBRE DEL PROPIETARIO REGISTRADO EN LA UNIDAD',
                                'placeholder' => 'NOMBRE DEL PROPIETARIO REGISTRADO EN LA UNIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'mercantile_company_name_of_unit',
                                'label' => 'NOMBRE DE LA EMPRESA MERCANTIL REGISTRADA EN LA UNIDAD',
                                'placeholder' => 'NOMBRE DE LA EMPRESA MERCANTIL REGISTRADA EN LA UNIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'registered_entity_name',
                                'label' => 'NOMBRE DE LA ENTIDAD O EMPRESA A REGISTRAR',
                                'placeholder' => 'NOMBRE DE LA ENTIDAD O EMPRESA A REGISTRAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'name_of_new_owner',
                                'label' => 'NOMBRE DEL NUEVO PROPIETARIO O REPRESENTATE LEGAL',
                                'placeholder' => 'NOMBRE DEL NUEVO PROPIETARIO O REPRESENTATE LEGAL',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'dpi',
                                'label' => 'NÚMERO DE DPI',
                                'placeholder' => 'NÚMERO DE DPI',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nit',
                                'label' => 'NÚMERO DE NIT',
                                'placeholder' => 'NÚMERO DE NIT',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'nationality',
                                'label' => 'NACIONALIDAD',
                                'placeholder' => 'NACIONALIDAD',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'address_to_notify',
                                'label' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'placeholder' => 'LUGAR PARA RECIBIR NOTIFICACIONES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'mobile_number',
                                'label' => 'NÚMERO DE CELULAR',
                                'placeholder' => 'NÚMERO DE CELULAR',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'phone_number',
                                'label' => 'NÚMERO TELEFÓNICO',
                                'placeholder' => 'NÚMERO TELEFÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'email',
                                'name' => 'email',
                                'label' => 'CORREO ELECTRÓNICO',
                                'placeholder' => 'CORREO ELECTRÓNICO',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'earth_station_address',
                                'label' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓ TERRENA',
                                'placeholder' => 'DIRECCIÓN DEL INMUEBLE DONDE ESTÁ INSTALADA LA ESTACIÓ TERRENA',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_subscribers',
                                'label' => 'CANTIDAD DE SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'number',
                                'name' => 'number_of_channels',
                                'label' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'placeholder' => 'CANTIDAD DE CANALES QUE PROPORCIONA A LOS SUSCRIPTORES',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'department',
                                'label' => 'Departamento',
                                'placeholder' => 'Departamento',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'municipality',
                                'label' => 'Municipio',
                                'placeholder' => 'Municipio',
                                'required' => 'required'
                            ],
                            [
                                'type' => 'text',
                                'name' => 'village',
                                'label' => 'Aldea',
                                'placeholder' => 'Aldea',
                                'required' => ''
                            ],
                        ],
                        'documents' => [
                            [
                                'name' => 'documents_pdf_dpi',
                                'label' => 'DOCUMENTO PERSONAL DE IDENTIFICACIÓN DPI',
                                'description' => 'Copia completa del Documento Personal de Identificación DPI del propietario registrado en esta Unidad de Control y Supervisión -UNCOSU- y del nuevo propietario (si fuere el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_rtu',
                                'label' => 'RTU ACTUALIZADO',
                                'description' => 'RTU actualizado, afiliado como Distribuidor de Señal por Cable del nuevo propietario o de la nueva entidad',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_writing',
                                'label' => 'ESCRITURA CONSTITUTIVA Y SUS MODIFICACIONES',
                                'description' => 'Copia legalizada de la escritura constitutiva y sus modificaciones (si fuere el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_company_patent',
                                'label' => 'PATENTE DE SOCIEDAD',
                                'description' => 'Copia simple de la Patente de Sociedad (si fuere el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_appointment_of_legal_representative',
                                'label' => 'nombramiento del Representante Legal',
                                'description' => 'Copia legalizada del nombramiento del Representante Legal y su inscripción en el Registro Mercantil (si fuere el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_mercantile_company_patent',
                                'label' => 'PATENTE DE EMPRESA MERCANTIL CON EL NUEVO NOMBRE',
                                'description' => 'Copia autenticada de la Patente de Empresa Mercantil con el nuevo nombre de empresa o con el nombre del nuevo propietario (según el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_buy_sell',
                                'label' => 'Cesión de Derechos donde se realizó la negociación',
                                'description' => 'Copia simple de la Compra-venta o cesión de Derechos donde se realizó la negociación',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_contracts',
                                'label' => 'Contratos y/o certificaciones de los canales que transmite',
                                'description' => 'Contratos y/o certificaciones de los canales que transmite a nombre del nuevo propietario o del nuevo nombre de la empresa (según el caso)',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_permission_municipal',
                                'label' => 'Cesión de Derechos donde se realizó la negociación',
                                'description' => 'Copia simple del permiso Municipal donde se establezca el cambio realizado',
                                'required' => 'required'
                            ],
                            [
                                'name' => 'documents_uncoscu_authorization',
                                'label' => 'Autorización de la UNCOSU sobre la viabilidad del cambio',
                                'description' => 'Adjuntar autorización de la UNCOSU sobre la viabilidad del cambio de propietario o cambio de nombre de empresa',
                                'required' => 'required'
                            ],
                        ],
                    ]
                ]
            ],
        ];

        foreach ($workflows as $workflow) {
            Workflow::create([
                'name' => $workflow['name'],
                'description' => $workflow['description'],
                'double_process' => $workflow['double_process'],
                'type' => $workflow['type'],
                'steps' => json_encode($workflow['stages']),
                'requirements' => json_encode($workflow['requirements']),
            ]);
        }
    }
}

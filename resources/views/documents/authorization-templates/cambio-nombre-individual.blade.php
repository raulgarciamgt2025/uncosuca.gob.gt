<p class="black-text">
    SOLICITANTE: {{ mb_strtoupper($fields['owner_name']) }},
    PROPIETARIO O COPROPIETARIOS DE LA EMPRESA MERCANTIL {{ mb_strtoupper($fields['previous_mercantile_name']) }}.
</p>
<p class="black-text">ASUNTO: SOLICITUD DE CAMBIO DE NOMBRE O PROPIETARIO DE EMPRESA.</p>
<p class="justify black-text">
    UNIDAD DE CONTROL Y SUPERVISIÓN -UNCOSU- MINISTERIO DE COMUNICACIONES,
    INFRAESTRUCTURA Y VIVIENDA. GUATEMALA {{ mb_strtoupper($fields['string_date']) }}.
</p>
<p class="justify">
    <strong>CONSIDERANDO:</strong> De conformidad con la documentación que obra dentro del expediente de fecha
    {{ $fields['requirements_date'] }}, presentada ante la UNIDAD DE CONTROL Y SUPERVISIÓN -UNCOSU-,
    por {{ $fields['owner_name'] }}, PROPIETARIO O COPROPIETARIOS DE LA EMPRESA MERCANTIL {{ $fields['previous_mercantile_name'] }},
    indica que el nuevo propietario o nuevo nombre de empresa es {{ $fields['actual_mercantile_name'] }}.
</p>
<p class="justify">
    <strong>CONSIDERANDO:</strong> Que el solicitante a la presente fecha ha cumplido con los requisitos establecidos
    en la ley y, tomando en consideración los antecedentes del presente expediente es procedente autorizar el cambio
    de nombre o propietario de empresa, promovida por {{ $fields['owner_name'] }}, PROPIETARIO O COPROPIETARIOS de la
    empresa mercantil {{ $fields['previous_mercantile_name'] }}, por el de {{ $fields['actual_mercantile_name'] }}.
</p>
<p class="justify">
    <strong>POR TANTO:</strong> Con base en lo considerado y artículos 1,3,4,5,6,7, 9 de la Ley Reguladora del Uso
    y Captación de Señales Vía Satélite y su Distribución por Cable, Decreto Numero 41-92 del Congreso de la
    República de Guatemala; 2,3,4,5,10 del Reglamento de la Ley Reguladora del Uso y Captación de Señales Vía
    Satélite y su Distribución por Cable, Acuerdo Gubernativo Numero 722-93.
</p>
<p class="justify black-text">
    DECLARA: I. CON LUGAR, LA AUTORIZACIÓN PARA EL CAMBIO DE NOMBRE O DE PROPIETARIO DE EMPRESA, PROMOVIDA
    POR {{ mb_strtoupper($fields['owner_name']) }}, PROPIETARIO O COPROPIETARIOS DE LA EMPRESA MERCANTIL
    {{ mb_strtoupper($fields['mercantile_company_name']) }} por el de {{ mb_strtoupper($fields['actual_mercantile_name']) }};
    II) OFÍCIESE AL ARCHIVO; III) NOTIFÍQUESE; IV) ESTA
    RESOLUCIÓN FUE  FIRMADA ELECTRÓNICAMENTE POR LA AUTORIDAD DE UNIDAD DE CONTROL Y SUPERVISIÓN -  UNCOSU - EN LA
    CUAL PUEDES VERIFICAR LA AUTENTICIDAD ESCANEANDO EL CÓDIGO QR.
</p>


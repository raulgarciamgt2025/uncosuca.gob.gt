<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Municipality;
use App\Rules\SearchMunicipalityRule;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Date;

class CompanyImport implements ToCollection, SkipsEmptyRows
{
    private array $response;
    public function collection(Collection $collection)
    {
        try {
            unset($collection[0]);
            $errors = [];
            $rules = [
                'mercantile_name'       => ['required', 'string'],
                'social_denomination'   => ['nullable', 'string'],
                'nit'                   => ['required'],
                'address'               => ['required', 'string'],
                'station_address'       => ['nullable', 'string'],
                'coverage'              => ['nullable', 'string'],
                'owners'                => ['required', 'string'],
                'municipality_id'       => ['nullable', 'string', new SearchMunicipalityRule],
                'village'               => ['nullable', 'string'],
                'cui'                   => ['nullable'],
                'phone'                 => ['nullable'],
                'users_number'          => ['required', 'numeric'],
                'license'               => ['required', 'bool'],
                'email_1'               => ['nullable', 'email'],
                'email_2'               => ['nullable', 'email'],
                'latitude'              => ['nullable', ],
                'longitude'             => ['nullable', ],
                'legal_representative'  => ['nullable', 'string'],
                'resolution'            => ['nullable', 'string'],
                'start_date'            => ['nullable', ],
                'end_date'              => ['nullable', ],
                'status'                => ['nullable', 'bool'],
                'payment_status'        => ['nullable', 'bool'],
                'company_type'          => ['required', 'between:1,2'],
            ];
            DB::beginTransaction();
            foreach ($collection as $key => $item)
            {
                $start_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[19])->format('Y-m-d');
                $end_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[20])->format('Y-m-d');
                $company = [
                    'mercantile_name'       => $item[0] ?? null,
                    'social_denomination'   => $item[1] ?? null,
                    'nit'                   => $item[2] ?? null,
                    'address'               => $item[3] ?? null,
                    'station_address'       => $item[4] ?? null,
                    'coverage'              => $item[5] ?? null,
                    'owners'                => $item[6] ?? null,
                    'municipality_id'       => $item[7] ?? null,
                    'village'               => $item[8] ?? null,
                    'cui'                   => $item[9] ?? null,
                    'phone'                 => $item[10] ?? null,
                    'users_number'          => $item[11] ?? null,
                    'license'               => $item[12] ?? null,
                    'email_1'               => isset($item[13]) ? str_replace(" ", $item[13], "") : null,
                    'email_2'               => isset($item[14]) ? str_replace(" ", $item[14], "") : null,
                    'latitude'              => isset($item[15]) ? floatval($item[15]) : null,
                    'longitude'             => isset($item[16]) ? floatval($item[16]) : null,
                    'legal_representative'  => $item[17] ?? null,
                    'resolution'            => $item[18] ?? null,
                    'start_date'            => $start_date ?? null,
                    'end_date'              => $end_date ?? null,
                    'status'                => $item[21] ?? null,
                    'payment_status'        => $item[22] ?? null,
                    'company_type'          => $item[23] ?? null,
                ];
                $validator = Validator::make($company, $rules);
                if ($validator->passes()) {
                    $company['emails'] = [$company['email_1'], $company['email_2']];
                    $company['municipality_id'] = $company['municipality_id'] ? Municipality::search($company['municipality_id'])->first()?->id : null;
                    Company::create($company);
                } else {
                    $errors[$key] = $validator->errors()->all();
                }
            }
            if (count($errors) == 0) {
                $this->response = [
                    'result' => true,
                    'message' => 'Registros cargados correctamente',
                ];
                DB::commit();
            } else {
                $this->response = [
                    'result' => false,
                    'message' => 'Se han encontrado errores en el archivo',
                    'errors' => $errors
                ];
                DB::rollBack();
            }
        } catch (Exception $exception) {
            $this->response = [
                'result' => false,
                'message' => 'Utiliza el formato indicado'.$exception->getMessage(),
                'errors' => 'Ocurrió un problema con el archivo cargado'
            ];
        }
    }

    public function getResponse()
    {
        return $this->response;
    }
}

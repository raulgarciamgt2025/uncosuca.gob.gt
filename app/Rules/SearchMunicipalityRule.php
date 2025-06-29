<?php

namespace App\Rules;

use App\Models\Municipality;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SearchMunicipalityRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value != null && $value != '') {
            $municipality = Municipality::search(strtolower($value))->first();
            if (!$municipality) {
                $fail('El nombre del municipio está mal escrito o no existe: '. $value);
            }
        }
    }
}

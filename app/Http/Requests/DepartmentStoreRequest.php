<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'active' => ['required', 'boolean'],
            'description' => ['nullable', 'max:255', 'string'],
            'users' => ['array'],
        ];
    }
}

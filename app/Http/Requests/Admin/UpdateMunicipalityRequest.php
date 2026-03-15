<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMunicipalityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:150'],
            'province_id' => ['required', 'exists:provinces,id'],
            'lat'         => ['nullable', 'numeric', 'between:-90,90'],
            'lng'         => ['nullable', 'numeric', 'between:-180,180'],
            'population'  => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => 'nombre',
            'province_id' => 'provincia',
            'lat'         => 'latitud',
            'lng'         => 'longitud',
            'population'  => 'población',
        ];
    }
}

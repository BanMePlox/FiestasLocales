<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFestivalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    public function rules(): array
    {
        // Idénticas a store: en edición no hay restricción de fecha futura
        return [
            'municipality_id'   => ['required', 'exists:municipalities,id'],
            'category_id'       => ['required', 'exists:categories,id'],
            'name'              => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'start_date'        => ['required', 'date'],
            'end_date'          => ['required', 'date', 'after_or_equal:start_date'],
            'website_url'       => ['nullable', 'url', 'max:500'],
            'address'           => ['nullable', 'string', 'max:300'],
            'is_active'         => ['boolean'],
            'is_featured'       => ['boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'municipality_id' => 'municipio',
            'category_id'     => 'categoría',
            'name'            => 'nombre',
            'description'     => 'descripción',
            'start_date'      => 'fecha de inicio',
            'end_date'        => 'fecha de fin',
            'website_url'     => 'sitio web',
            'address'         => 'dirección',
        ];
    }
}

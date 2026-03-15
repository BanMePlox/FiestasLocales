<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')->id;

        return [
            // unique ignorando el registro actual para permitir guardar sin cambiar el nombre
            'name'        => ['required', 'string', 'max:100', "unique:categories,name,{$categoryId}"],
            'description' => ['nullable', 'string'],
            'color'       => ['nullable', 'string', 'max:7', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'icon'        => ['nullable', 'string', 'max:50'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'  => 'nombre',
            'color' => 'color',
            'icon'  => 'icono',
        ];
    }
}

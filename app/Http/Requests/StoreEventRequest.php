<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // La ruta ya está protegida con middleware auth
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:200'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
            'music_genre_id'  => ['nullable', 'exists:music_genres,id'],
            'description'     => ['nullable', 'string', 'max:3000'],
            'starts_at'       => ['required', 'date', 'after:now'],
            'ends_at'         => ['nullable', 'date', 'after:starts_at'],
            'venue'           => ['required', 'string', 'max:200'],
            'address'         => ['nullable', 'string', 'max:300'],
            'price'           => ['nullable', 'numeric', 'min:0', 'max:999'],
            'min_age'         => ['nullable', 'integer', 'min:0', 'max:99'],
            'website_url'     => ['nullable', 'url', 'max:500'],
            'instagram_url'   => ['nullable', 'url', 'max:500'],
            'cover_image'     => ['nullable', 'image', 'max:3072'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'            => 'nombre',
            'municipality_id' => 'municipio',
            'music_genre_id'  => 'género musical',
            'starts_at'       => 'fecha de inicio',
            'ends_at'         => 'fecha de fin',
            'venue'           => 'recinto',
            'address'         => 'dirección',
            'price'           => 'precio',
            'min_age'         => 'edad mínima',
            'website_url'     => 'web oficial',
            'instagram_url'   => 'Instagram',
            'cover_image'     => 'imagen',
        ];
    }
}

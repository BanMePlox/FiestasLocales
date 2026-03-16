<?php

namespace Database\Factories;

use App\Models\Comarca;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MunicipalityFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->city();

        return [
            'province_id' => Province::factory(),
            'comarca_id'  => null,
            'name'        => $name,
            'slug'        => Str::slug($name),
            'lat'         => fake()->latitude(37.5, 40.8),
            'lng'         => fake()->longitude(-1.5, 0.5),
            'population'  => fake()->numberBetween(500, 800000),
        ];
    }

    public function inComarca(Comarca $comarca): static
    {
        return $this->state(fn () => [
            'province_id' => $comarca->province_id,
            'comarca_id'  => $comarca->id,
        ]);
    }
}

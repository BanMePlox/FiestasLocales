<?php

namespace Database\Factories;

use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComarcaFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->word() . ' ' . fake()->word();

        return [
            'province_id' => Province::factory(),
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => fake()->optional()->sentence(),
        ];
    }
}

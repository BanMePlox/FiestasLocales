<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FestivalFactory extends Factory
{
    public function definition(): array
    {
        $name      = fake()->sentence(3, false);
        $startDate = fake()->dateTimeBetween('now', '+1 year');

        return [
            'municipality_id'   => Municipality::factory(),
            'category_id'       => Category::factory(),
            'name'              => $name,
            'slug'              => Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description'       => fake()->paragraphs(2, true),
            'short_description' => fake()->optional()->sentence(),
            'start_date'        => $startDate,
            'end_date'          => (clone $startDate)->modify('+3 days'),
            'is_active'         => true,
            'is_featured'       => false,
            'website_url'       => fake()->optional()->url(),
            'address'           => fake()->optional()->address(),
            'published_at'      => now(),
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false, 'published_at' => null]);
    }

    public function featured(): static
    {
        return $this->state(fn () => ['is_featured' => true]);
    }
}

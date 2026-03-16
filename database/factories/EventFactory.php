<?php

namespace Database\Factories;

use App\Models\Municipality;
use App\Models\MusicGenre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $name     = fake()->sentence(3, false);
        $startsAt = fake()->dateTimeBetween('+1 day', '+6 months');

        return [
            'municipality_id' => Municipality::factory(),
            'music_genre_id'  => MusicGenre::factory(),
            'submitted_by'    => null,
            'name'            => $name,
            'slug'            => Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description'     => fake()->optional()->paragraph(),
            'starts_at'       => $startsAt,
            'ends_at'         => (clone $startsAt)->modify('+5 hours'),
            'venue'           => fake()->company(),
            'address'         => fake()->optional()->streetAddress(),
            'price'           => fake()->optional(0.4)->randomFloat(2, 5, 50),
            'min_age'         => fake()->optional(0.3)->randomElement([16, 18]),
            'website_url'     => fake()->optional()->url(),
            'instagram_url'   => null,
            'cover_image'     => null,
            'is_active'       => true,
            'approved_at'     => now(),   // aprobado por defecto
        ];
    }

    /** Evento pendiente de aprobación */
    public function pending(): static
    {
        return $this->state(fn () => ['approved_at' => null]);
    }

    /** Evento propuesto por un usuario concreto */
    public function submittedBy(User $user): static
    {
        return $this->state(fn () => ['submitted_by' => $user->id]);
    }

    /** Evento en el pasado */
    public function past(): static
    {
        return $this->state(fn () => [
            'starts_at' => now()->subDays(10),
            'ends_at'   => now()->subDays(10)->addHours(5),
        ]);
    }
}

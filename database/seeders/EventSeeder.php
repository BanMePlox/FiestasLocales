<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'municipality' => 'lliria',
                'genre'        => 'electronica',
                'name'         => 'Llíria Party Festival',
                'description'  => 'La noche más grande del Camp de Turia. Tres escenarios con los mejores DJs de electrónica del momento.',
                'starts_at'    => '2026-07-18 22:00:00',
                'ends_at'      => '2026-07-19 07:00:00',
                'venue'        => 'Recinto Ferial de Llíria',
                'address'      => 'Camí de la Fira, s/n, Llíria',
                'price'        => 15.00,
                'min_age'      => 18,
            ],
            [
                'municipality' => 'betera',
                'genre'        => 'variada',
                'name'         => 'Nit de Festa Major de Bétera',
                'description'  => 'La noche central de las fiestas patronales de Bétera con orquestas y disc-jockeys hasta el amanecer.',
                'starts_at'    => '2026-08-15 23:00:00',
                'ends_at'      => '2026-08-16 06:00:00',
                'venue'        => 'Plaza del Ayuntamiento',
                'address'      => 'Pl. de l\'Ajuntament, 1, Bétera',
                'price'        => null,
                'min_age'      => null,
            ],
            [
                'municipality' => 'riba-roja-de-turia',
                'genre'        => 'reggaeton',
                'name'         => 'Riba Roja Urban Night',
                'description'  => 'Una noche de reggaeton, latin y trap en el corazón del Camp de Turia.',
                'starts_at'    => '2026-06-27 23:30:00',
                'ends_at'      => '2026-06-28 06:00:00',
                'venue'        => 'Polideportivo Municipal',
                'address'      => 'C/ del Poliesportiu, s/n, Riba-roja de Túria',
                'price'        => 10.00,
                'min_age'      => 16,
            ],
            [
                'municipality' => 'leliana',
                'genre'        => 'pop',
                'name'         => 'Festa de la Pedanía de L\'Eliana',
                'description'  => 'Actuaciones en directo y sesión de DJ en la plaza principal durante las fiestas de verano.',
                'starts_at'    => '2026-07-04 22:30:00',
                'ends_at'      => '2026-07-05 02:00:00',
                'venue'        => 'Plaza Mayor',
                'address'      => 'Pl. Major, L\'Eliana',
                'price'        => null,
                'min_age'      => null,
            ],
            [
                'municipality' => 'casinos',
                'genre'        => 'house',
                'name'         => 'Casinos Sunset Party',
                'description'  => 'Fiesta al atardecer en la sierra con sesión de house y chill-out en el entorno natural del Alt Túria.',
                'starts_at'    => '2026-08-01 19:00:00',
                'ends_at'      => '2026-08-02 03:00:00',
                'venue'        => 'Ermita de la Virgen de los Ángeles',
                'address'      => 'Camí de l\'Ermita, Casinos',
                'price'        => 8.00,
                'min_age'      => 18,
            ],
        ];

        foreach ($events as $e) {
            $municipalitySlug = $e['municipality'];
            $genreSlug        = $e['genre'];

            $municipalityId = DB::table('municipalities')->where('slug', $municipalitySlug)->value('id');
            $genreId        = DB::table('music_genres')->where('slug', $genreSlug)->value('id');

            if (!$municipalityId) {
                continue;
            }

            $slug = Str::slug($e['name']);
            $base = $slug;
            $i    = 1;
            while (DB::table('events')->where('slug', $slug)->exists()) {
                $slug = $base . '-' . $i++;
            }

            DB::table('events')->insert([
                'municipality_id' => $municipalityId,
                'music_genre_id'  => $genreId,
                'submitted_by'    => null,
                'name'            => $e['name'],
                'slug'            => $slug,
                'description'     => $e['description'],
                'starts_at'       => $e['starts_at'],
                'ends_at'         => $e['ends_at'],
                'venue'           => $e['venue'],
                'address'         => $e['address'],
                'price'           => $e['price'],
                'min_age'         => $e['min_age'],
                'is_active'       => true,
                'approved_at'     => now(),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}

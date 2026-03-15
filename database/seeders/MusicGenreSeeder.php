<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MusicGenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Electrónica',
            'House',
            'Techno',
            'Reggaeton',
            'Latin',
            'Hip-hop',
            'Rock',
            'Pop',
            'Flamenco',
            'Disco / Retro',
            'Variada',
            'Indie',
            'R&B',
            'Trap',
            'Bachata & Salsa',
        ];

        foreach ($genres as $name) {
            DB::table('music_genres')->updateOrInsert(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'slug' => Str::slug($name), 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}

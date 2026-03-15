<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            ComarcaSeeder::class,
            CategorySeeder::class,
            MusicGenreSeeder::class,
            AdminUserSeeder::class,
            FestivalSeeder::class,
            EventSeeder::class,
        ]);
    }
}

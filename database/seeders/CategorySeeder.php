<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fallas', 'slug' => 'fallas', 'color' => '#e63946', 'icon' => '🔥', 'description' => 'Festa de les Falles, monuments efímers cremats en la nit de Sant Josep.'],
            ['name' => 'Moros y Cristianos', 'slug' => 'moros-y-cristianos', 'color' => '#c0392b', 'icon' => '⚔️', 'description' => 'Festes commemorant la Reconquesta cristiana amb desfilades i batalles.'],
            ['name' => 'Semana Santa', 'slug' => 'semana-santa', 'color' => '#6b21a8', 'icon' => '✝️', 'description' => 'Processons i actes religiosos durant la setmana de Pasqua.'],
            ['name' => 'Hogueras de San Juan', 'slug' => 'hogueras-de-san-juan', 'color' => '#f39c12', 'icon' => '🌊', 'description' => 'Fogueres gegants i nit de bany a les platges d\'Alacant.'],
            ['name' => 'Bous al carrer', 'slug' => 'bous-al-carrer', 'color' => '#dc2626', 'icon' => '🐂', 'description' => 'Festejos taurins populars als carrers dels pobles valencians.'],
            ['name' => 'Romeria', 'slug' => 'romeria', 'color' => '#16a34a', 'icon' => '🚶', 'description' => 'Pelegrinatge popular fins a ermites i llocs sagrats.'],
            ['name' => 'Fira', 'slug' => 'fira', 'color' => '#0284c7', 'icon' => '🎪', 'description' => 'Fires i mercats tradicionals amb activitats culturals i comercials.'],
            ['name' => 'Cavalcada de Reis', 'slug' => 'cavalcada-de-reis', 'color' => '#7c3aed', 'icon' => '👑', 'description' => 'Cabalgata de Reyes Magos la víspera del día de Reyes.'],
            ['name' => 'Corpus Christi', 'slug' => 'corpus-christi', 'color' => '#d97706', 'icon' => '🌺', 'description' => 'Processons del Corpus amb catifes de flors i representacions.'],
            ['name' => 'Festes Patronals', 'slug' => 'festes-patronals', 'color' => '#0f766e', 'icon' => '🎉', 'description' => 'Festes en honor al patró o patrona del municipi.'],
            ['name' => 'Fogueres', 'slug' => 'fogueres', 'color' => '#ea580c', 'icon' => '🔥', 'description' => 'Fogueres de Sant Antoni i altres celebracions amb foc.'],
            ['name' => 'Música y Bandas', 'slug' => 'musica-y-bandas', 'color' => '#be185d', 'icon' => '🎺', 'description' => 'Certàmens musicals i actuacions de bandes de música.'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insertOrIgnore(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

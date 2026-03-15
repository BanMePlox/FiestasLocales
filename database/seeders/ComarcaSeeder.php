<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ComarcaSeeder extends Seeder
{
    public function run(): void
    {
        $valenciaId = DB::table('provinces')->where('slug', 'valencia')->value('id');

        // --- COMARCAS ---
        $comarcas = [
            [
                'province_id' => $valenciaId,
                'name'        => 'Camp de Turia',
                'slug'        => 'camp-de-turia',
                'description' => 'Comarca valenciana al noroeste de l\'Horta, regada por el río Turia. Capital: Llíria.',
            ],
            // Añadir más comarcas aquí en futuras iteraciones
        ];

        foreach ($comarcas as $comarca) {
            DB::table('comarcas')->updateOrInsert(
                ['slug' => $comarca['slug']],
                array_merge($comarca, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        // --- MUNICIPIOS Camp de Turia ---
        $campDeTuriaId = DB::table('comarcas')->where('slug', 'camp-de-turia')->value('id');

        $municipalities = [
            ['name' => 'Llíria',                    'lat' => 39.6281, 'lng' => -0.5975, 'population' => 22000],
            ['name' => 'Bétera',                    'lat' => 39.5878, 'lng' => -0.4611, 'population' => 22000],
            ['name' => 'Riba-roja de Túria',        'lat' => 39.5317, 'lng' => -0.5483, 'population' => 20000],
            ['name' => "L'Eliana",                  'lat' => 39.5633, 'lng' => -0.5244, 'population' => 18000],
            ['name' => 'La Pobla de Vallbona',      'lat' => 39.5764, 'lng' => -0.5489, 'population' => 20000],
            ['name' => 'Benaguasil',                'lat' => 39.5861, 'lng' => -0.5750, 'population' => 11000],
            ['name' => 'Vilamarxant',               'lat' => 39.5606, 'lng' => -0.5989, 'population' => 8500],
            ['name' => 'Marines',                   'lat' => 39.6578, 'lng' => -0.4975, 'population' => 1200],
            ['name' => 'Nàquera',                   'lat' => 39.6489, 'lng' => -0.4553, 'population' => 3500],
            ['name' => 'Serra',                     'lat' => 39.6883, 'lng' => -0.4197, 'population' => 3200],
            ['name' => 'Olocau',                    'lat' => 39.6792, 'lng' => -0.5006, 'population' => 1100],
            ['name' => 'Gátova',                    'lat' => 39.7114, 'lng' => -0.5086, 'population' => 480],
            ['name' => 'Casinos',                   'lat' => 39.7256, 'lng' => -0.6228, 'population' => 2800],
            ['name' => 'Pedralba',                  'lat' => 39.5919, 'lng' => -0.6769, 'population' => 2800],
            ['name' => 'Gestalgar',                 'lat' => 39.5692, 'lng' => -0.7481, 'population' => 650],
            ['name' => 'Chulilla',                  'lat' => 39.6556, 'lng' => -0.8031, 'population' => 620],
            ['name' => 'Calles',                    'lat' => 39.6603, 'lng' => -0.8472, 'population' => 340],
            ['name' => 'Chelva',                    'lat' => 39.7508, 'lng' => -0.9803, 'population' => 1800],
            ['name' => 'Tuéjar',                    'lat' => 39.7397, 'lng' => -1.0678, 'population' => 850],
            ['name' => 'Titaguas',                  'lat' => 39.8167, 'lng' => -1.0778, 'population' => 480],
            ['name' => 'Alpuente',                  'lat' => 39.9069, 'lng' => -1.0086, 'population' => 650],
            ['name' => 'La Yesa',                   'lat' => 39.8706, 'lng' => -0.9603, 'population' => 260],
            ['name' => 'Aras de los Olmos',         'lat' => 39.9278, 'lng' => -1.0811, 'population' => 650],
            ['name' => 'Vallanca',                  'lat' => 39.9642, 'lng' => -1.1178, 'population' => 230],
            ['name' => 'Benagéber',                 'lat' => 39.7819, 'lng' => -0.9608, 'population' => 220],
            ['name' => 'Sant Antoni de Benaixeve',  'lat' => 39.5544, 'lng' => -0.5094, 'population' => 8000],
        ];

        foreach ($municipalities as $m) {
            $slug = Str::slug($m['name']);

            // Insertar si no existe
            $existing = DB::table('municipalities')->where('slug', $slug)->first();

            if (!$existing) {
                DB::table('municipalities')->insert([
                    'province_id' => $valenciaId,
                    'comarca_id'  => $campDeTuriaId,
                    'name'        => $m['name'],
                    'slug'        => $slug,
                    'lat'         => $m['lat'],
                    'lng'         => $m['lng'],
                    'population'  => $m['population'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            } else {
                // Si ya existe, asignarle la comarca
                DB::table('municipalities')
                    ->where('slug', $slug)
                    ->update(['comarca_id' => $campDeTuriaId, 'updated_at' => now()]);
            }
        }
    }
}

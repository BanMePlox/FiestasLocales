<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MunicipalitySeeder extends Seeder
{
    public function run(): void
    {
        $municipalities = [
            // Valencia (province_id = 1)
            ['province' => 'Valencia', 'name' => 'Valencia', 'lat' => 39.4699, 'lng' => -0.3763, 'population' => 800000],
            ['province' => 'Valencia', 'name' => 'Torrent', 'lat' => 39.4384, 'lng' => -0.4659, 'population' => 84000],
            ['province' => 'Valencia', 'name' => 'Gandia', 'lat' => 38.9681, 'lng' => -0.1833, 'population' => 73000],
            ['province' => 'Valencia', 'name' => 'Paterna', 'lat' => 39.5033, 'lng' => -0.4411, 'population' => 70000],
            ['province' => 'Valencia', 'name' => 'Sagunto', 'lat' => 39.6800, 'lng' => -0.2742, 'population' => 66000],
            ['province' => 'Valencia', 'name' => 'Mislata', 'lat' => 39.4731, 'lng' => -0.4067, 'population' => 44000],
            ['province' => 'Valencia', 'name' => 'Burjassot', 'lat' => 39.5097, 'lng' => -0.4094, 'population' => 37000],
            ['province' => 'Valencia', 'name' => 'Manises', 'lat' => 39.4885, 'lng' => -0.4557, 'population' => 30000],
            ['province' => 'Valencia', 'name' => 'Requena', 'lat' => 39.4887, 'lng' => -1.0994, 'population' => 20000],
            ['province' => 'Valencia', 'name' => 'Ontinyent', 'lat' => 38.8228, 'lng' => -0.6063, 'population' => 36000],
            ['province' => 'Valencia', 'name' => 'Xàtiva', 'lat' => 38.9889, 'lng' => -0.5194, 'population' => 29000],
            ['province' => 'Valencia', 'name' => 'Alzira', 'lat' => 39.1514, 'lng' => -0.4324, 'population' => 44000],
            ['province' => 'Valencia', 'name' => 'Sueca', 'lat' => 39.2025, 'lng' => -0.3372, 'population' => 26000],
            ['province' => 'Valencia', 'name' => 'Catarroja', 'lat' => 39.4017, 'lng' => -0.4011, 'population' => 28000],
            ['province' => 'Valencia', 'name' => 'Aldaia', 'lat' => 39.4628, 'lng' => -0.4597, 'population' => 32000],
            ['province' => 'Valencia', 'name' => 'Bétera', 'lat' => 39.5878, 'lng' => -0.4611, 'population' => 22000],
            ['province' => 'Valencia', 'name' => 'Llíria', 'lat' => 39.6281, 'lng' => -0.5975, 'population' => 22000],
            ['province' => 'Valencia', 'name' => 'Buñol', 'lat' => 39.4183, 'lng' => -0.7872, 'population' => 9800],
            ['province' => 'Valencia', 'name' => 'Cullera', 'lat' => 39.1628, 'lng' => -0.2517, 'population' => 22000],
            ['province' => 'Valencia', 'name' => 'Dénia', 'lat' => 38.8408, 'lng' => 0.1067, 'population' => 42000],
            ['province' => 'Valencia', 'name' => 'Oliva', 'lat' => 38.9175, 'lng' => -0.1178, 'population' => 23000],
            ['province' => 'Valencia', 'name' => 'Tavernes de la Valldigna', 'lat' => 39.0764, 'lng' => -0.2778, 'population' => 17000],
            ['province' => 'Valencia', 'name' => 'Puçol', 'lat' => 39.6058, 'lng' => -0.3083, 'population' => 19000],
            ['province' => 'Valencia', 'name' => 'Massamagrell', 'lat' => 39.5558, 'lng' => -0.3286, 'population' => 16000],
            ['province' => 'Valencia', 'name' => 'Sedaví', 'lat' => 39.4217, 'lng' => -0.3800, 'population' => 9500],
            ['province' => 'Valencia', 'name' => 'Paiporta', 'lat' => 39.4281, 'lng' => -0.4156, 'population' => 26000],
            ['province' => 'Valencia', 'name' => 'Picassent', 'lat' => 39.3611, 'lng' => -0.4628, 'population' => 20000],
            ['province' => 'Valencia', 'name' => 'Silla', 'lat' => 39.3597, 'lng' => -0.4153, 'population' => 19000],
            ['province' => 'Valencia', 'name' => 'Carlet', 'lat' => 39.2317, 'lng' => -0.5175, 'population' => 14000],
            ['province' => 'Valencia', 'name' => 'Algemesí', 'lat' => 39.1881, 'lng' => -0.4358, 'population' => 25000],

            // Alicante (province_id = 2)
            ['province' => 'Alicante', 'name' => 'Alicante', 'lat' => 38.3452, 'lng' => -0.4815, 'population' => 330000],
            ['province' => 'Alicante', 'name' => 'Elche', 'lat' => 38.2669, 'lng' => -0.6983, 'population' => 235000],
            ['province' => 'Alicante', 'name' => 'Torrevieja', 'lat' => 37.9781, 'lng' => -0.6886, 'population' => 101000],
            ['province' => 'Alicante', 'name' => 'Benidorm', 'lat' => 38.5397, 'lng' => -0.1322, 'population' => 73000],
            ['province' => 'Alicante', 'name' => 'Orihuela', 'lat' => 37.9667, 'lng' => -0.9333, 'population' => 82000],
            ['province' => 'Alicante', 'name' => 'Alcoy', 'lat' => 38.6964, 'lng' => -0.4739, 'population' => 60000],
            ['province' => 'Alicante', 'name' => 'Villena', 'lat' => 38.6336, 'lng' => -0.8661, 'population' => 34000],
            ['province' => 'Alicante', 'name' => 'Petrer', 'lat' => 38.4811, 'lng' => -0.7736, 'population' => 34000],
            ['province' => 'Alicante', 'name' => 'San Vicente del Raspeig', 'lat' => 38.3981, 'lng' => -0.5214, 'population' => 55000],
            ['province' => 'Alicante', 'name' => 'Elda', 'lat' => 38.4806, 'lng' => -0.7947, 'population' => 54000],
            ['province' => 'Alicante', 'name' => 'Mutxamel', 'lat' => 38.4211, 'lng' => -0.4569, 'population' => 21000],
            ['province' => 'Alicante', 'name' => 'Santa Pola', 'lat' => 38.1875, 'lng' => -0.5597, 'population' => 32000],
            ['province' => 'Alicante', 'name' => 'Calpe', 'lat' => 38.6444, 'lng' => 0.0444, 'population' => 22000],
            ['province' => 'Alicante', 'name' => 'Altea', 'lat' => 38.5983, 'lng' => -0.0508, 'population' => 22000],
            ['province' => 'Alicante', 'name' => 'Guardamar del Segura', 'lat' => 38.0928, 'lng' => -0.6558, 'population' => 18000],
            ['province' => 'Alicante', 'name' => 'Novelda', 'lat' => 38.3847, 'lng' => -0.7661, 'population' => 26000],
            ['province' => 'Alicante', 'name' => 'Ibi', 'lat' => 38.6261, 'lng' => -0.5681, 'population' => 23000],
            ['province' => 'Alicante', 'name' => 'Sax', 'lat' => 38.5392, 'lng' => -0.8161, 'population' => 11000],
            ['province' => 'Alicante', 'name' => 'Xàbia', 'lat' => 38.7919, 'lng' => 0.1653, 'population' => 33000],
            ['province' => 'Alicante', 'name' => 'Crevillent', 'lat' => 38.2456, 'lng' => -0.8119, 'population' => 28000],

            // Castellón (province_id = 3)
            ['province' => 'Castellón', 'name' => 'Castellón de la Plana', 'lat' => 39.9864, 'lng' => -0.0513, 'population' => 170000],
            ['province' => 'Castellón', 'name' => 'Vila-real', 'lat' => 39.9358, 'lng' => -0.1003, 'population' => 50000],
            ['province' => 'Castellón', 'name' => 'Burriana', 'lat' => 39.8886, 'lng' => -0.0878, 'population' => 34000],
            ['province' => 'Castellón', 'name' => 'Benicàssim', 'lat' => 40.0561, 'lng' => 0.0625, 'population' => 17000],
            ['province' => 'Castellón', 'name' => 'Peñíscola', 'lat' => 40.3581, 'lng' => 0.3994, 'population' => 7800],
            ['province' => 'Castellón', 'name' => 'Vinaròs', 'lat' => 40.4736, 'lng' => 0.4739, 'population' => 28000],
            ['province' => 'Castellón', 'name' => 'Almassora', 'lat' => 39.9533, 'lng' => -0.0706, 'population' => 26000],
            ['province' => 'Castellón', 'name' => 'Onda', 'lat' => 39.9672, 'lng' => -0.2694, 'population' => 25000],
            ['province' => 'Castellón', 'name' => 'Nules', 'lat' => 39.8586, 'lng' => -0.1531, 'population' => 13000],
            ['province' => 'Castellón', 'name' => 'Segorbe', 'lat' => 39.8528, 'lng' => -0.4900, 'population' => 9000],
            ['province' => 'Castellón', 'name' => 'Morella', 'lat' => 40.6178, 'lng' => -0.0950, 'population' => 2500],
            ['province' => 'Castellón', 'name' => 'Alcalà de Xivert', 'lat' => 40.2856, 'lng' => 0.2261, 'population' => 5000],
            ['province' => 'Castellón', 'name' => 'Traiguera', 'lat' => 40.5386, 'lng' => 0.3472, 'population' => 1800],
            ['province' => 'Castellón', 'name' => 'Cabanes', 'lat' => 40.1489, 'lng' => 0.1011, 'population' => 2400],
            ['province' => 'Castellón', 'name' => 'Llucena', 'lat' => 40.1100, 'lng' => -0.3281, 'population' => 1100],
        ];

        $provinceIds = DB::table('provinces')->pluck('id', 'name');

        foreach ($municipalities as $municipality) {
            $provinceName = $municipality['province'];
            $provinceId = $provinceIds[$provinceName] ?? null;

            if (!$provinceId) {
                continue;
            }

            $slug = Str::slug($municipality['name']);
            $originalSlug = $slug;
            $counter = 1;

            while (DB::table('municipalities')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            DB::table('municipalities')->insertOrIgnore([
                'province_id' => $provinceId,
                'name'        => $municipality['name'],
                'slug'        => $slug,
                'lat'         => $municipality['lat'],
                'lng'         => $municipality['lng'],
                'population'  => $municipality['population'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}

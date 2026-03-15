<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            ['name' => 'Valencia', 'slug' => 'valencia', 'code' => '46'],
            ['name' => 'Alicante', 'slug' => 'alicante', 'code' => '03'],
            ['name' => 'Castellón', 'slug' => 'castellon', 'code' => '12'],
        ];

        foreach ($provinces as $province) {
            DB::table('provinces')->insertOrIgnore(array_merge($province, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

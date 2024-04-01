<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eastern Cape, Free State, Gauteng, Kwa-Zulu Natal, Limpopo, Mpumalanga, Northern Cape, North West, Western Cape
        $provinces = [
            'Eastern Cape',
            'Free State',
            'Gauteng',
            'Kwa-Zulu Natal',
            'Limpopo',
            'Mpumalanga',
            'Northern Cape',
            'North West',
            'Western Cape',
        ];

        foreach($provinces as $province) {
            DB::table('provinces')->insert([
                'name' => $province
            ]);
        }
    }
}

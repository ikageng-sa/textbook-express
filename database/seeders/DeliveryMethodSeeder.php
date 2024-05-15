<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DeliveryMethod::create([
            'method' => 'Delivery',
            'description' => 'Deliver to my house',
            'cost' => 90.00
        ]);

    }
}

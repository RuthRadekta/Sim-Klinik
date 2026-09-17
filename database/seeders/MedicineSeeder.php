<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        Medicine::create(['name' => 'Paracetamol 500mg', 'price' => 5000, 'stock' => 100]);
        Medicine::create(['name' => 'Amoxicillin 500mg', 'price' => 15000, 'stock' => 50]);
        Medicine::create(['name' => 'Ibuprofen 400mg', 'price' => 8000, 'stock' => 75]);
        Medicine::create(['name' => 'Vitamin C', 'price' => 10000, 'stock' => 200]);
    }
}
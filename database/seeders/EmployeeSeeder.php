<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::create(['name' => 'Siti Aisyah', 'position' => 'Perawat', 'phone' => '08123456789', 'address' => 'Jl. Merdeka No 10']);
        Employee::create(['name' => 'Ahmad Fauzi', 'position' => 'Apoteker', 'phone' => '08987654321', 'address' => 'Jl. Sudirman No 5']);
        Employee::create(['name' => 'Budi Santoso', 'position' => 'Cleaning Service', 'phone' => '08555555555', 'address' => 'Jl. Veteran No 1']);
    }
}
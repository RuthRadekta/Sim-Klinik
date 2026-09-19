<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
        $kodeWilayah = $this->faker->numerify('3273##');
        $tanggalLahir = $this->faker->dateTimeBetween('-40 years', '-18 years');
        $day = (int) $tanggalLahir->format('d');
        $month = $tanggalLahir->format('m');
        $year = $tanggalLahir->format('y');
        $formatDay = str_pad((string) $day, 2, '0', STR_PAD_LEFT);
        $formatDate = $formatDay . $month . $year;
        $nomorUrut = $this->faker->numerify('####');
        $nik = $kodeWilayah . $formatDate . $nomorUrut;

        return [
            'nik' => $nik,
            'name' => $this->faker->name(),
            'dob' => $this->faker->date('Y-m-d', '2005-01-01'),
            'address' => $this->faker->address(),
            'allergy_history' => $this->faker->randomElement([
                'Tidak ada',
                'Tidak ada',
                'Tidak ada',
                'Obat (Penisilin/Amoxicillin)',
                'Makanan (Seafood)',
                'Makanan (Kacang-kacangan)',
                'Debu dan Cuaca Dingin',
                'Bulu Kucing/Hewan'
            ]),
        ];
    }
}

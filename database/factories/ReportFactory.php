<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_laporan' => $this->faker->name,
            'jenis_laporan' => $this->faker->randomElement(['kehilangan', 'menemukan']),
            'lokasi_laporan' => $this->faker->address,
            'deskripsi_laporan' => $this->faker->text,
            'tanggal_laporan' => $this->faker->date,
            'waktu_laporan' => $this->faker->time,
            'foto_laporan' => $this->faker->image('public/storage/reports', 640, 480, null, false),
        ];
    }
}

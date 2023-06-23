<?php

namespace Database\Factories;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrafficFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $mulai_pelayanan = $this->faker->time('H:i:s');

        $duration = $this->faker->numberBetween(5, 30);
        $selesai_pelayanan = Carbon::parse($mulai_pelayanan)->addMinutes($duration);

        $durasi_pelayanan = CarbonInterval::minutes($duration)->cascade()->format('%H:%I:%S');

        $month = Carbon::now()->month;

        $startDate = Carbon::create(null, $month, $this->faker->numberBetween(1, 30));
        $createdAt = $startDate->setTimeFromTimeString($mulai_pelayanan);

        return [
            'mulai_pelayanan' => $mulai_pelayanan,
            'selesai_pelayanan' => $selesai_pelayanan,
            'durasi_pelayanan' => $durasi_pelayanan,
            'created_at' => $createdAt,
        ];
    }
}

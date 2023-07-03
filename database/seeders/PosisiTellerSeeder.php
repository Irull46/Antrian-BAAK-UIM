<?php

namespace Database\Seeders;

use App\Models\PosisiTeller;
use Illuminate\Database\Seeder;

class PosisiTellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PosisiTeller::create([
            'user_id' => '2', // Id User
            'bagian' => 'A', // BAAK
            'posisi' => '1', // Posisi Teller
        ]);

        PosisiTeller::create([
            'user_id' => '3', // Id User
            'bagian' => 'B', //BAUK
            'posisi' => '2', // Posisi Teller
        ]);
    }
}

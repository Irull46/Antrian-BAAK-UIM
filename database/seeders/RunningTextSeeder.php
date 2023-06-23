<?php

namespace Database\Seeders;

use App\Models\RunningText;
use Illuminate\Database\Seeder;

class RunningTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RunningText::create([
            'content' => 'Selamat datang di BAAK Universitas Islam Madura • Kami siap membantu Anda dalam proses administrasi akademik • Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan',
            'order' => 1,
        ]);
    }
}

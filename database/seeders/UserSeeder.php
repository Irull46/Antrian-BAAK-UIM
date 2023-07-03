<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@uim.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('>#admin\&!.%')
        ]);
        $user->assignRole('admin');

        // BAAK
        $user = User::create([
            'name' => 'BAAK',
            'email' => 'baak@uim.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('$@baak*#1/%.')
        ]);
        $user->assignRole('teller');
        
        // BAUK
        $user = User::create([
            'name' => 'BAUK',
            'email' => 'bauk@uim.ac.id',
            'email_verified_at' => now(),
            'password' => Hash::make('$@bauk*#2/!.')
        ]);
        $user->assignRole('teller');
    }
}

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
        User::create([
            'name' => 'Sofia Luna',
            'email' => 'sofia@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Adela Torres',
            'email' => 'adela@gmail.com',
            'password' => Hash::make('password'),
        ])->assignRole('arrendador');
        
        User::factory()
            ->count(3)
            ->create()
            ->each(function($user){
                $user->assignRole('arrendador');
            });
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::role('arrendador')
            ->get()
            ->each(function($user){
                Contract::factory()->count(1)->create([
                    'user_id' => $user->id,
                    'property_id' => $user->properties()->first()->id,
                ]);
            });
    }
}

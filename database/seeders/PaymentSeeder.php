<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contract::all()->each(function($contract){
            $contract->payments()->create([
                'payment_type_id' => 1,
                'amount' => rand(1000, 10000)
            ]);
            $contract->payments()->create([
                'payment_type_id' => rand(2,3),
                'amount' => rand(1000, 10000)
            ]);
        });
    }
}

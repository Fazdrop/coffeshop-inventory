<?php

namespace Database\Seeders;

use App\Models\CashFlow;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InitialBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CashFlow::create([
            'type' => 'income',
            'amount' => 1000000,
            'description' => 'Modal Awal Warkop',
            'current_balance' => 1000000,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $units = ['pcs', 'botol','galon','liter', 'kg', 'bungkus'];
        foreach($units as $unit){
            Unit::create(['name' => $unit]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fare_discounts')->insert([
            'title'=>'Student Discount',
            'discount'=>'15',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('fare_discounts')->insert([
            'title'=>'Senior Citizen Discount',
            'discount'=>'15',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

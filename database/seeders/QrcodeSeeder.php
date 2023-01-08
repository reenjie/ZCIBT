<?php

namespace Database\Seeders;
use App\Models\Qrcode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QrcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qrcode::create([
            'file'=>'1673156311.png',
            'bus_id'=>0
        ]);
    }
}

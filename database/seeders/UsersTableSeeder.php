<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname'=>'zc',
            'middlename'=>'ibt',
            'lastname'=>'admin',
            'birthdate'=>now(),
            'user_type'=>0,
            'license_no'=>null,
            'address'=>'',
            'contact_no'=>'',
            'fl'=>0,
            'vrfy'=>1,
            'status'=>0,
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

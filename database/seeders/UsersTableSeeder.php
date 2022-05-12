<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //
        DB::table('users')->insert([
            'first_name'=>'Baraka',
            'last_name'=>'Urio',
            'username'=>'baraka',
            'password'=>Hash::make('LoginPass123'),
            'email'=>'baraka@aimfirms.com',
            'phone_number'=>'255624327900',
            'role'=>'Administrator',
            // 'company_id'=>'2022',
            'isSemaAdmin'=>false,
        ]);
    }
}

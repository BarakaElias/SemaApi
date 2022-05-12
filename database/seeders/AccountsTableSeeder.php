<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('accounts')->insert([
            'email'=>'demo@sema.co.tz',
            'password'=>Hash::make('ForDemoClient123')
        ]);

        DB::table('accounts')->insert([
            'email'=>'directors@licksthepharmacy.co.tz',
            'password'=>Hash::make('Licks@2021!')
        ]);
    }
}

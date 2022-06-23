<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ApikeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('apikeys')->insert([
            'account_id'=>'1',
            'api_secrets'=>"{sms:{api_id:'API3462965997',api_password:'ForDemoClient123'},ussd:{api_id:'API12345678',api_password:'ForDemoClient'}}"
        ]);
    }
}

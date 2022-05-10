<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SenderIdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sms_sender_ids')->insert([
            'id'=>'1',
            'country'=>'Tanzania',
            'name'=>'Sema',
            'status'=>'Active',
            'registered_networks'=>'not that many',
            // 'created_at'=>'1651671759',
            'user'=>'isaac@aimfirms.com',
            'actions'=>'view,edit,delete',
        ]);
    }
}

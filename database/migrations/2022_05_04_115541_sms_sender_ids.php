<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SmsSenderIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sms_sender_ids', function(Blueprint $table){
            $table->id();
            $table->string("country");
            $table->string("name");
            $table->enum("status",['Active','Inactive']);
            $table->string("registered_networks");
            $table->timestamps();
            $table->string("user");
            $table->string("actions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('sms_sender_ids');
    }
}

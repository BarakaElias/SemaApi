<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisteredNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_networks', function (Blueprint $table) {
            $table->id();
            $table->string('network');
            $table->string('registerer');
            $table->string('status');
            $table->unsignedBigInteger('sms_sender_id_id')->nullable();
            $table->foreign('sms_sender_id_id')->references('id')->on('sms_sender_ids');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registered_networks');
    }
}

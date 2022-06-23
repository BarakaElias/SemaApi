<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccountTableToContainUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('accounts', function (Blueprint $table) {
        //     $table->unsignedBigInteger('user')->nullable();
        //     $table->foreign('user')->references('id')->on('user'); 
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contain_user', function (Blueprint $table) {
            //
        });
    }
}

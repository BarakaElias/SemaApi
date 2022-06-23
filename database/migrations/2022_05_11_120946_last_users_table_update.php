<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LastUsersTableUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('first_name');
        //     $table->string('last_name');
        //     $table->string('username');
        //     $table->string('phone_number');
        //     $table->string('role');
        //     $table->boolean('isSemaAdmin')->default(0);
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->unsignedBigInteger('account_id')->nullable();
        //     $table->unsignedBigInteger('apikeys_id')->nullable();
        //     $table->string('status')->default('Inactive');
        //     $table->rememberToken();
        //     $table->timestamps();
        //     $table->foreign('account_id')->references('id')->on('accounts');
        //     $table->foreign('apikeys_id')->references('id')->on('apikey');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

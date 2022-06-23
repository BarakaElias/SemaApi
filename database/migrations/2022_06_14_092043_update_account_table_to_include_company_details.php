<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccountTableToIncludeCompanyDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            //
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('support_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('incorporation_certificate')->nullable();
            $table->string('business_license')->nullable();
            $table->string('tin_vrn_certificate')->nullable();
            $table->string('directors_nida')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            //
        });
    }
}

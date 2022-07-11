<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPasswordUserColumnsFromAccountsTableForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts_table_foreign_keys', function (Blueprint $table) {
            //
            $table->dropForeign(['password','user']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts_table_foreign_keys', function (Blueprint $table) {
            //
        });
    }
}

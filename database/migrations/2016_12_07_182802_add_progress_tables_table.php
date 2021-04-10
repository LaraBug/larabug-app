<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProgressTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('total_logins')->after('google2fa_secret')->default(0);
        });

        Schema::table('statistics', function (Blueprint $table) {
            $table->integer('total_fixed_exceptions')->after('total_exceptions')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('total_logins');
        });

        Schema::table('statistics', function ($table) {
            $table->dropColumn('total_fixed_exceptions');
        });
    }
}

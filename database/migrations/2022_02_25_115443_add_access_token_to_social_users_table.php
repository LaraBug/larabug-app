<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccessTokenToSocialUsersTable extends Migration
{
    public function up()
    {
        Schema::table('social_users', function (Blueprint $table) {
            $table->text('access_token')->after('provider_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('social_users', function (Blueprint $table) {
            $table->dropColumn('access_token');
        });
    }
}
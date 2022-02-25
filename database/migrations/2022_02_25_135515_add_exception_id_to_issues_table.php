<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExceptionIdToIssuesTable extends Migration
{
    public function up()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->uuid('exception_id')->nullable()->after('project_id');
        });
    }

    public function down()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn('exception_id');
        });
    }
}
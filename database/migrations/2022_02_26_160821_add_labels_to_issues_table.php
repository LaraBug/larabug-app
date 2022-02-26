<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabelsToIssuesTable extends Migration
{
    public function up()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->json('labels')->after('github_issue_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn('labels');
        });
    }
}
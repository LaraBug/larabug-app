<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGithubIssueUrlToIssuesTable extends Migration
{
    public function up()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->integer('github_issue_id')->after('project_id')->nullable();
            $table->string('github_issue_url')->after('project_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropColumn('github_issue_id');
            $table->dropColumn('github_issue_url');
        });
    }
}
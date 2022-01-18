<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGithubRepoToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('report_to_github_issues')->after('custom_webhook_enabled')->default(false);
            $table->string('github_repo')->after('custom_webhook')->nullable();
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('report_to_github_issues');
            $table->dropColumn('github_repo');
        });
    }
}
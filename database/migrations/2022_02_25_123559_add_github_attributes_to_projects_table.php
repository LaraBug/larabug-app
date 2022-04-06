<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGithubAttributesToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->bigInteger('github_repo_id')->after('user_id')->nullable();
            $table->bigInteger('github_webhook_id')->after('github_repo_id')->nullable();
            $table->boolean('github_issues_enabled')->default(0)->after('custom_webhook_enabled');
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'github_repo_id',
                'github_webhook_id',
                'github_issues_enabled',
            ]);
        });
    }
}
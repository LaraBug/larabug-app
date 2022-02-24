<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->uuid('id');

            $table->string('exception');
            $table->string('status');
            $table->uuid('project_id');
            $table->string('github_issue_url')->nullable();
            $table->integer('github_issue_id')->nullable();
            $table->integer('assigned_to')->nullable();

            $table->timestamp('last_exception_at')->nullable();
            $table->timestamps();

            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
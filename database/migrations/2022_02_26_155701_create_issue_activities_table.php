<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('issue_activities', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->uuid('issue_id');
            $table->text('content')->nullable();
            $table->string('caused_by')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('issue_activities');
    }
}
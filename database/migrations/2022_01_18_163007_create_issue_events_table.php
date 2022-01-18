<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueEventsTable extends Migration
{
    public function up()
    {
        Schema::create('issue_events', function (Blueprint $table) {
            $table->uuid('id');

            //
            $table->uuid('issue_id');
            $table->string('action');
            $table->text('content');
            $table->string('causer');

            $table->timestamps();

            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('issue_events');
    }
}
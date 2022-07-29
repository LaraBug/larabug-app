<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('exception');
            $table->string('line');
            $table->uuid('project_id');
            $table->uuid('exception_id');
            $table->string('status')->nullable();
            $table->json('tags')->nullable();
            $table->timestamp('last_occurred_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
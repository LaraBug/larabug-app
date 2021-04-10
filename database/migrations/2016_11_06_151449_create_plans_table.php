<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->index()->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->boolean('default')->default(false);
            $table->decimal('price', 10, 4)->default(0);

            $table->integer('max_emails')->default(0);
            $table->integer('max_projects')->default(0);
            $table->integer('max_retention_in_days')->default(0);
            $table->integer('max_exceptions_per_minute')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}

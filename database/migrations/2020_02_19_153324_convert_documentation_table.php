<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertDocumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('documentations');

        Schema::create('documentations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->index()->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('default')->default(false);
            $table->integer('order_column')->default(0);
            $table->integer('documentation_category_id')->unsigned()->nullable();
            $table->foreign('documentation_category_id')->references('id')->on('documentation_categories');

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
        //
    }
}

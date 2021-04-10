<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentation_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->index()->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::table('documentations', function (Blueprint $table) {
            $table->integer('documentation_category_id')->after('order_column')->unsigned()->nullable();
            $table->foreign('documentation_category_id')->references('id')->on('documentation_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentation_categories');

        Schema::table('documentations', function (Blueprint $table) {
            $table->dropColumn('documentation_category_id');
        });
    }
}

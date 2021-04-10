<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddPublishedFieldsToExceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exceptions', function ($table) {
            $table->timestamp('published_at')->after('project_id')->nullable();
            $table->string('publish_hash', 15)->index()->after('project_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exceptions', function ($table) {
            $table->dropColumn('published_at');
            $table->dropColumn('publish_hash');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('exceptions', function (Blueprint $table) {
            $table->uuid('issue_id')->after('project_id')->nullable();
        });
    }
};
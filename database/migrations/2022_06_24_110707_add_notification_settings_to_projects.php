<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('issue_receive_email')->default(false);
            $table->boolean('issue_mobile_notifications_enabled')->default(false);
            $table->boolean('issue_slack_webhook_enabled')->default(false);
            $table->boolean('issue_discord_webhook_enabled')->default(false);
            $table->boolean('issue_custom_webhook_enabled')->default(false);
            $table->string('issue_slack_webhook')->nullable();
            $table->string('issue_discord_webhook')->nullable();
            $table->string('issue_custom_webhook')->nullable();
        });
    }
};
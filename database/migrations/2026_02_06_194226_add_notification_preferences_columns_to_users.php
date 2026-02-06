<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notify_new_events')->default(true);
            $table->boolean('notify_weekly_digest')->default(true);
            $table->boolean('notify_trending')->default(false);
            $table->string('notification_frequency')->default('instant');
            $table->json('notification_channels')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['notify_new_events', 'notify_weekly_digest',
                 'notify_trending', 'notification_frequency',
                 'notification_channels']);
        });
    }
};

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
        Schema::table('events', function(Blueprint $table){
            $table->dropColumn('type');
            $table->timestamp('created_at')->after('allow_refunds_after_start')->nullable()->change();
            $table->timestamp('updated_at')->after('created_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function(Blueprint $table){
            $table->timestamp('created_at')->after('organizer_id')->nullable()->change();
            $table->timestamp('updated_at')->after('created_at')->nullable()->change();
            $table->tinyInteger('type')->after('allow_refunds_after_start');
        });
    }
};

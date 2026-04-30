<?php

use App\Enums\Event\EventStatusEnum;
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
            $table->dropColumn(['is_free', 'is_published', 'is_virtual']);
            $table->tinyInteger('type');
            $table->integer('status')->default(EventStatusEnum::DRAFT)->change();
            $table->integer('refund_policy')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function(Blueprint $table){
            $table->dropColumn(['type']);
            $table->boolean('is_free')->default(false);
            $table->boolean('is_virtual')->default(false);
            $table->boolean('is_published')->default(false);
            $table->string('status')->default('draft')->change();
            $table->enum('refund_policy', ['FULL_REFUND_BEFORE','PARTIAL_REFUND_BEFORE','CASE_BY_CASE'])->default('FULL_REFUND_BEFORE')->change();
        });
    }
};

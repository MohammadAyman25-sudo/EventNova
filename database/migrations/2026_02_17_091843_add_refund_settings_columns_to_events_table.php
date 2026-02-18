<?php

use App\Enums\Event\EventRefundPolicyEnum;
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
        Schema::table('events', function (Blueprint $table) {
            $table->enum('refund_policy', EventRefundPolicyEnum::toArray())->default(EventRefundPolicyEnum::FULL_REFUND_BEFORE->value);
            $table->integer('refund_days_before')->nullable()->default(14);
            $table->integer('refund_percentage')->default(100);
            $table->boolean('allow_refunds_after_start')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['refund_policy', 'refund_days_before', 'refund_percentage', 'allow_refunds_after_start']);
        });
    }
};

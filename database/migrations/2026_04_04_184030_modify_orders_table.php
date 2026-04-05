<?php

use App\Enums\Order\OrderStatusEnum;
use App\Enums\Payment\PaymentMethodEnum;
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
        Schema::table('orders', function(Blueprint $table){
            $table->dropConstrainedForeignId('event_id');
            $table->dropColumn(['order_number', 'discount_amount', 'currency', 'paid_at', 'customer_details']);
            $table->integer('status')->default(OrderStatusEnum::PENDING)->change();
            $table->decimal('total_amount', 10, 3)->default(0)->change();
            $table->integer('payment_methods')->default(PaymentMethodEnum::VISA);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function(Blueprint $table){
            $table->dropColumn(['payment_methods']);
            $table->string('status')->default('pending')->change();
            $table->string('order_number')->unique();
            $table->foreignId('event_id')->constrained('events', 'id')->cascadeOnDelete();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->change();
            $table->string('currency', 3)->default('USD');
            $table->dateTime('paid_at')->nullable();
            $table->json('customer_details')->nullable();
        });
    }
};

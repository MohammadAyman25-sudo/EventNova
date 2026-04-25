<?php

use App\Enums\Payment\PaymentStatusEnum;
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
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'currency']);
            $table->integer('gateway')->change();
            $table->decimal('amount', 10, 3)->change();
            $table->integer('status')->default(PaymentStatusEnum::PENDING)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->decimal('amount', 10, 2)->change();
            $table->string('transaction_id')->nullable();
            $table->string('currency');
            $table->string('gateway')->change();
            $table->string('status')->default('pending')->nullable()->change();
        });
    }
};

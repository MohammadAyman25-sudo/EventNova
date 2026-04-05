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
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('price_at_purchase', 10, 3)->default(0)->change();
            $table->decimal('discount_amount', 10, 3)->default(0);
            $table->decimal('sub_total', 10, 3)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['discount_amount']);
            $table->decimal('price_at_purchase', 10, 2)->default(0)->change();
            $table->decimal('sub_total', 10, 2)->default(0)->change();
        });
    }
};

<?php

use App\Enums\Ticket\TicketStatusEnum;
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
        Schema::table('tickets', function(Blueprint $table){
            $table->dropColumn(['min_per_order', 'quantity_sold', 'is_hidden']);
            $table->decimal('price', 10, 3)->default(0)->change();
            $table->integer('status')->change();
            $table->renameColumn('quantity_total', 'quantity_available');
            $table->renameColumn('sale_start', 'sales_start');
            $table->renameColumn('sale_end', 'sales_end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function(Blueprint $table){
            $table->decimal('price', 10, 2)->change();
            $table->renameColumn('quantity_available', 'quantity_total');
            $table->enum('status', TicketStatusEnum::toArray())->default(TicketStatusEnum::PENDING)->change();
            $table->renameColumn('sales_start', 'sale_start');
            $table->renameColumn('sales_end', 'sale_end');
            $table->integer('quantity_sold')->default(0);
            $table->integer('min_per_order')->nullable();
            $table->boolean('is_hidden')->default(false);
        });
    }
};

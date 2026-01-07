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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->json('location')->nullable();
            $table->string('venue_name');
            $table->text('venue_address')->nullable();
            $table->string('online_link')->nullable();
            $table->integer('capacity');
            $table->string('banner_image');
            $table->boolean('is_published')->default(true);
            $table->boolean('is_virtual')->default(false);
            $table->boolean('is_free')->default(false);
            $table->string('status')->default(EventStatusEnum::DRAFT->value);
            $table->foreignId('organizer_id')->constrained('users', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

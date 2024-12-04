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
        Schema::create('renta_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table
              ->foreign('class_schedule_id')
              ->references('id')
              ->on('class_schedules');
            $table->datetime('start_time');
            $table->datetime('finish_time');
            $table->longText('comments')->nullable();
            $table->integer('is_active')->default(1);
              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renta_rooms');
    }
};

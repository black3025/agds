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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('course_id');
            $table
                ->foreign('course_id')
                ->references('id')
                ->on('courses');
            $table->unsignedBigInteger('category_id');
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->string('day_start');
            $table->string('day_end');
            $table->string('time_start');
            $table->string('time_end');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('class_schedule_id');
      $table
        ->foreign('class_schedule_id')
        ->references('id')
        ->on('class_schedules');
      $table->unsignedBigInteger('user_id');
      $table
        ->foreign('user_id')
        ->references('id')
        ->on('users');
      $table->longText('comments')->nullable();
      $table->integer('star_rating');
      $table->integer('is_private');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('reviews');
  }
};

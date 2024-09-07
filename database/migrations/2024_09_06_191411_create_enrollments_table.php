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
    Schema::create('enrollments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table
        ->foreign('user_id')
        ->references('id')
        ->on('users');
      $table->unsignedBigInteger('ClassSchedule_id');
      $table
        ->foreign('ClassSchedule_id')
        ->references('id')
        ->on('class_schedules');
      $table->string('referenceNo');
      $table->string('verified');
      $table->string('status');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('enrollments');
  }
};

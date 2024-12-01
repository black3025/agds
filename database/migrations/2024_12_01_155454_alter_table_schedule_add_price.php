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
    //
    Schema::table('class_schedules', function ($table) {
      $table->double('amount');
    });

    Schema::table('enrollments', function ($table) {
      $table->double('amount');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
    Schema::table('class_schedules', function ($table) {
      $table->dropColumn('amount');
    });
    Schema::table('enrollments', function ($table) {
      $table->dropColumn('amount');
    });
  }
};

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
    Schema::table('students', function ($table) {
      $table->boolean('is_active')->default(1);
    });

    Schema::table('teachers', function ($table) {
      $table->boolean('is_active')->default(1);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('students', function ($table) {
      $table->dropColumn('is_active');
    });
    Schema::table('teachers', function ($table) {
      $table->dropColumn('is_active');
    });
  }
};

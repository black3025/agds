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
        Schema::table('class_schedules', function ($table) {
            $table->integer('duration');
            $table->string('week');
            $table->dropColumn('day_end');
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function ($table) {
            $table->dropColumn('Duration');
            $table->dropColumn('week');
            $table->string('day_end');
          });
    }
};

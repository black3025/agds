<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(30)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
    DB::table('roles')->insert([
      'name' => 'Admin',
      'restriction' => '1',
    ]);
    DB::table('roles')->insert([
      'name' => 'Student',
      'restriction' => '2',
    ]);
    DB::table('roles')->insert([
      'name' => 'Trainer',
      'restriction' => '3',
    ]);
  }
}

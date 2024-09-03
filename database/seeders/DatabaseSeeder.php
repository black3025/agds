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

    DB::table('courses')->insert([
      'name' => 'Ballet',
      'description' =>
        'Ballet (French: [balɛ]) is a type of performance dance that originated during the Italian Renaissance in the fifteenth century and later developed into a concert dance form in France and Russia. It has since become a widespread and highly technical form',
    ]);

    DB::table('courses')->insert([
      'name' => 'KPOP',
      'description' => 'K-pop (Korean: 케이팝; RR: keipap), short for Korean popular music,',
    ]);

    DB::table('courses')->insert([
      'name' => 'Modern',
      'description' => 'K-pop (Korean: 케이팝; RR: keipap), short for Korean popular music',
    ]);

    DB::table('courses')->insert([
      'name' => 'Modeling',
      'description' => 'K-pop (Korean: 케이팝; RR: keipap), short for Korean popular music',
    ]);

    DB::table('courses')->insert([
      'name' => 'Voice',
      'description' =>
        'A model is an informative representation of an object, person or system. The term originally denoted the plans of a building in late 16th-century English, and derived via French and Italian ultimately from Latin modulus, a measure.',
    ]);

    DB::table('courses')->insert([
      'name' => 'Piano',
      'description' =>
        'The piano is a keyboard instrument that produces sound when its keys are depressed, through engagement of an action whose hammers strike strings. Modern pianos have a row of 88 black and white keys, tuned to a chromatic scale in equal temperament.',
    ]);

    DB::table('courses')->insert([
      'name' => 'Art',
      'description' =>
        'Art is a diverse range of human activity and its resulting product that involves creative or imaginative talent generally expressive of technical proficiency, beauty, emotional power, or conceptual ideas.[1][2][3]',
    ]);

    DB::table('categories')->insert([
      'name' => 'Toodlers',
    ]);
    DB::table('categories')->insert([
      'name' => 'Juniors',
    ]);
    DB::table('categories')->insert([
      'name' => 'Teens',
    ]);
    DB::table('categories')->insert([
      'name' => 'Adults',
    ]);
  }
}

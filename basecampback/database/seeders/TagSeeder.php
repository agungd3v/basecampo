<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('tags')->insert([
      'name' => 'Daily',
      'variant' => 'success',
      'created_at' => now(),
      'updated_at' => now()
    ]);
    DB::table('tags')->insert([
      'name' => 'Bug',
      'variant' => 'danger',
      'created_at' => now(),
      'updated_at' => now()
    ]);
    DB::table('tags')->insert([
      'name' => 'Priority',
      'variant' => 'danger',
      'created_at' => now(),
      'updated_at' => now()
    ]);
    DB::table('tags')->insert([
      'name' => 'Riview',
      'variant' => 'warning',
      'created_at' => now(),
      'updated_at' => now()
    ]);
    DB::table('tags')->insert([
      'name' => 'Big Project',
      'variant' => 'info',
      'created_at' => now(),
      'updated_at' => now()
    ]);
  }
}

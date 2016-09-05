<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Clean everything before populating
    DB::statement('set foreign_key_checks=0;');
    DB::table('cities')->truncate();

    // Initialize values
    $values = array(
      array('id' => 1, 'name' => 'Hà Nội', 'slug' => 'ha-noi'),
      array('id' => 2, 'name' => 'Hồ Chí Minh', 'slug' => 'ho-chi-minh'),
      array('id' => 3, 'name' => 'Đà Nẵng', 'slug' => 'da-nang')
    );

    // Mass insert to the cities table
    DB::table('cities')->insert($values);
  }
}

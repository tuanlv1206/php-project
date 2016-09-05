<?php

use Illuminate\Database\Seeder;

class DirectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Clean everything before populating
      DB::statement('set foreign_key_checks=0;');
      DB::table('directions')->truncate();

      // Initialize values
      $values = array(
        array('id' => 1, 'name' => 'Bắc', 'slug' => 'bac'),
        array('id' => 2, 'name' => 'Đông Bắc', 'slug' => 'dong-bac'),
        array('id' => 3, 'name' => 'Đông', 'slug' => 'dong'), 
        array('id' => 4, 'name' => 'Đông Nam', 'slug' => 'dong-nam'),
        array('id' => 5, 'name' => 'Nam', 'slug' => 'nam'),
        array('id' => 6, 'name' => 'Tây Nam', 'slug' => 'tay-nam'),
        array('id' => 7, 'name' => 'Tây', 'slug' => 'tay'),
        array('id' => 8, 'name' => 'Tây Bắc', 'slug' => 'tay-bac')
      );

      // Mass insert to the Directions table
      DB::table('directions')->insert($values);
    }
}

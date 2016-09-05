<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
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
      DB::table('images')->truncate();

      //Initialize values
      $values = array(
        array('name' => 'Fd207w8WIMEds3OInySD.jpg', 'house_id' => 1, 'updated_at' => '2016-1-1', 'created_at' => '2016-1-2'),
        array('name' => 'ci8ixW5vljeVZCR9VfVm.jpg', 'house_id' => 2, 'updated_at' => '2016-1-3', 'created_at' => '2016-1-5'),
      );

      // Mass insert to the Owners table
      DB::table('images')->insert($values);
    }
}

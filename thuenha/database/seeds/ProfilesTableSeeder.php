<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
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
      DB::table('profiles')->truncate();

      // Initialize values
      $values = array(
        array('id' => 1, 'name' => 'Ngô Thành Vinh', 'register_name' => 'Ngô Thành Vinh', 'email' => 'nanyangbk@gmail.com', 'mobile_phone' => '0968385438', 'district_id' => '1', 'facebook' => 'https://www.facebook.com/johnle1711', 'skype' => 'leewenjun30@gmail.com', 'avatar' => 'Image/Avatar/user1'),
        array('id' => 2, 'name' => 'Nguyễn Anh Quân', 'register_name' => 'Nguyễn Anh Quân', 'email' => 'quanchimbe@gmail.com', 'mobile_phone' => '0968385438', 'district_id' => '1', 'facebook' => 'https://www.facebook.com/johnle1711', 'skype' => 'leewenjun30@gmail.com', 'avatar' => 'Image/Avatar/user2'),
      );

      // Mass insert to the Profiles table
      DB::table('profiles')->insert($values);

    }
}

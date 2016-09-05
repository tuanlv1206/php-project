<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
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
    DB::table('types')->truncate();

    // Initialize values
    $values = array(
      array('id' => 1, 'name' => 'Cho thuê căn hộ chung cư', 'slug' => 'cho-thue-can-ho-chung-cu'),
      array('id' => 2, 'name' => 'Cho thuê nhà riêng', 'slug' => 'cho-thue-nha-rieng'),
      array('id' => 3, 'name' => 'Cho thuê nhà mặt phố', 'slug' => 'cho-thue-nha-mat-pho'),
      array('id' => 4, 'name' => 'Cho thuê nhà trọ, phòng trọ', 'slug' => 'cho-thue-nha-tro-phong-tro'),
      array('id' => 5, 'name' => 'Cho thuê văn phòng', 'slug' => 'cho-thue-van-phong'),
      array('id' => 6, 'name' => 'Cho thuê cửa hàng, ki ốt', 'slug' => 'cho-thue-cua-hang-ki-ot'),
      array('id' => 7, 'name' => 'Cho thuê nhà kho, nhà xưởng, đất', 'slug' => 'cho-thue-nha-kho-nha-xuong-dat'),
      array('id' => 8, 'name' => 'Cho thuê loại bất động sản khác', 'slug' => 'cho-thue-loai-bat-dong-san-khac')
    );

    // Mass insert to the types table
    DB::table('types')->insert($values);
  }
}

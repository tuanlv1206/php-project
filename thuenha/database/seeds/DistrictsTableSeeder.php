<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
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
    DB::table('districts')->truncate();

    // Initialize values
    // The id of districts in Ha Noi from 1 - 100, in Ho Chi Minh from 101 - 200, in Da Nang from 201 - 300 and so on.
    $values = array(
      array('id' => 1, 'name' => 'Ba Đình', 'slug' => 'ba-dinh', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 2, 'name' => 'Ba Vì', 'slug' => 'ba-vi', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 3, 'name' => 'Bắc Từ Liêm', 'slug' => 'bac-tu-liem', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 4, 'name' => 'Cầu Giấy', 'slug' => 'cau-giay', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 5, 'name' => 'Chương Mỹ', 'slug' => 'chuong-my', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 6, 'name' => 'Đan Phượng', 'slug' => 'dan-phuong', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 7, 'name' => 'Đông Anh', 'slug' => 'dong-anh', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 8, 'name' => 'Đống Đa', 'slug' => 'dong-da', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 9, 'name' => 'Gia Lâm', 'slug' => 'gia-lam', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 10, 'name' => 'Hà Đông', 'slug' => 'ha-dong', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 11, 'name' => 'Hai Bà Trưng', 'slug' => 'hai-ba-trung', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 12, 'name' => 'Hoài Đức', 'slug' => 'hoai-duc', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 13, 'name' => 'Hoàn Kiếm', 'slug' => 'hoan-kiem', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 14, 'name' => 'Hoàng Mai', 'slug' => 'hoang-mai', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 15, 'name' => 'Long Biên', 'slug' => 'long-bien', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 16, 'name' => 'Mê Linh', 'slug' => 'me-linh', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 17, 'name' => 'Mỹ Đức', 'slug' => 'my-duc', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 18, 'name' => 'Nam Từ Liêm', 'slug' => 'nam-tu-liem', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 19, 'name' => 'Phú Xuyên', 'slug' => 'phu-xuyen', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 20, 'name' => 'Phúc Thọ', 'slug' => 'phuc-tho', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 21, 'name' => 'Quốc Oai', 'slug' => 'quoc-oai', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 22, 'name' => 'Sóc Sơn', 'slug' => 'soc-son', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 23, 'name' => 'Sơn Tây', 'slug' => 'son-tay', 'type' => 'Thị Xã', 'city_id' => 1),
      array('id' => 24, 'name' => 'Tây Hồ', 'slug' => 'tay-ho', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 25, 'name' => 'Thạch Thất', 'slug' => 'thach-that', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 26, 'name' => 'Thanh Oai', 'slug' => 'thanh-oai', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 27, 'name' => 'Thanh Trì', 'slug' => 'thanh-tri', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 28, 'name' => 'Thanh Xuân', 'slug' => 'thanh-xuan', 'type' => 'Quận', 'city_id' => 1),
      array('id' => 29, 'name' => 'Thường Tín', 'slug' => 'thuong-tin', 'type' => 'Huyện', 'city_id' => 1),
      array('id' => 30, 'name' => 'Ứng Hòa', 'slug' => 'ung-hoa', 'type' => 'Huyện', 'city_id' => 1),
    );

    // Mass insert to the districts table
    DB::table('districts')->insert($values);
  }
}

<?php

use Illuminate\Database\Seeder;


class HousesTableSeeder extends Seeder
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
    DB::table('houses')->truncate();

    // Initialize values
    $values = [];
    for ($i = 0; $i < 1000; $i++)
    {
      $type_id = rand(1, 8);
      $district_id = rand(1, 30);
      $ward_id_min = \App\Ward::where('district_id', $district_id)->min('id');
      $ward_id_max = \App\Ward::where('district_id', $district_id)->max('id');
      $ward_id = rand($ward_id_min, $ward_id_max);
      $street_id_min = \App\Street::where('district_id', $district_id)->min('id');
      $street_id_max = \App\Street::where('district_id', $district_id)->max('id');
      $street_id = rand($street_id_min, $street_id_max);

      $lipsum = new joshtronic\LoremIpsum();
      $address = $lipsum->words(rand(5, 10));
      $square = rand(100, 1000) * 0.5;
      $price = rand(2, 100) * 0.5;
      $title = $lipsum->words(rand(10, 15));
      $description = $lipsum->paragraphs(rand(1, 3));
      $avatar = 'avatar_test_'.rand(1, 10).'.jpg';
      $beds = rand(1, 10);
      $toilets = rand(1, 10);
      $floors = rand(1, 10);
      $facade = rand(6, 20) * 0.5;
      $direction_id = rand(1, 8);
      $frontline = rand(4, 10) * 0.5;
      $owner_name = $lipsum->words(rand(3, 4));
      $owner_phone = '0'.rand(900000000, 999999999);
      $owner_additional_phone = '04'.rand(20000000, 99999999);
      $owner_birth_year = rand(1900, 1999);
      $owner_gender = rand(1, 2) % 2;
      $status = rand(1, 2) % 2;
      $approved = rand(1, 2) % 2;
      $author_id = rand(1, 3);
      $created_at = date('Y-m-d H:i:s');
      $updated_at = date('Y-m-d H:i:s');

      array_push($values, ['type_id' => $type_id, 'city_id' => 1, 'district_id' => $district_id, 'ward_id' => $ward_id, 'street_id' => $street_id, 'address' => $address, 'square' => $square, 'price' => $price, 'title' => $title, 'description' => $description, 'avatar' => $avatar, 'beds' => $beds, 'toilets' => $toilets, 'floors' => $floors, 'facade' => $facade, 'direction_id' => $direction_id, 'frontline' => $frontline, 'owner_name' => $owner_name, 'owner_phone' => $owner_phone, 'owner_additional_phone' => $owner_additional_phone, 'owner_birth_year' => $owner_birth_year, 'owner_gender' => $owner_gender, 'status' => $status, 'approved' => $approved, 'author_id' => $author_id, 'created_at' => $created_at, 'updated_at' => $updated_at]);
    }

    // Mass insert to the users table
    DB::table('houses')->insert($values);

    // Mass update slug field
    $houses = App\House::get();

    foreach ($houses as $house)
    {
      $house->update(['slug' => App\House::createSlug($house->title)]);
    }
  }
}

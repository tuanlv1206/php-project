<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $this->call(UsersTableSeeder::class);
    $this->call(TypesTableSeeder::class);
    $this->call(CitiesTableSeeder::class);
    $this->call(DistrictsTableSeeder::class);
    $this->call(WardsTableSeeder::class);
    $this->call(DirectionsTableSeeder::class);
    $this->call(ImagesTableSeeder::class);
    $this->call(StreetsTableSeeder::class);
    $this->call(HousesTableSeeder::class);
    $this->call(ProfilesTableSeeder::class);
  }
}

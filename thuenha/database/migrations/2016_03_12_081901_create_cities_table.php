<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cities', function (Blueprint $table) {
      $table->tinyInteger('id')->unsigned()->primary(); // Our service is only available in some big cities so the unsigned tiny integer type is enough to store the id.
      $table->string('name', 50); // Name of the city, eg: Hà Nội, Hồ Chí Minh
      $table->string('slug', 50); // URL of the city, eg: ha-noi, ho-chi-minh
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('cities');
  }
}

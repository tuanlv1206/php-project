<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('districts', function (Blueprint $table) {
      $table->integer('id')->unsigned()->primary();
      $table->string('name', 50); // Name of the district, eg: Cầu Giấy, Đống Đa
      $table->string('slug', 50); // URL of the district, eg: cau-giay, dong-da
      $table->string('type', 50); // Type of the district, eg: Quận, Huyện or Thị xã
      $table->tinyInteger('city_id')->unsigned(); // The id of the city contains the district

      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); // Relationship with cities table
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('districts', function ($table) {
      $table->dropForeign('districts_city_id_foreign');
    });

    Schema::drop('districts');
  }
}

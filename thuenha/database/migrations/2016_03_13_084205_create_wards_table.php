<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWardsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('wards', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name', 50); // Name of the ward, eg: Phúc Xá, Trúc Bạch
      $table->string('slug', 50); // URL of the ward, eg: phuc-xa, truc-bach
      $table->string('type', 50); // Type of the district, eg: Phường, Thị Trấn, Xã
      $table->integer('district_id')->unsigned(); // The id of the district contains the ward

      $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade'); // Relationship with districts table
    });

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('wards', function ($table) {
      $table->dropForeign('wards_district_id_foreign');
    });

    Schema::drop('wards');
  }
}

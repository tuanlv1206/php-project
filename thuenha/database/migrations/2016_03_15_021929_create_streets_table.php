<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreetsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('streets', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('type', 50); // Type of the street, eg: Đường or Phố
      $table->string('slug');
      $table->integer('district_id')->unsigned();
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
    Schema::table('streets', function ($table) {
      $table->dropForeign('streets_district_id_foreign');
    });

    Schema::drop('streets');
  }
}

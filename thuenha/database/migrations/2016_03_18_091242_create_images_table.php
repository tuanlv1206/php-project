<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('images', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name'); // image file name
      $table->integer('house_id')->unsigned(); // house's id
      $table->timestamps();

      $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade'); // Relationship with houses table
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('images', function ($table) {
      $table->dropForeign('images_house_id_foreign');
    });

    Schema::drop('images');
  }
}

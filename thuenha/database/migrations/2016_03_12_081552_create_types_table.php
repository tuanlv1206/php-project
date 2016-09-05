<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('types', function (Blueprint $table) {
      $table->tinyInteger('id')->unsigned()->primary(); // the numbers of real-estate type is not many so use unsigned tiny integer is enough.
      $table->string('name');
      $table->string('slug'); // the URL of the real-estate type
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('types');
  }
}

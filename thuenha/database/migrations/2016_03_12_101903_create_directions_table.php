<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('directions', function (Blueprint $table) {
        $table->tinyInteger('id')->unsigned()->primary(); // the numbers of direction is not many so use unsigned tiny integer is enough.
        $table->string('name');
        $table->string('slug'); // the URL of the direction
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('directions');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('profiles', function (Blueprint $table) {
        $table->Integer('id')->unsigned()->primary();
        $table->string('name')->nullable(); // user's name
        $table->string('register_name')->nullable();; // user's register name
        $table->string('email')->nullable();; // user's email
        $table->string('mobile_phone', 12); // user's the first mobile phone
        $table->string('home_phone', 12)->nullable(); // user's home phone
        $table->integer('district_id')->unsigned();  // The id of the district
        $table->string('address')->nullable();  // eg: Số 7 Ngõ 138
        $table->string('facebook')->nullable(); // user's facebook
        $table->string('skype')->nullable(); // user's skype
        $table->string('avatar'); // the avatar image link
        $table->timestamps();

        $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade'); // Relationship with districts

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('profiles', function ($table) {
        $table->dropForeign('profiles_id_foreign');
        $table->dropForeign('profiles_district_id_foreign');
      });

      Schema::drop('profiles');
    }
}

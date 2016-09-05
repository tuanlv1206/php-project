<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('houses', function (Blueprint $table) {
      $table->increments('id');
      $table->tinyInteger('type_id')->unsigned(); // eg: cửa hàng, ki-ốt's id
      $table->tinyInteger('city_id')->unsigned(); // eg: Hà Nội's id
      $table->integer('district_id')->unsigned(); // eg: Cầu Giấy's id
      $table->integer('ward_id')->unsigned()->nullable(); // eg: Nghĩa Tân's id.
      $table->integer('street_id')->unsigned()->nullable(); // eg: Trần Tử Bình's id
      $table->string('address');  // eg: Số 7 Ngõ 138
      $table->decimal('square', 8, 2);  // unit: m2, max 999999.99 m2
      $table->decimal('price', 7, 2);  // unit: triệu/tháng, max 99999.99 triệu/tháng.
      $table->string('title');  // eg: cho thuê cửa hàng tại Trần Tử Bình 5 triệu/tháng
      $table->string('slug');  // eg: cho-thue-cua-hang-tai-tran-tu-binh-5-trieu-thang
      $table->text('description');  // the detail information about the house
      $table->string('avatar'); // the avatar image link
      $table->tinyInteger('beds')->nullable();  // the number of bedrooms
      $table->tinyInteger('toilets')->nullable();  // the number of toilets
      $table->decimal('floors', 4, 1)->nullable();  // the number of floors, max 999.5 floors
      $table->decimal('facade', 6, 2)->nullable();  // the long of the facade (chiều dài mặt tiền), unit: meter, max 9999.99m
      $table->tinyInteger('direction_id')->unsigned()->nullable(); // eg: Đông Bắc direction's id
      $table->decimal('frontline', 6, 2)->nullable();  // the long of the front line (chiều rộng đường trước nhà), unit: meter, max 9999.99m
      $table->string('owner_name'); // name of the owner
      $table->string('owner_phone'); // phone of the owner
      $table->string('owner_additional_phone')->nullable(); // additional phone of the owner
      $table->smallInteger('owner_birth_year')->nullable(); // the birth year of the owner
      $table->boolean('owner_gender')->nullable(); // gender of the owner
      $table->boolean('status'); // eg: Đã cho thuê: 1 /chưa cho thuê: 0
      $table->boolean('approved'); // eg: Đã duyệt/chưa duyệt
      $table->integer('author_id')->unsigned(); // id of person who created the record
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade'); // Relationship with cities table
      $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade'); // Relationship with districts table
      $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade'); // Relationship with wards table
      $table->foreign('street_id')->references('id')->on('streets')->onDelete('cascade'); // Relationship with streets table
      $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade'); // Relationship with types table
      $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade'); // Relationship with directions table
      $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade'); // Relationship with users table
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('houses', function ($table) {
      $table->dropForeign('houses_city_id_foreign');
      $table->dropForeign('houses_district_id_foreign');
      $table->dropForeign('houses_ward_id_foreign');
      $table->dropForeign('houses_street_id_foreign');
      $table->dropForeign('houses_type_id_foreign');
      $table->dropForeign('houses_direction_id_foreign');
      $table->dropForeign('houses_author_id_foreign');
    });

    Schema::drop('houses');
  }
}

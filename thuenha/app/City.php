<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  public $timestamps = false;

  /**
   * Validation rules
   */
  public static $rules = array(
    'id' => 'required|numeric',
    'name' => 'required',
    'slug' => 'required',
  );

  public function districts()
  {
    return $this->hasMany('App\District');
  }

  public function houses()
  {
    return $this->hasMany('App\House');
  }

  public static function getAllToSelect()
  {
    $citiesRaw = City::get();
    $cities = array();
    foreach ($citiesRaw as $cityRaw) {
      $cities[$cityRaw->id] = $cityRaw->name;
    }

    return $cities;
  }
}

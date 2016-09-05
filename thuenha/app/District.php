<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
  public $timestamps = false;

  /**
   * Validation rules
   */
  public static $rules = array(
    'id' => 'required|numeric',
    'name' => 'required',
    'slug' => 'required',
    'type' => 'required',
    'city_id' => 'required',
  );

  public function city()
  {
    return $this->belongsTo('App\City');
  }

  public function wards()
  {
    return $this->hasMany('App\Ward');
  }

  public function streets()
  {
    return $this->hasMany('App\Street');
  }

  public function houses()
  {
    return $this->hasMany('App\House');
  }

  public static function getAllToSelect()
  {
    $districtsRaw = District::get();
    $districts = array();
    foreach ($districtsRaw as $districtRaw) {
      $districts[$districtRaw->id] = $districtRaw->name;
    }

    return $districts;
  }

  public static function getSlugById($id)
  {
    $slug = '';
    $district = District::find($id);
    if ($district != NULL)
    {
      $slug = $district->slug;
    }

    return $slug;
  }

  public static function getIdBySlug($slug)
  {
    $id = '';
    $district = District::where('slug', $slug)->first();
    if ($district != NULL)
      $id = $district->id;

    return $id;
  }

  public static function getFullNameById($id)
  {
    $full_name = '';
    $district = District::find($id);
    if ($district != NULL)
    {
      $full_name = $district->type.' '.$district->name;
    }

    return $full_name;
  }

  public static function getNameById($id)
  {
    $name = '';
    $district = District::find($id);
    if ($district != NULL)
    {
      $name = $district->name;
    }

    return $name;
  }
}

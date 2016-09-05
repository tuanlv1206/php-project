<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Ward extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'build_from' => 'name',
    'save_to'    => 'slug',
  ];

  public $timestamps = false;

  /**
   * Validation rules
   */
  public static $rules = array(
    'id' => 'required|numeric',
    'name' => 'required',
    'slug' => 'required',
    'type' => 'required',
    'district_id' => 'required',
  );

  public function district()
  {
    return $this->belongsTo('App\District');
  }

  public function houses()
  {
    return $this->hasMany('App\House');
  }

  // Get all wards by district id
  public static function getWardsByDistrictId($district_id)
  {
    $wardsRaw = Ward::where('district_id', $district_id)->get();
    $wards = array();
    foreach ($wardsRaw as $wardRaw) {
      $wards[$wardRaw->id] = $wardRaw->name;
    }

    return $wards;
  }

  public static function getSlugById($id)
  {
    $slug = '';
    $ward = Ward::find($id);
    if ($ward != NULL)
    {
      $slug = $ward->slug;
    }

    return $slug;
  }

  public static function getIdBySlug($slug)
  {
    $id = '';
    $ward = Ward::where('slug', $slug)->first();
    if ($ward != NULL)
      $id = $ward->id;

    return $id;
  }

  public static function getFullNameById($id)
  {
    $full_name = '';
    $ward = Ward::find($id);
    if ($ward != NULL)
    {
      $full_name = $ward->type.' '.$ward->name;
    }

    return $full_name;
  }

  public static function getNameById($id)
  {
    $name = '';
    $ward = Ward::find($id);
    if ($ward != NULL)
    {
      $name = $ward->name;
    }

    return $name;
  }
}

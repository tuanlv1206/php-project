<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Street extends Model implements SluggableInterface
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
    'name' => 'required',
    'slug' => 'required',
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

  // Get all streets by district id
  public static function getStreetsByDistrictId($district_id)
  {
    $streetsRaw = Street::where('district_id', $district_id)->get();
    $streets = array();
    foreach ($streetsRaw as $streetRaw) {
      $streets[$streetRaw->id] = $streetRaw->name;
    }

    return $streets;
  }

  public static function getSlugById($id)
  {
    $slug = '';
    $street = Street::find($id);
    if ($street != NULL)
    {
      $slug = $street->slug;
    }

    return $slug;
  }

  public static function getIdBySlug($slug)
  {
    $id = '';
    $street = Street::where('slug', $slug)->first();
    if ($street != NULL)
      $id = $street->id;

    return $id;
  }

  public static function getFullNameById($id)
  {
    $full_name = '';
    $street = Street::find($id);
    if ($street != NULL)
    {
      $full_name = $street->type.' '.$street->name;
    }

    return $full_name;
  }

  public static function getNameById($id)
  {
    $name = '';
    $street = Street::find($id);
    if ($street != NULL)
    {
      $name = $street->name;
    }

    return $name;
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * Validation rules
   */
  public static $rules = array(
    'id' => 'required|numeric',
    'name' => 'required',
    'slug' => 'required',
  );

  public function houses()
  {
    return $this->hasMany('App\House');
  }

  public static function getAllToSelect()
  {
    $directionsRaw = Direction::get();
    $directions = array();
    foreach ($directionsRaw as $directionRaw) {
      $directions[$directionRaw->id] = $directionRaw->name;
    }

    return $directions;
  }

  public static function getSlugById($id)
  {
    $slug = '';
    $direction = Direction::find($id);
    if ($direction != NULL)
    {
      $slug = $direction->slug;
    }

    return $slug;
  }

  public static function getIdBySlug($slug)
  {
    $id = '';
    $direction = Direction::where('slug', $slug)->first();
    if ($direction != NULL)
      $id = $direction->id;

    return $id;
  }

  public static function getNameById($id)
  {
    $name = '';
    $direction = Direction::find($id);
    if ($direction != NULL)
    {
      $name = $direction->name;
    }

    return $name;
  }
}

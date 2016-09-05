<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
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
    $typesRaw = Type::get();
    $types = array();
    foreach ($typesRaw as $typeRaw) {
      $types[$typeRaw->id] = $typeRaw->name;
    }

    return $types;
  }

  public static function getSlugById($id)
  {
    $slug = '';
    $type = Type::find($id);
    if ($type != NULL)
    {
      $slug = $type->slug;
    }

    return $slug;
  }

  public static function getIdBySlug($slug)
  {
    $id = '';
    $type = Type::where('slug', $slug)->first();
    if ($type != NULL)
      $id = $type->id;

    return $id;
  }

  public static function getNameById($id)
  {
    $name = '';
    $type = Type::find($id);
    if ($type != NULL)
    {
      $name = $type->name;
    }

    return $name;
  }
}

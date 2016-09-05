<?php

namespace App;

use Storage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  /**
   * Validation rules
   */
  public static $rules = array(
    'name' => 'required',
    'house_id' => 'required',
  );

  public function house()
  {
    return $this->belongsTo('App\House');
  }

  public static function getImagesByHouseId($house_id)
  {
    return Image::where('house_id', $house_id)->get();
  }

  // public function setNameAttribute($value)
  // {
  //   if (array_key_exists('name', $this->attributes))
  //   {
  //     $old_name = $this->attributes['name'];
  //     if ($old_name != $value)
  //     {
  //       // Delete physical images
  //       $originals_path = 'public/uploads/images/originals/'.$old_name;
  //       $portraits_path = 'public/uploads/images/portraits/'.$old_name;
  //       $thumbs_path = 'public/uploads/images/thumbs/'.$old_name;
  //       if (file_exists(base_path().'/'.$originals_path))
  //         Storage::delete($originals_path);
  //       if (file_exists(base_path().'/'.$portraits_path))
  //         Storage::delete($portraits_path);
  //       if (file_exists(base_path().'/'.$thumbs_path))
  //         Storage::delete($thumbs_path);
  //     }
  //   }
  //   $this->attributes['name'] = $value;
  // }
}

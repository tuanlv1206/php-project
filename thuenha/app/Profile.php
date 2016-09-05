<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \App\Profile;

class Profile extends Model
{
  public $timestamps = true;

  /**
   * Validation rules
   */
  public static $rules = array(
    'mobile_phone' => 'required|regex:/^[0-9 .+]{10,20}$/',
    'home_phone' => 'regex:/^[0-9 .+]{10,20}$/',
    'district_id' => 'required',
    'avatar' => 'required|image|max:5000',
  );

  public static $update_rules = array(
    'mobile_phone' => 'required|regex:/^[0-9 .+]{10,20}$/',
    'home_phone' => 'regex:/^[0-9 .+]{10,20}$/',
    'district_id' => 'required',
    'avatar' => 'image|max:5000',
  );

  public function city()
  {
    return $this->belongsTo('App\City');
  }

  public function district()
  {
    return $this->belongsTo('App\District');
  }

}

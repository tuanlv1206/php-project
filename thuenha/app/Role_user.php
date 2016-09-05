<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
  public $timestamps = false;
  protected $table = 'role_user';

  public function role()
  {
    return $this->belongsTo('App\Role');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}

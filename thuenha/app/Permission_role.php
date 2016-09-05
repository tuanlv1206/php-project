<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_role extends Model
{
  public $timestamps = false;
  protected $table = 'permission_role';

  public function permission()
  {
    return $this->belongsTo('App\Permission');
  }

  public function role()
  {
    return $this->belongsTo('App\Role');
  }

}

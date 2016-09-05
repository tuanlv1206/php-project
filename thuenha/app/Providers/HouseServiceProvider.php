<?php

namespace App\Providers;

use Storage;
use App\House;
use Illuminate\Support\ServiceProvider;

class HouseServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    House::deleted(function ($house) {
      // Delete physical images
      $originals_path = 'public/uploads/images/originals/'.$house->avatar;
      $thumbs_path = 'public/uploads/images/thumbs/'.$house->avatar;
      if (file_exists(base_path().'/'.$originals_path))
        Storage::delete($originals_path);
        Storage::delete($portraits_path);
      if (file_exists(base_path().'/'.$thumbs_path))
        Storage::delete($thumbs_path);
    });
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}

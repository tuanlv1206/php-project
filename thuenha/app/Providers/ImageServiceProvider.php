<?php

namespace App\Providers;

use Storage;
use App\Image;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    Image::deleted(function ($image) {
      // Delete physical images
      $originals_path = 'public/uploads/images/originals/'.$image->name;
      $portraits_path = 'public/uploads/images/portraits/'.$image->name;
      $thumbs_path = 'public/uploads/images/thumbs/'.$image->name;
      if (file_exists(base_path().'/'.$originals_path))
        Storage::delete($originals_path);
      if (file_exists(base_path().'/'.$portraits_path))
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

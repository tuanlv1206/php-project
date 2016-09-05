<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class House extends Model implements SluggableInterface
{
  use SluggableTrait;
  use SoftDeletes;

  protected $sluggable = [
    'build_from' => 'title',
    'save_to'    => 'slug',
    'on_update' => true
  ];

  protected $dates = ['deleted_at'];

  /**
   * Validation rules
   */
  public static $rules = array(
    'type_id' => 'required',
    'district_id' => 'required',
    'address' => 'required',
    'square' => 'required|numeric',
    'price' => 'required|numeric',
    'title' => 'required',
    'description' => 'required',
    'avatar' => 'required|image|max:5000',
    'beds' => 'numeric',
    'toilets' => 'numeric',
    'floors' => 'numeric',
    'facade' => 'numeric',
    'frontline' => 'numeric',
    'owner_name' => 'required',
    'owner_phone' => 'required|regex:/^[0-9 .+]{10,20}$/',
    'owner_additional_phone' => 'regex:/^[0-9 .+]{10,20}$/',
    'owner_birth_year' => 'integer',
  );

  public static $update_rules = array(
    'type_id' => 'required',
    'district_id' => 'required',
    'address' => 'required',
    'square' => 'required|numeric',
    'price' => 'required|numeric',
    'title' => 'required',
    'description' => 'required',
    'avatar' => 'image|max:5000',
    'beds' => 'numeric',
    'toilets' => 'numeric',
    'floors' => 'numeric',
    'facade' => 'numeric',
    'frontline' => 'numeric',
    'owner_name' => 'required',
    'owner_phone' => 'required|regex:/^[0-9 .+]{10,20}$/',
    'owner_additional_phone' => 'regex:/^[0-9 .+]{10,20}$/',
    'owner_birth_year' => 'integer|min:1900',
  );


  public function images()
  {
    return $this->hasMany('App\Image');
  }

  public function city()
  {
    return $this->belongsTo('App\City');
  }

  public function district()
  {
    return $this->belongsTo('App\District');
  }

  public function ward()
  {
    return $this->belongsTo('App\Ward');
  }

  public function street()
  {
    return $this->belongsTo('App\Street');
  }

  public function type()
  {
    return $this->belongsTo('App\Type');
  }

  public function direction()
  {
    return $this->belongsTo('App\Direction');
  }

  public function owner()
  {
    return $this->belongsTo('App\Owner');
  }

  public function author()
  {
    return $this->belongsTo('App\User');
  }

  // public function setAvatarAttribute($value)
  // {
  //   if (array_key_exists('avatar', $this->attributes))
  //   {
  //     $old_name = $this->attributes['avatar'];
  //     if ($old_name != $value)
  //     {
  //       // Delete physical images
  //       $originals_path = 'public/uploads/images/originals/'.$old_name;
  //       $thumbs_path = 'public/uploads/images/thumbs/'.$old_name;
  //       if (file_exists(base_path().'/'.$originals_path))
  //         Storage::delete($originals_path);
  //       if (file_exists(base_path().'/'.$thumbs_path))
  //         Storage::delete($thumbs_path);
  //     }
  //   }
  //   $this->attributes['avatar'] = $value;
  // }

  public static function deleteHouse($id)
  {
    $house = House::find($id);

    // If the house is exist and the current user is admin or the author of the house, we delete the house
    if (!$house || ($house->author_id != \Auth::user()->id && !\Auth::user()->hasRole('admin'))) {
      \Session::flash('error_message', trans('house/edit.delete_not_success'));
      return array('status' => '0');
    }
    if ($house && ($house->author_id == \Auth::user()->id || \Auth::user()->hasRole('admin')))
    {
      $house->delete();
      \Session::flash('success_message', trans('house/edit.delete_success'));
      return array('status' => '1');
    }

    \Session::flash('error_message', trans('house/edit.delete_not_success'));

    return array('status' => '0');
  }

  /**
   * [search houses by conditions]
   * @param  [String]  $keyword      [keyword in house description]
   * @param  [Integer]  $type_id      [type id]
   * @param  [Integer]  $district_id  [district id]
   * @param  [Integer]  $ward_id      [ward id]
   * @param  [Integer]  $street_id    [street id]
   * @param  [Float]  $square_min   [min of square]
   * @param  [Float]  $square_max   [max of square]
   * @param  [Float]  $price_min    [min of price]
   * @param  [Float]  $price_max    [max of price]
   * @param  [Integer]  $beds         [number of bedrooms]
   * @param  [Integer]  $direction_id [direction id]
   * @param  [Integer] $sort_type    [type of sort 0, 1 or 2]
   * @return [Array]                [array of houses and links]
   */
  public static function search($keyword, $type_id, $district_id, $ward_id, $street_id, $square_min, $square_max, $price_min, $price_max, $beds, $direction_id, $sort_type = 0)
  {
    // Create search query based on users search condition
    // Firstly, we select all houses avaiable for rent and is approved
    $search = \DB::table('houses')->where('status', 0)->where('approved', 1);

    // If keyword is not empty, select all houses contain this keyword in description part
    // Searching is case insensitive so we convert keyword to lowercase
    $keyword_lower = mb_strtolower($keyword);
    if ($keyword != '')
    {
      $search->whereRaw('LOWER(description) LIKE \'%'.$keyword_lower.'%\' COLLATE utf8_bin');
    }

    // If type is selected, we select all houses belong to this type
    if ($type_id != '')
    {
      $search->where('type_id', $type_id);
    }

    // If district is selected, we select all houses in this district
    if ($district_id != '')
    {
      $search->where('district_id', $district_id);
    }

    // If ward is selected, we select all houses in this ward
    if ($ward_id != '')
    {
      $search->where('ward_id', $ward_id);
    }

    // If street is selected, we select all houses on this street
    if ($street_id != '')
    {
      $search->where('street_id', $street_id);
    }

    // If users select both min and max square, we select all houses have price between min and max value
    if ($square_min != '' && $square_max != '')
    {
      $search->whereBetween('square', [$square_min, $square_max]);
    }
    else if ($square_min != '') // Users select only square min
    {
      $search->where('square', '>=', $square_min);
    }
    else if ($square_max != '') // User select only square max
    {
      $search->where('square', '<=', $square_max);
    }

    // If users select both min and max price, we select all houses have price between min and max value
    if ($price_min != '' && $price_max != '')
    {
      $search->whereBetween('price', [$price_min, $price_max]);
    }
    else if ($price_min != '') // Users select only price min
    {
      $search->where('price', '>=', $price_min);
    }
    else if ($price_max != '') // User select only price max
    {
      $search->where('price', '<=', $price_max);
    }

    // If users select number of bedroms, we select all houses have number of bedrooms greater or equal this number
    if ($beds != '')
    {
      $search->where('beds', '>=', $beds);
    }

    // If users select direction, we select all houses have this direction
    if ($direction_id != '')
    {
      $search->where('direction_id', $direction_id);
    }

    // We sort houses based on sort type (0: newest houses, 1: price lowest, 2: price highest, 3: square smallest, 4: square largest) then get the raw data of houses
    switch ($sort_type)
    {
      case 1:
        $raw_data = $search->orderBy('price', 'desc')->paginate(5, array('*'), trans('home/search.page'));
        break;
      case 2:
        $raw_data = $search->orderBy('price', 'asc')->paginate(5, array('*'), trans('home/search.page'));
        break;
      case 3:
        $raw_data = $search->orderBy('square', 'desc')->paginate(5, array('*'), trans('home/search.page'));
        break;
      case 4:
        $raw_data = $search->orderBy('square', 'asc')->paginate(5, array('*'), trans('home/search.page'));
        break;
      default: // sort type equals 0
        $raw_data = $search->orderBy('updated_at', 'desc')->paginate(5, array('*'), trans('home/search.page'));
        break;
    }
    // Get links and total
    $links = $raw_data->links();
    $total = $raw_data->total();

    // Get houses list to bind to view
    $houses = [];
    foreach ($raw_data as $data)
    {
      $area = '';
      if ($data->street_id != '')
      {
        $street_full_name = \App\Street::getFullNameById($data->street_id);
        $area .= $street_full_name;
        $area .= ' - ';
      }

      if ($data->ward_id != '')
      {
        $ward_full_name = \App\Ward::getFullNameById($data->ward_id);
        $area .= $ward_full_name;
        $area .= ' - ';
      }

      $district_full_name = \App\district::getFullNameById($data->district_id);
      $area .= $district_full_name;

      // Highlight keyword in description
      if ($keyword != '')
      {
        $data->description = preg_replace("/($keyword_lower)/i", "<span class=\"text-highlight\">$0</span>", $data->description);
      }

      $updated_at = date_create_from_format('Y-m-d H:i:s', $data->updated_at);
      array_push($houses, ['id' => $data->id, 'title' => $data->title, 'slug' => $data->slug, 'avatar' => $data->avatar, 'description' => str_replace(PHP_EOL, '<br/>', $data->description), 'square' => $data->square, 'price' => $data->price, 'area' => $area, 'updated_at' => $updated_at->format('d/m/Y')]);
    }

    return ['houses' => $houses, 'links' => $links, 'total' => $total];
  }

  public static function getAllCount()
  {
    return House::where('status', 0)->where('approved', 1)->count();
  }
}

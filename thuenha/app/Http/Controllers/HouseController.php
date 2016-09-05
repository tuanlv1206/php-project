<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\House;
use Session;

class HouseController extends Controller
{
  /**
   * Show the house info form
   * @return View
   */
  public function create()
  {
    // Get all types to bind to select options
    $types = array('' => trans('house/create.type_hint'));
    $types += \App\Type::getAllToSelect();

    // Get all districts to bind to select option
    $districts = array('' => trans('house/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    // We only show wards and streets when district is specific so we just initialize an empty select option with hint
    $wards = array('' => trans('house/create.ward_hint'));
    $streets = array('' => trans('house/create.street_hint'));

    // Get all directions to bind to select options
    $directions = array('' => trans('house/create.direction_hint'));
    $directions += \App\Direction::getAllToSelect();

    return view('house.create', array('types' => $types, 'districts' => $districts, 'wards' => $wards, 'streets' => $streets, 'directions' => $directions));
  }

  /**
   * Store a new house
   * @param  request
   * @return Response
   */
  public function store(Request $request)
  {
    $validator = \Validator::make($request->all(), House::$rules);
    if ($validator->fails()) {
      // Store selected ward_id and street_id to session for re-display on the select options
      Session::flash('ward_id', $request->ward_id);
      Session::flash('street_id', $request->street_id);

      return redirect()->back()->withErrors($validator)->withInput();
    }

    $house = new House;
    $house->type_id = $request->type_id;
    $house->city_id = 1; // For now, we just serve Hanoi market
    $house->district_id = $request->district_id;
    if ($request->ward_id != '')
      $house->ward_id = $request->ward_id;
    if ($request->street_id != '')
      $house->street_id = $request->street_id;
    $house->address = htmlspecialchars(trim($request->address)); // Convert special character to HTML entities
    $house->square = $request->square;
    $house->price = $request->price;
    $house->title = htmlspecialchars(trim($request->title));
    $house->description = htmlspecialchars(trim($request->description));
    if ($request->beds != '')
      $house->beds = $request->beds;
    if ($request->toilets != '')
      $house->toilets = $request->toilets;
    if ($request->floors != '')
      $house->floors = $request->floors;
    if ($request->facade != '')
      $house->facade = $request->facade;
    if ($request->direction_id != '')
      $house->direction_id = $request->direction_id;
    if ($request->frontline != '')
      $house->frontline = $request->frontline;
    $house->owner_name = htmlspecialchars(trim($request->owner_name));
    $house->owner_phone = preg_replace('/[^0-9]/s', '', $request->owner_phone);
    if (trim($request->owner_additional_phone) != '')
      $house->owner_additional_phone = preg_replace('/[^0-9]/s', '', $request->owner_additional_phone);
    if ($request->owner_birth_year != '')
      $house->owner_birth_year = $request->owner_birth_year;
    if ($request->owner_gender != '')
      $house->owner_gender = $request->owner_gender;
    $house->status = 0; // Available for rent
    $house->approved = 0;
    $house->author_id = \Auth::user()->id;
    $house->avatar = '';

    $house->save();

    // Store avatar
    $avatar = \Image::make($request->file('avatar'));
    $extension = $request->file('avatar')->getClientOriginalExtension();
    $ratio = $avatar->height() / $avatar->width();
    $file_name = date('YmdHis').'_'.$house->id;
    $avatar->resize(200, 200 * $ratio)->save('uploads/avatars/'.$file_name.'.'.$extension);
    $house->avatar = $file_name.'.'.$extension;

    $house->save();

    // Store images
    $image_files = $request->file('images');
    $image_count = 1; // Add to image file name
    foreach ($image_files as $image_file) {
      $image_rules = array('image_file' => 'required|image|max:5000');
      $image_validator = \Validator::make(array('image_file' => $image_file), $image_rules);
      if ($image_validator->passes()) {
        $image = \Image::make($image_file);
        $image_extension = $image_file->getClientOriginalExtension();
        $image_ratio = $image->width() / $image->height();
        $image_file_name = date('YmdHis').'_'.$house->id.'_'.$image_count;
        $image->resize(500 * $image_ratio, 500)->save('uploads/images/'.$image_file_name.'.'.$image_extension);
        $image_count++;
        $house_image = new \App\Image;
        $house_image->name = $image_file_name.'.'.$image_extension;
        $house_image->house_id = $house->id;
        $house_image->save();
      }
    }

    // Flash a successful message
    Session::flash('flash_message', trans('house/edit.create_successful'));

    return redirect('sua-tin/'.$house->id);
  }

  public function edit($id)
  {
    // Check whether the house is valid and the current user is the author of the house.
    $house = House::find($id);
    if ($house == NULL || $house->author_id != \Auth::user()->id)
      return redirect('/');

    // Get all types to bind to select options
    $types = array('' => trans('house/create.type_hint'));
    $types += \App\Type::getAllToSelect();

    // Get all districts to bind to select option
    $districts = array('' => trans('house/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    // We only show wards and streets when district is specific so we just initialize an empty select option with hint
    $wards = array('' => trans('house/create.ward_hint'));
    $streets = array('' => trans('house/create.street_hint'));

    // Store selected ward_id and street_id to session for display on the select options
    if (!Session::has('ward_id'))
      Session::flash('ward_id', $house->ward_id);
    if (!Session::has('street_id'))
      Session::flash('street_id', $house->street_id);

    // Get all directions to bind to select options
    $directions = array('' => trans('house/create.direction_hint'));
    $directions += \App\Direction::getAllToSelect();

    // Get all images
    $images = \App\Image::getImagesByHouseId($id);

    return view('house.edit', array('types' => $types, 'districts' => $districts, 'wards' => $wards, 'streets' => $streets, 'directions' => $directions, 'house' => $house, 'images' => $images));
  }

  public function update($id, Request $request)
  {
    $validator = \Validator::make($request->all(), House::$update_rules);
    if ($validator->fails()) {
      // Store selected ward_id and street_id to session for re-display on the select options
      Session::flash('ward_id', $request->ward_id);
      Session::flash('street_id', $request->street_id);

      return redirect()->back()->withErrors($validator)->withInput();
    }

    $house = House::find($id);
    if ($house == NULL)
      return redirect('/');
    $house->type_id = $request->type_id;
    $house->city_id = 1; // For now, we just serve Hanoi market
    $house->district_id = $request->district_id;
    if ($request->ward_id != '')
      $house->ward_id = $request->ward_id;
    else
      $house->ward_id = NULL;
    if ($request->street_id != '')
      $house->street_id = $request->street_id;
    else
      $house->street_id = NULL;
    $house->address = htmlspecialchars(trim($request->address)); // Convert special character to HTML entities
    $house->square = $request->square;
    $house->price = $request->price;
    $house->title = htmlspecialchars(trim($request->title));
    $house->description = htmlspecialchars(trim($request->description));
    if ($request->beds != '')
      $house->beds = $request->beds;
    else
      $house->beds = NULL;
    if ($request->toilets != '')
      $house->toilets = $request->toilets;
    else
      $house->toilets = NULL;
    if ($request->floors != '')
      $house->floors = $request->floors;
    else
      $house->floors = NULL;
    if ($request->facade != '')
      $house->facade = $request->facade;
    else
      $house->facade = NULL;
    if ($request->direction_id != '')
      $house->direction_id = $request->direction_id;
    else
      $house->direction_id = NULL;
    if ($request->frontline != '')
      $house->frontline = $request->frontline;
    else
      $house->frontline = NULL;
    $house->owner_name = htmlspecialchars(trim($request->owner_name));
    $house->owner_phone = preg_replace('/[^0-9]/s', '', $request->owner_phone);
    if (trim($request->owner_additional_phone) != '')
      $house->owner_additional_phone = preg_replace('/[^0-9]/s', '', $request->owner_additional_phone);
    else
      $house->owner_additional_phone = NULL;
    if ($request->owner_birth_year != '')
      $house->owner_birth_year = $request->owner_birth_year;
    else
      $house->owner_birth_year = NULL;
    if ($request->owner_gender != '')
      $house->owner_gender = $request->owner_gender;
    else
      $house->owner_gender = NULL;
    $house->status = $request->status;
    $house->approved = 0;

    // Update avatar
    $avatar_file = $request->file('avatar');
    if ($avatar_file)
    {
      $avatar = \Image::make($avatar_file);
      $extension = $avatar_file->getClientOriginalExtension();
      $ratio = $avatar->height() / $avatar->width();
      $file_name = date('YmdHis').'_'.$house->id;
      $avatar->resize(200, 200 * $ratio)->save('uploads/avatars/'.$file_name.'.'.$extension);
      // Delete old avatar
      \Storage::delete('public/uploads/avatars/'.$house->avatar);
      $house->avatar = $file_name.'.'.$extension;
    }

    // Save house
    $house->save();

    // Update images
    $image_files = $request->file('images');
    $image_count = 1; // Add to image file name

    // Get all old images
    $old_images = \App\Image::getImagesByHouseId($house->id);

    foreach ($image_files as $image_file) {
      $image_rules = array('image_file' => 'required|image|max:5000');
      $image_validator = \Validator::make(array('image_file' => $image_file), $image_rules);
      if ($image_validator->passes()) {
        $image = \Image::make($image_file);
        $image_extension = $image_file->getClientOriginalExtension();
        $image_ratio = $image->width() / $image->height();
        $image_file_name = date('YmdHis').'_'.$house->id.'_'.$image_count;
        $image->resize(500 * $image_ratio, 500)->save('uploads/images/'.$image_file_name.'.'.$image_extension);
        $image_count++;
        $house_image = new \App\Image;
        $house_image->name = $image_file_name.'.'.$image_extension;
        $house_image->house_id = $house->id;
        $house_image->save();
      }
    }

    // if user uploads at least 1 images, we delete all old images
    if ($image_count > 1)
    {
      foreach ($old_images as $old_image) {
        // remove from database
        $old_image->delete();
        // remove from filesytem
        \Storage::delete('public/uploads/images/'.$old_image->name);
      }
    }

    // Flash a successful message
    Session::flash('flash_message', trans('house/edit.update_successful'));

    return redirect()->back();
  }

  public function show($slug_id)
  {
    $last_minus_position = strrpos($slug_id, '-');
    // If the minus sign is not found, we consider the slug is id of the house
    if($last_minus_position === false)
    {
      $slug = '';
      $id = $slug_id;
    }
    else
    {
      $slug = substr($slug_id, 0, $last_minus_position);
      $id = substr($slug_id, $last_minus_position + 1);
    }

    // We check whether the id is valid (all characters are degits) or not
    if (!ctype_digit($id))
      return redirect('/');

    $house = House::find($id);
    if (is_null($house))
      return redirect('/');
    if ($house->slug != $slug)
      return redirect($house->slug.'-'.$id);

    // set area anchor text and link
    $house_type = \App\Type::find($house->type_id);
    $house->type = $house_type->name;
    $street = \App\Street::find($house->street_id);
    $house->area_anchor_text = $house_type->name;
    $house->area_link = $house_type->slug;
    if ($street)
    {
      $house->area_anchor_text .= ' '.trans('house/show.at_street').' '.$street->name;
      $house->area_link .= ' '.trans('house/show.at_street_slug').' '.$street->slug;
    }
    $house->ward = '';
    if ($house->ward_id)
    {
      $ward = \App\Ward::find($house->ward_id);
      if ($ward)
      {
        $house->ward = $ward->type.' '.$ward->name.' - ';
      }
    }
    if ($house->direction_id)
    {
      $house->direction = \App\Direction::find($house->direction_id)->name;
    }

    $district = \App\District::find($house->district_id);
    $house->district_type = $district->type;
    $house->district_name = $district->name;
    $images = \App\Image::where('house_id', $id)->get();

    // Replace EOL by <br/> tag
    $house->description = str_replace(PHP_EOL, '<br/>', $house->description);

    return view('house.show', array('house' => $house, 'images' => $images));
  }

  public function unapprovedHouseList(){
    $houseList = \App\House::where('approved', 0)->paginate(8);

    // Get all types
    $types = \App\Type::get();
    // Get all streets
    $streets = \App\Street::get();
    // Get all wards
    $wards = \App\Ward::get();
    // Get all districts
    $districts = \App\District::get();

    return view('admin.unapprovedhouses',array('houseList' => $houseList, 'types' => $types, 'streets' => $streets, 'wards' => $wards, 'districts' => $districts));
  }

  public function viewHouseToApprove($id){
        // Check whether the house is valid and the current user is the author of the house.
    $house = House::find($id);
    if ($house == NULL)
      return redirect('/');

    // Get all types to bind to select options
    $types = array('' => trans('house/create.type_hint'));
    $types += \App\Type::getAllToSelect();

    // Get all districts to bind to select option
    $districts = array('' => trans('house/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    // We only show wards and streets when district is specific so we just initialize an empty select option with hint
    $wards = array('' => trans('house/create.ward_hint'));
    $streets = array('' => trans('house/create.street_hint'));

    // Store selected ward_id and street_id to session for display on the select options
    if (!Session::has('ward_id'))
      Session::flash('ward_id', $house->ward_id);
    if (!Session::has('street_id'))
      Session::flash('street_id', $house->street_id);

    // Get all directions to bind to select options
    $directions = array('' => trans('house/create.direction_hint'));
    $directions += \App\Direction::getAllToSelect();

    // Get all images
    $images = \App\Image::getImagesByHouseId($id);

    return view('admin.approve', array('types' => $types, 'districts' => $districts, 'wards' => $wards, 'streets' => $streets, 'directions' => $directions, 'house' => $house, 'images' => $images));
  }

  public function approveHouse($id, Request $request){
    $validator = \Validator::make($request->all(), House::$update_rules);
    if ($validator->fails()) {
      // Store selected ward_id and street_id to session for re-display on the select options
      Session::flash('ward_id', $request->ward_id);
      Session::flash('street_id', $request->street_id);

      return redirect()->back()->withErrors($validator)->withInput();
    }

    $house = House::find($id);
    if ($house == NULL)
      return redirect('/');
    $house->type_id = $request->type_id;
    $house->city_id = 1; // For now, we just serve Hanoi market
    $house->district_id = $request->district_id;
    if ($request->ward_id != '')
      $house->ward_id = $request->ward_id;
    if ($request->street_id != '')
      $house->street_id = $request->street_id;
    $house->address = htmlspecialchars(trim($request->address)); // Convert special character to HTML entities
    $house->square = $request->square;
    $house->price = $request->price;
    $house->title = htmlspecialchars(trim($request->title));
    $house->description = htmlspecialchars(trim($request->description));
    if ($request->rooms != '')
      $house->rooms = $request->rooms;
    if ($request->toilets != '')
      $house->toilets = $request->toilets;
    if ($request->floors != '')
      $house->floors = $request->floors;
    if ($request->facade != '')
      $house->facade = $request->facade;
    if ($request->direction_id != '')
      $house->direction_id = $request->direction_id;
    if ($request->frontline != '')
      $house->frontline = $request->frontline;
    $house->owner_name = htmlspecialchars(trim($request->owner_name));
    $house->owner_phone = preg_replace('/[^0-9]/s', '', $request->owner_phone);
    if (trim($request->owner_additional_phone) != '')
      $house->owner_additional_phone = preg_replace('/[^0-9]/s', '', $request->owner_additional_phone);
    if ($request->owner_birth_year != '')
      $house->owner_birth_year = $request->owner_birth_year;
    if ($request->owner_gender != '')
      $house->owner_gender = $request->owner_gender;
    $house->status = $request->status;
    $house->approved = 1;

    // Update avatar
    $avatar_file = $request->file('avatar');
    if ($avatar_file)
    {
      $avatar = \Image::make($avatar_file);
      $extension = $avatar_file->getClientOriginalExtension();
      $ratio = $avatar->height() / $avatar->width();
      $file_name = date('YmdHis').'_'.$house->id;
      $avatar->resize(200, 200 * $ratio)->save('uploads/avatars/'.$file_name.'.'.$extension);
      // Delete old avatar
      \Storage::delete('public/uploads/avatars/'.$house->avatar);
      $house->avatar = $file_name.'.'.$extension;
    }

    // Save house
    $house->save();

    // Update images
    $image_files = $request->file('images');
    $image_count = 1; // Add to image file name

    // Get all old images
    $old_images = \App\Image::getImagesByHouseId($house->id);

    foreach ($image_files as $image_file) {
      $image_rules = array('image_file' => 'required|image|max:5000');
      $image_validator = \Validator::make(array('image_file' => $image_file), $image_rules);
      if ($image_validator->passes()) {
        $image = \Image::make($image_file);
        $image_extension = $image_file->getClientOriginalExtension();
        $image_ratio = $image->width() / $image->height();
        $image_file_name = date('YmdHis').'_'.$house->id.'_'.$image_count;
        $image->resize(500 * $image_ratio, 500)->save('uploads/images/'.$image_file_name.'.'.$image_extension);
        $image_count++;
        $house_image = new \App\Image;
        $house_image->name = $image_file_name.'.'.$image_extension;
        $house_image->house_id = $house->id;
        $house_image->save();
      }
    }

    // if user uploads at least 1 images, we delete all old images
    if ($image_count > 1)
    {
      foreach ($old_images as $old_image) {
        // remove from database
        $old_image->delete();
        // remove from filesytem
        \Storage::delete('public/uploads/images/'.$old_image->name);
      }
    }

    // Flash a successful message
    Session::flash('flash_message', trans('house/edit.update_successful'));

    return redirect('tin-dang-chua-duyet');
  }

  // Get list houses which are approved
  public function approvedHouseList(){
    $houseList = \App\House::where('approved', 1)->paginate(8);

    // Get all types
    $types = \App\Type::get();
    // Get all streets
    $streets = \App\Street::get();
    // Get all wards
    $wards = \App\Ward::get();
    // Get all districts
    $districts = \App\District::get();

    return view('admin.approvedhouses',array('houseList' => $houseList, 'types' => $types, 'streets' => $streets, 'wards' => $wards, 'districts' => $districts));
  }

  // View house detail which is approved
  public function viewApprovedHouse($id){
        // Check whether the house is valid and the current user is the author of the house.
    $house = House::find($id);
    if ($house == NULL)
      return redirect('/');

    // Get all types to bind to select options
    $types = array('' => trans('house/create.type_hint'));
    $types += \App\Type::getAllToSelect();

    // Get all districts to bind to select option
    $districts = array('' => trans('house/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    // We only show wards and streets when district is specific so we just initialize an empty select option with hint
    $wards = array('' => trans('house/create.ward_hint'));
    $streets = array('' => trans('house/create.street_hint'));

    // Store selected ward_id and street_id to session for display on the select options
    if (!Session::has('ward_id'))
      Session::flash('ward_id', $house->ward_id);
    if (!Session::has('street_id'))
      Session::flash('street_id', $house->street_id);

    // Get all directions to bind to select options
    $directions = array('' => trans('house/create.direction_hint'));
    $directions += \App\Direction::getAllToSelect();

    // Get all images
    $images = \App\Image::getImagesByHouseId($id);

    return view('admin.disapprove', array('types' => $types, 'districts' => $districts, 'wards' => $wards, 'streets' => $streets, 'directions' => $directions, 'house' => $house, 'images' => $images));
  }

  // Disapprove house
  public function disApproveHouse($id, Request $request){
    $validator = \Validator::make($request->all(), House::$update_rules);
    if ($validator->fails()) {
      // Store selected ward_id and street_id to session for re-display on the select options
      Session::flash('ward_id', $request->ward_id);
      Session::flash('street_id', $request->street_id);

      return redirect()->back()->withErrors($validator)->withInput();
    }

    $house = House::find($id);
    if ($house == NULL)
      return redirect('/');
    $house->type_id = $request->type_id;
    $house->city_id = 1; // For now, we just serve Hanoi market
    $house->district_id = $request->district_id;
    if ($request->ward_id != '')
      $house->ward_id = $request->ward_id;
    if ($request->street_id != '')
      $house->street_id = $request->street_id;
    $house->address = htmlspecialchars(trim($request->address)); // Convert special character to HTML entities
    $house->square = $request->square;
    $house->price = $request->price;
    $house->title = htmlspecialchars(trim($request->title));
    $house->description = htmlspecialchars(trim($request->description));
    if ($request->rooms != '')
      $house->rooms = $request->rooms;
    if ($request->toilets != '')
      $house->toilets = $request->toilets;
    if ($request->floors != '')
      $house->floors = $request->floors;
    if ($request->facade != '')
      $house->facade = $request->facade;
    if ($request->direction_id != '')
      $house->direction_id = $request->direction_id;
    if ($request->frontline != '')
      $house->frontline = $request->frontline;
    $house->owner_name = htmlspecialchars(trim($request->owner_name));
    $house->owner_phone = preg_replace('/[^0-9]/s', '', $request->owner_phone);
    if (trim($request->owner_additional_phone) != '')
      $house->owner_additional_phone = preg_replace('/[^0-9]/s', '', $request->owner_additional_phone);
    if ($request->owner_birth_year != '')
      $house->owner_birth_year = $request->owner_birth_year;
    if ($request->owner_gender != '')
      $house->owner_gender = $request->owner_gender;
    $house->status = $request->status;
    $house->approved = 0;

    // Update avatar
    $avatar_file = $request->file('avatar');
    if ($avatar_file)
    {
      $avatar = \Image::make($avatar_file);
      $extension = $avatar_file->getClientOriginalExtension();
      $ratio = $avatar->height() / $avatar->width();
      $file_name = date('YmdHis').'_'.$house->id;
      $avatar->resize(200, 200 * $ratio)->save('uploads/avatars/'.$file_name.'.'.$extension);
      // Delete old avatar
      \Storage::delete('public/uploads/avatars/'.$house->avatar);
      $house->avatar = $file_name.'.'.$extension;
    }

    // Save house
    $house->save();

    // Update images
    $image_files = $request->file('images');
    $image_count = 1; // Add to image file name

    // Get all old images
    $old_images = \App\Image::getImagesByHouseId($house->id);

    foreach ($image_files as $image_file) {
      $image_rules = array('image_file' => 'required|image|max:5000');
      $image_validator = \Validator::make(array('image_file' => $image_file), $image_rules);
      if ($image_validator->passes()) {
        $image = \Image::make($image_file);
        $image_extension = $image_file->getClientOriginalExtension();
        $image_ratio = $image->width() / $image->height();
        $image_file_name = date('YmdHis').'_'.$house->id.'_'.$image_count;
        $image->resize(500 * $image_ratio, 500)->save('uploads/images/'.$image_file_name.'.'.$image_extension);
        $image_count++;
        $house_image = new \App\Image;
        $house_image->name = $image_file_name.'.'.$image_extension;
        $house_image->house_id = $house->id;
        $house_image->save();
      }
    }

    // if user uploads at least 1 images, we delete all old images
    if ($image_count > 1)
    {
      foreach ($old_images as $old_image) {
        // remove from database
        $old_image->delete();
        // remove from filesytem
        \Storage::delete('public/uploads/images/'.$old_image->name);
      }
    }
    return redirect('tin-da-duyet');
  }
}

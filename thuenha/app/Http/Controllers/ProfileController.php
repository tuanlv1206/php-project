<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Profile;
use Session;

class ProfileController extends Controller
{
  /**
   * Show the house info form
   * @return View
   */
  public function create()
  {
    // Get all districts to bind to select option
    $districts = array('0' => trans('profile/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    return view('profile.create',array('districts' => $districts));
  }

  /**
   * Store a new house
   * @param  request
   * @return Response
   */
  public function store(Request $request)
  {
   //Get user profile info
    $id = Auth::user()->id;
    $userProfile = \App\Profile::find($id);
    if (!is_null($userProfile)) {
      // Flash a successful message
      Session::flash('flash_message', trans('profile/create.exist_profile'));

      return redirect()->back();
    }

    $validator = \Validator::make($request->all(),\App\Profile::$rules);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $profile = new Profile();
    $profile->id =Auth::user()->id;
    $profile->name = htmlspecialchars(trim($request->name));
    $profile->register_name = htmlspecialchars(trim($request->register_name));
    $profile->email = $request->email;

    $profile->mobile_phone = preg_replace('/[^0-9]/s', '', $request->mobile_phone);
    if (trim($request->home_phone) != '') {
      $profile->home_phone = preg_replace('/[^0-9]/s', '', $request->home_phone);
    }

    $profile->district_id = $request->district_id;

    if (trim($request->address) != '') {
      $profile->address = htmlspecialchars(trim($request->address));
    }
    if (trim($request->facebook) != '') {
      $profile->facebook = htmlspecialchars(trim($request->facebook));
    }
    if (trim($request->skype) != '') {
      $profile->skype = htmlspecialchars(trim($request->skype));
    }
    // Store avatar
    $avatar = \Image::make($request->file('avatar'));
    $extension = $request->file('avatar')->getClientOriginalExtension();
    $ratio = $avatar->height() / $avatar->width();
    $file_name = date('YmdHis').'_'.$profile->id;
    $avatar->resize(200, 200 * $ratio)->save('uploads/profile_avatars/'.$file_name.'.'.$extension);
    $profile->avatar = $file_name.'.'.$extension;

    $profile->save();
    // Flash a successful message
    Session::flash('flash_message',trans('profile/create.create_successful'));


    return redirect('sua-ho-so');
  }

  /**
   * Return use profile info
   * @param  request
   * @return Response
   */
  public function getEdit(Request $request)
  {
    //Get user profile info
    $id = Auth::user()->id;
    $userProfile = \App\Profile::find($id);
    if (is_null($userProfile)) {
      // Flash a successful message
      Session::flash('flash_message', trans('profile/create.no_profile'));

      return redirect()->back();
    }

    // Get all districts to bind to select option
    $districts = array('0' => trans('profile/create.district_hint'));
    $districts += \App\District::getAllToSelect();

    return view('profile.edit',array('userProfile' => $userProfile,'districts' => $districts));
  }

  /**
   * Update use profile info
   * @param  request
   * @return Response
   */
  public function PostEdit(Request $request)
  {
    $validator = \Validator::make($request->all(),\App\Profile::$update_rules);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $id = Auth::user()->id;
    $profile = \App\Profile::find($id);
    if (is_null($profile)) {
      return redirect('/');
    }

    $profile->name = htmlspecialchars(trim($request->name));
    $profile->register_name = htmlspecialchars(trim($request->register_name));
    $profile->email = $request->email;

    $profile->mobile_phone = preg_replace('/[^0-9]/s', '', $request->mobile_phone);
    if (trim($request->home_phone) != '') {
      $profile->home_phone = preg_replace('/[^0-9]/s', '', $request->home_phone);
    }

    $profile->district_id = $request->district_id;

    if (trim($request->address) != '') {
      $profile->address = htmlspecialchars(trim($request->address));
    }
    if (trim($request->facebook) != '') {
      $profile->facebook = htmlspecialchars(trim($request->facebook));
    }
    if (trim($request->skype) != '') {
      $profile->skype = htmlspecialchars(trim($request->skype));
    }
    // Update avatar
    $avatar_file = $request->file('avatar');
    if ($avatar_file)
    {
      $avatar = \Image::make($avatar_file);
      $extension = $request->file('avatar')->getClientOriginalExtension();
      $ratio = $avatar->height() / $avatar->width();
      $file_name = date('YmdHis').'_'.$profile->id;
      $avatar->resize(200, 200 * $ratio)->save('uploads/profile_avatars/'.$file_name.'.'.$extension);
            // Delete old avatar
      \Storage::delete('public/uploads/profile_avatars/'.$profile->avatar);
      $profile->avatar = $file_name.'.'.$extension;
    }

    $profile->save();

    // Flash a successful message
    Session::flash('flash_message', trans('profile/create.update_successful'));

    return redirect()->back();
  }

}

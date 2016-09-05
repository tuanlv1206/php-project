<?php

namespace App\Http\Controllers;

use Log;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Hash;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

  public function getChange(Request $request){
    return view('auth.change');
  }

  public function postChange(Request $request){

    $validator = Validator::make($request->all(), [
        'currentpassword'=>'required',
        'password' => 'required|confirmed'
    ]);

    $credentials = $request->only(
            'password', 'password_confirmation'
    );

    $user = Auth::user();
    if(Hash::check( $request->currentpassword, $user->password )) {
      $user->password = bcrypt($credentials['password']);
      $user->save();
      return redirect()->back()->with('status',trans('passwords.changepassstatus'));
    } else{
      $validator->errors()->add('currentpassword', 'Mật khẩu cũ không đúng');
      return redirect()->back()->withErrors($validator)->withInput();
    }

  }
}


<?php

namespace App\Http\Controllers\Administrator;

use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
  public function index()
  {
    $data['user'] = User::find(Auth::user()->id);
    return view('administrator.profile',$data);
  }

  public function update(Request $request)
  {

    if ($request->password != $request->confirm_password) {
      return redirect(route('administrator.profile'))->with('warning', 'Password dan Confirm Password yang anda masukkan tidak sama!');
    }

    $user = User::find(Auth::user()->id);
    $user->name=$request->nama;
    $user->email=$request->email;
    if (!is_null($request->password)) {
        $user->password=Hash::make($request->get('password'));
    }
    if (!is_null($request->foto)) {
        $user->avatar = Auth::user()->id.'.png';
        $request->file('foto')->storeAs('public/images/avatar', Auth::user()->id.'.png');
    }
    $user->save();
    return redirect(route('administrator.profile'))->with('success', 'Perubahan profil berhasil!');

  }
}

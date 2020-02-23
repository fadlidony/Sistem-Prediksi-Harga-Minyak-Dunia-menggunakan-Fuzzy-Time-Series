<?php

namespace App\Http\Controllers\Administrator;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function index()
    {
      $data['user'] = User::find(Auth::user()->id);
      return view('administrator.dashboard',$data);
    }
}

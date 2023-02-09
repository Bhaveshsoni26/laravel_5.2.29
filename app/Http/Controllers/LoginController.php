<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function deleteUser(){

        Auth::logout();
        return view('auth.login');
    }   
}

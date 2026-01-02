<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin(){
        return view('pages.home.admin');
    }

    public function user(){
        return view('pages.home.user');
    }
}

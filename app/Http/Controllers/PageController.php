<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function __construct()
    {
        ini_set('max_execution_time', 2000);
        // $this->middleware('auth'); //admin
        $this->middleware('guest');

        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');

        date_default_timezone_set('Asia/Manila');

    }

    public function login(){
    	$menu = view('partial.menu');

    	return view('welcome', compact('menu'));
    }
}

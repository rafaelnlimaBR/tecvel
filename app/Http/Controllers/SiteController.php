<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function __construct()
    {

    }

    public function home()
    {
        

        return view('site.posts.posts');
    }

    public function posts()
    {
        return view('site.posts.posts');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $dados  =   [
            "titulo"        =>  "",
            "posts"         =>  Post::all()
        ];
        return view('site.posts.posts',$dados);
    }
}

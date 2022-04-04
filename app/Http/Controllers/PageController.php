<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        $children = Child::active()->get();    
        $posts = Post::active()->promoted()->get();

        return view('dashboard',compact('posts','children'));
    }
}
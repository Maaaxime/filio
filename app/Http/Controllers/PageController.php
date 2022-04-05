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
        $promotedPosts = Post::active()->promoted()->get();
        $recentPosts = Post::active()->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('promotedPosts', 'recentPosts', 'children'));
    }
}

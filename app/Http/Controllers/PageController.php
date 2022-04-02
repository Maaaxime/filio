<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        $children = Child::active()->get();        
        return view('dashboard',compact('children'));
    }
}
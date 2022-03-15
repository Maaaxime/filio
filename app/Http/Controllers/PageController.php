<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        $roles = Role::all()->count();
        $users = User::all()->count();
        $children = Child::all()->count();
        
        return view('dashboard',compact('roles','users','children'));
    }
}
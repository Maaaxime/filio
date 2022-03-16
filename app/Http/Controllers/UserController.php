<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::get();
        $roles = Role::get();
        $filter = '';

        if ($request->isMethod('post')) {
            $filter = $request->action;
            switch ($request->action) {
                case 'all':
                    break; // Nothing to do - set by default
                default:
                Log::debug($request->action);
                    $selectedRole = Role::where('name',$request->action)->first();
                    $users = $selectedRole->users()->get();
                    break;
            }
        }

        return view('admin.users.index', compact('users', 'roles', 'filter'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my()
    {
        return $this->edit(Auth::User()->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $children = Child::active()->get();
        return view('admin.users.create', compact('roles', 'children'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $user->assignChildren($request->input('children'));

        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => $user->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $children = Child::get();

        $userRole = $user->roles->pluck('name', 'name')->all();
        $userChildren = $user->children->pluck('id')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole', 'children', 'userChildren'))->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        $children = Child::get();

        $userRole = $user->roles->pluck('name', 'name')->all();
        $userChildren = $user->children->pluck('id')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole', 'children', 'userChildren'))->with('readonly', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        switch ($request->input('action')) {
            case 'save':
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'password' => 'same:confirm-password',
                    'roles' => 'required'
                ]);

                $input = $request->all();
                if (!empty($input['password'])) {
                    $input['password'] = Hash::make($input['password']);
                } else {
                    $input = Arr::except($input, array('password'));
                }

                $user = User::find($id);
                $oldImage = 'public/images/' . $user->image;

                $user->update($input);

                DB::table('model_has_roles')->where('model_id', $id)->delete();
                $user->assignRole($request->input('roles'));

                DB::table('child_user')->where('user_id', $id)->delete();
                $user->assignChildren($request->input('children'));

                if ($request->hasFile('image')) {
                    $timestamp = Carbon::now()->isoFormat('YYYYMMDD_HHmmssSS');
                    $filename = 'User_' . $id . '_ProfilePicture_' . $timestamp . '.' . $request->image->getClientOriginalExtension();
                    $user->update(['image' => $filename]);

                    $request->image->storeAs('images',  $filename, 'public');

                    if ((Storage::exists($oldImage)) && ($oldImage != 'public/images/user.png')) {
                        Storage::delete($oldImage);
                    }
                }

                return redirect($request->url)
                    ->with('success', __('message.successUpdated', ['name' => $user->name]));
                break;
            case 'delete':
                return $this->destroy($request, $id);
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $user->name]));
    }
}

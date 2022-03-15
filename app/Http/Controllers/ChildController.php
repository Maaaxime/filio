<?php

namespace App\Http\Controllers;

use App\Models\Child;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class ChildController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Auth::user()->hasAnyPermission(['child-read-general', 'child-read-medical', 'child-read-family', 'child-read-contract']);

        $children = Child::orderBy('contract_ending_date', 'asc')->orderBy('first_name', 'asc')->paginate(20);
        return view('admin.children.index', compact('children'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my()
    {
        $children = Auth::User()->children;
        if ($children->count() == 1)
            return $this->edit($children->first()->id);

        return view('admin.children.my', compact('children'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAnyPermission(['child-create']);
        
        return view('admin.children.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->hasAnyPermission(['child-create']);

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $input = $request->all();
        $child = Child::create($input);

        if ($request->hasFile('image')) {
            $timestamp = Carbon::now()->isoFormat('YYYYMMDD_HHmmssSS');
            $filename = 'Child_' . $child->id . '_Picture_' . $timestamp . '.' . $request->image->getClientOriginalExtension();
            $child->update(['image' => $filename]);

            $request->image->storeAs('images',  $filename, 'public');
        }

        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => $child->full_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user()->hasAnyPermission([
            'child-read-general', 'child-read-medical', 'child-read-family', 'child-read-contract',
        ]);

        $child = Child::find($id);
        return view('admin.children.edit', compact('child'))->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->hasAnyPermission([
            'child-read-general', 'child-read-medical', 'child-read-family', 'child-read-contract',
            'child-update-general', 'child-update-medical', 'child-update-family', 'child-update-contract'
        ]);

        if (!(Auth::user()->hasAnyPermission([
            'child-update-general', 'child-update-medical', 'child-update-family', 'child-update-contract'
        ]))) {
            return $this->show($id);
        }


        $child = Child::find($id);
        return view('admin.children.edit', compact('child'))->with('readonly', false);
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

                Auth::user()->hasAnyPermission([
                    'child-update-general', 'child-update-medical', 'child-update-family', 'child-update-contract'
                ]);

                $this->validate($request, [
                    'first_name' => 'required',
                    'last_name' => 'required',
                ]);

                $input = $request->all();

                $child = Child::find($id);
                $oldImage = 'public/images/' . $child->image;

                $child->update($input);

                if ($request->hasFile('image')) {
                    $timestamp = Carbon::now()->isoFormat('YYYYMMDD_HHmmssSS');
                    $filename = 'Child_' . $id . '_Picture_' . $timestamp . '.' . $request->image->getClientOriginalExtension();
                    $child->update(['image' => $filename]);

                    $request->image->storeAs('images',  $filename, 'public');

                    if ((Storage::exists($oldImage)) && ($oldImage != 'public/images/child.png')) {
                        Storage::delete($oldImage);
                    }
                }

                return redirect($request->url)
                    ->with('success', __('message.successUpdated', ['name' => $child->full_name]));
                break;
            case 'delete':

                Auth::user()->hasAnyPermission(['child-delete']);
                return  $this->destroy($request, $id);
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
        Auth::user()->hasAnyPermission(['child-delete']);

        $child = Child::find($id);
        $child->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $child->full_name]));
    }
}

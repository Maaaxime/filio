<?php

namespace App\Http\Controllers;

use App\Models\Children;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class ChildrenController extends Controller
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
        Auth::user()->hasAnyPermission(['children-read-general', 'children-read-medical', 'children-read-family', 'children-read-contract']);

        $childs = Children::orderBy('contract_ending_date', 'asc')->orderBy('first_name', 'asc')->paginate(20);
        return view('childs.index', compact('childs'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my()
    {
        $childs = Auth::User()->childs;
        if ($childs->count() == 1)
            return $this->edit($childs->first()->id);

        return view('childs.my', compact('childs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasAnyPermission(['children-create']);
        
        return view('childs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->hasAnyPermission(['children-create']);

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $input = $request->all();
        $children = Children::create($input);

        if ($request->hasFile('image')) {
            $timestamp = Carbon::now()->isoFormat('YYYYMMDD_HHmmssSS');
            $filename = 'Children_' . $children->id . '_Picture_' . $timestamp . '.' . $request->image->getClientOriginalExtension();
            $children->update(['image' => $filename]);

            $request->image->storeAs('images',  $filename, 'public');
        }

        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => $children->full_name]));
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
            'children-read-general', 'children-read-medical', 'children-read-family', 'children-read-contract',
        ]);

        $children = Children::find($id);
        return view('childs.edit', compact('children'))->with('readonly', true);
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
            'children-read-general', 'children-read-medical', 'children-read-family', 'children-read-contract',
            'children-update-general', 'children-update-medical', 'children-update-family', 'children-update-contract'
        ]);

        if (!(Auth::user()->hasAnyPermission([
            'children-update-general', 'children-update-medical', 'children-update-family', 'children-update-contract'
        ]))) {
            return $this->show($id);
        }


        $children = Children::find($id);
        return view('childs.edit', compact('children'))->with('readonly', false);
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
                    'children-update-general', 'children-update-medical', 'children-update-family', 'children-update-contract'
                ]);

                $this->validate($request, [
                    'first_name' => 'required',
                    'last_name' => 'required',
                ]);

                $input = $request->all();

                $children = Children::find($id);
                $oldImage = 'public/images/' . $children->image;

                $children->update($input);

                if ($request->hasFile('image')) {
                    $timestamp = Carbon::now()->isoFormat('YYYYMMDD_HHmmssSS');
                    $filename = 'Children_' . $id . '_Picture_' . $timestamp . '.' . $request->image->getClientOriginalExtension();
                    $children->update(['image' => $filename]);

                    $request->image->storeAs('images',  $filename, 'public');

                    if ((Storage::exists($oldImage)) && ($oldImage != 'public/images/child.png')) {
                        Storage::delete($oldImage);
                    }
                }

                return redirect($request->url)
                    ->with('success', __('message.successUpdated', ['name' => $children->full_name]));
                break;
            case 'delete':

                Auth::user()->hasAnyPermission(['children-delete']);
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
        Auth::user()->hasAnyPermission(['children-delete']);

        $children = Children::find($id);
        $children->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $children->full_name]));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\Children;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        $childs = Auth::User()->childs->all();
        return view('childs.my', compact('childs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        return redirect()->route('childs.index')
            ->with('success', 'Children created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == "my") {
           return $this->my();
        }

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

                    if(Storage::exists($oldImage)) {
                        Storage::delete($oldImage);
                    }
                    
                }

                return redirect()->route('childs.index')
                    ->with('success', 'Children updated successfully');
                break;
            case 'delete':
                $this->destroy($id);
                return redirect()->route('childs.index')
                    ->with('success', 'Children deleted successfully');
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Children::find($id)->delete();
        return redirect()->route('childs.index')
            ->with('success', 'Children deleted successfully');
    }
}

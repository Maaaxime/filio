<?php

namespace App\Http\Controllers;

use App\Models\AttendanceSchedule;
use App\Models\Child;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Child::class);

        $children = Child::active()->OrderedByName()->get();
        $filter = 'active';

        $activeChildrenCount = Child::active()->count();
        $inactiveChildrenCount = Child::inactive()->count();
        $totalChildrenCount =  $activeChildrenCount + $inactiveChildrenCount;

        if ($request->isMethod('post')) {
            $filter = $request->action;
            switch ($request->action) {
                case 'all':
                    $children = Child::OrderedByName()->get();
                    break;
                case 'active':
                    // Nothing to do - set by default
                    break;
                case 'inactive':
                    $children = Child::inactive()->OrderedByName()->get();
                    break;
                default:
                    break;
            }
        }

        return view('admin.children.index', compact('children', 'filter', 'totalChildrenCount', 'activeChildrenCount', 'inactiveChildrenCount'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function my()
    {
        $this->authorize('viewAny', Child::class);

        $children = Auth::User()->children;
        if ($children->count() == 1)
            return $this->edit($children->first());

        return view('my.children.index', compact('children'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Child::class);
        return view('admin.children.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Child::class);

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
     * @return Response
     */
    public function show(Child $child)
    {
        $this->authorize('view', $child);

        return view('admin.children.edit', compact('child'))->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Child $child)
    {
        if (Auth::user()->cant('update', $child)) {
            return $this->show($child);
        }

        $this->authorize('update', $child);

        return view('admin.children.edit', compact('child'))->with('readonly', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Child $child)
    {
        $this->authorize('update', $child);

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $input = $request->all();

        $oldImage = 'public/images/' . $child->image;

        $child->update($input);

        if ($request->hasFile('image')) {
            $timestamp = Carbon::now()->isoFormat('YYYYMMDD_HHmmssSS');
            $filename = 'Child_' . $child->id . '_Picture_' . $timestamp . '.' . $request->image->getClientOriginalExtension();
            $child->update(['image' => $filename]);

            $request->image->storeAs('images',  $filename, 'public');

            if ((Storage::exists($oldImage)) && (!str_contains($oldImage,'public/images/samples'))) {
                Storage::delete($oldImage);
            }
        }

        return redirect($request->url)
            ->with('success', __('message.successUpdated', ['name' => $child->full_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, Child $child)
    {
        $this->authorize('delete', $child);

        $child->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $child->full_name]));
    }
}

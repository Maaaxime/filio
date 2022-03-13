<?php

namespace App\Http\Controllers;

use App\Models\TimeEntryType;
use Illuminate\Http\Request;

class TimeEntryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $timeEntryTypes = TimeEntryType::orderBy('name', 'asc')->paginate(20);
        return view('admin.attendances.types.index', compact('timeEntryTypes'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attendances.types.create');
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
        ]);

        if ($request->input('default')) {
            $defaultTimeEntryType = TimeEntryType::where('default', 1)->first();
            if ($defaultTimeEntryType != null) {
                $defaultTimeEntryType->default = false;
                $defaultTimeEntryType->save();
            }
        }

        $timeEntryType = TimeEntryType::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'default' => $request->input('default') ? true : false,
            'need_proof' => $request->input('need_proof') ? true : false,
            'need_permission' => $request->input('need_permission') ? true : false,
        ]);

        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => $timeEntryType->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timeEntryType = TimeEntryType::find($id);
        return view('admin.attendances.types.edit', compact('timeEntryType'))->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timeEntryType = TimeEntryType::find($id);
        return view('admin.attendances.types.edit', compact('timeEntryType'))->with('readonly', false);
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
                ]);

                if ($request->input('default')) {
                    $defaultTimeEntryType = TimeEntryType::where('id', '<>', $id)->where('default', 1)->first();
                    if ($defaultTimeEntryType != null) {
                        $defaultTimeEntryType->default = false;
                        $defaultTimeEntryType->save();
                    }
                }

                $timeEntryType = TimeEntryType::find($id);
                $timeEntryType->name = $request->input('name');
                $timeEntryType->description = $request->input('description');
                $timeEntryType->default = $request->input('default') ? true : false;
                $timeEntryType->need_proof = $request->input('need_proof') ? true : false;
                $timeEntryType->need_permission = $request->input('need_permission') ? true : false;
                $timeEntryType->save();

                return redirect($request->url)
                    ->with('success', __('message.successUpdated', ['name' => $timeEntryType->name]));
                break;
            case 'delete':
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
        $timeEntryType = TimeEntryType::find($id);
        $timeEntryType->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $timeEntryType->name]));
    }
}

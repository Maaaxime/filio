<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\TimeEntry;
use App\Models\AttendanceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $timeEntries = TimeEntry::orderBy('id', 'desc')->paginate(20);
        return view('admin.attendances.entries.index', compact('timeEntries'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $children = Child::active()->get()->pluck('full_name', 'id');;
        $attendanceTypes = AttendanceType::orderBy('default', 'desc')->get()->pluck('name', 'id');

        return view('admin.attendances.entries.create', compact('children', 'attendanceTypes'));
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
            'child' => 'required',
            'entry_type' => 'required',
            'time_start_date' => 'required',
            'time_start_time' => 'required',
        ]);

        $time_start = $request->time_start_date . ' ' . $request->time_start_time;

        $time_end = null;
        if (($request->time_end_time) && ($request->time_end_time != '00:00')) {
            $time_end = $request->time_start_date . ' ' . $request->time_end_time;
        }

        $timeEntry = TimeEntry::create([
            'child_id' => Child::findOrFail($request->child)->id,
            'type_id' => AttendanceType::findOrFail($request->entry_type)->id,
            'time_start' => $time_start,
            'system_time_start' => $time_start,
            'time_end' => $time_end,
            'system_time_end' => $time_end,
            'created_by_id' => Auth::User()->id,
            'updated_by_id' => Auth::User()->id,
            'comment' => $request->comment,
        ]);

        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => $timeEntry->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timeEntry = TimeEntry::find($id);
        return view('admin.attendances.entries.edit', compact('timeEntry'))->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timeEntry = TimeEntry::find($id);
        $children = Child::active()->get()->pluck('full_name', 'id');;
        $attendanceTypes = AttendanceType::all()->pluck('name', 'id');

        return view('admin.attendances.entries.edit', compact('timeEntry', 'children', 'attendanceTypes'))->with('readonly', false);
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
                    'child' => 'required',
                    'entry_type' => 'required',
                    'time_start_date' => 'required',
                    'time_start_time' => 'required',
                ]);

                $time_start = $request->time_start_date . ' ' . $request->time_start_time;

                $time_end = null;
                if (($request->time_end_time) && ($request->time_end_time != '00:00')) {
                    $time_end = $request->time_start_date . ' ' . $request->time_end_time;
                }

                $timeEntry = TimeEntry::findOrFail($id);
                $timeEntry->update([
                    'child_id' => Child::findOrFail($request->child)->id,
                    'type_id' => AttendanceType::findOrFail($request->entry_type)->id,
                    'time_start' => $time_start,
                    'time_end' => $time_end,
                    'updated_by_id' => Auth::User()->id,
                    'comment' => $request->comment,
                ]);

                return redirect($request->url)
                    ->with('success', __('message.successUpdated', ['name' => $timeEntry->name]));
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
        $timeEntry = TimeEntry::find($id);
        $timeEntry->deleted_by_id = Auth::User()->id;
        $timeEntry->save();

        $timeEntry->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $timeEntry->name]));
    }
}

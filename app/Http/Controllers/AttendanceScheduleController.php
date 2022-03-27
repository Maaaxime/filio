<?php

namespace App\Http\Controllers;

use App\Models\AttendanceSchedule;
use App\Http\Requests\StoreAttendanceScheduleRequest;
use App\Http\Requests\UpdateAttendanceScheduleRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AttendanceScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $attendanceSchedules = AttendanceSchedule::orderBy('name')->get();
        return view('admin.attendances.schedules.index', compact('attendanceSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.attendances.schedules.form')
            ->with('attendanceSchedule', new AttendanceSchedule())
            ->with('methodName', 'POST')
            ->with('actionRoute', 'admin.attendances.schedules.store')
            ->with('readonly', false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAttendanceScheduleRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreAttendanceScheduleRequest $request)
    {
        $attendanceSchedule = AttendanceSchedule::create([
            'name' => $request->input('name'),
            'default_time_start' => $request->input('default_time_start'),
            'default_time_end' => $request->input('default_time_end'),
            AttendanceSchedule::workingDays[0] => in_array(AttendanceSchedule::workingDays[0], $request->input('workingDays')),
            AttendanceSchedule::workingDays[1] => in_array(AttendanceSchedule::workingDays[1], $request->input('workingDays')),
            AttendanceSchedule::workingDays[2] => in_array(AttendanceSchedule::workingDays[2], $request->input('workingDays')),
            AttendanceSchedule::workingDays[3] => in_array(AttendanceSchedule::workingDays[3], $request->input('workingDays')),
            AttendanceSchedule::workingDays[4] => in_array(AttendanceSchedule::workingDays[4], $request->input('workingDays')),
            AttendanceSchedule::workingDays[5] => in_array(AttendanceSchedule::workingDays[5], $request->input('workingDays')),
            AttendanceSchedule::workingDays[6] => in_array(AttendanceSchedule::workingDays[6], $request->input('workingDays')),
        ]);

        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => $attendanceSchedule->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($id);
        return view('admin.attendances.schedules.form')
            ->with(compact('attendanceSchedule'))
            ->with('methodName', '')
            ->with('actionRoute', '')
            ->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($id);
        return view('admin.attendances.schedules.form')
            ->with(compact('attendanceSchedule'))
            ->with('methodName', 'PATCH')
            ->with('actionRoute', 'admin.attendances.schedules.update')
            ->with('readonly', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAttendanceScheduleRequest $request
     * @param $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateAttendanceScheduleRequest $request, $id)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($id);
        $attendanceSchedule->name = $request->input('name');
        $attendanceSchedule->default_time_start = $request->input('default_time_start');
        $attendanceSchedule->default_time_end = $request->input('default_time_end');
        $attendanceSchedule->monday = in_array(AttendanceSchedule::workingDays[0], $request->input('workingDays'));
        $attendanceSchedule->tuesday = in_array(AttendanceSchedule::workingDays[1], $request->input('workingDays'));
        $attendanceSchedule->wednesday = in_array(AttendanceSchedule::workingDays[2], $request->input('workingDays'));
        $attendanceSchedule->thursday = in_array(AttendanceSchedule::workingDays[3], $request->input('workingDays'));
        $attendanceSchedule->friday = in_array(AttendanceSchedule::workingDays[4], $request->input('workingDays'));
        $attendanceSchedule->saturday = in_array(AttendanceSchedule::workingDays[5], $request->input('workingDays'));
        $attendanceSchedule->sunday = in_array(AttendanceSchedule::workingDays[6], $request->input('workingDays'));
        $attendanceSchedule->save();

        return redirect($request->url)
            ->with('success', __('message.successUpdated', ['name' => $attendanceSchedule->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($id);
        $attendanceSchedule->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $attendanceSchedule->name]));
    }
}

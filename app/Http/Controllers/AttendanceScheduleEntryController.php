<?php

namespace App\Http\Controllers;

use App\Models\AttendanceScheduleEntry;
use App\Http\Requests\StoreAttendanceScheduleEntryRequest;
use App\Http\Requests\UpdateAttendanceScheduleEntryRequest;
use App\Models\AttendanceSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceScheduleEntryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendanceScheduleEntryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $scheduleId)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($scheduleId);

        $attendanceScheduleEntry = AttendanceScheduleEntry::create([
            'schedule_id' => $attendanceSchedule->id,
            'name' => $request->input('name'),
            'schedule_date' => $request->input('schedule_date'),
        ]);

        return $attendanceScheduleEntry;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendanceScheduleEntryRequest  $request
     * @param  \App\Models\AttendanceScheduleEntry  $attendanceScheduleEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::debug($id);
        Log::debug($request);

        $attendanceScheduleEntry = AttendanceScheduleEntry::findOrFail($id);
        $attendanceScheduleEntry->schedule_id = $request->input('schedule_id');
        $attendanceScheduleEntry->name = $request->input('name');
        $attendanceScheduleEntry->schedule_date = $request->input('schedule_date');
        $attendanceScheduleEntry->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendanceScheduleEntry  $attendanceScheduleEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy($scheduleId, $id)
    {

        $attendanceSchedule = AttendanceSchedule::findOrFail($scheduleId);
        $attendanceScheduleEntry = AttendanceScheduleEntry::findOrFail($id);
        $attendanceScheduleEntry->delete();
    }

    public function ajax(Request $request, $scheduleId)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($scheduleId);
        $html = view('admin.attendances.schedules.entries', compact('attendanceSchedule'))->render();
        return response()->json(compact('html'));
    }

    public function importJson($scheduleId, $type = null)
    {
        $attendanceSchedule = AttendanceSchedule::findOrFail($scheduleId);

        switch ($type) {
            case "France":
                $path = "https://etalab.github.io/jours-feries-france-data/json/metropole.json";
                break;
            case "Alsace":
                $path = "https://etalab.github.io/jours-feries-france-data/json/alsace-moselle.json";
                break;
            default:
                $path = "";
                break;
        }

        if (($path == '') || ($path == null))
            return;

        $records = json_decode(file_get_contents($path), true);

        foreach ($records as $date => $name) {
            $scheduleDate = new Carbon($date);

            if ($scheduleDate >= Carbon::now()) {
                $attendanceScheduleEntry = AttendanceScheduleEntry::where('schedule_id', '=', $attendanceSchedule->id)->where('schedule_date', '=', $scheduleDate)->first();
                if ($attendanceScheduleEntry === null) {
                    AttendanceScheduleEntry::create([
                        'schedule_id' => $attendanceSchedule->id,
                        'name' => $name,
                        'schedule_date' => $scheduleDate,
                    ]);
                }
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\AttendanceEntry;
use App\Models\AttendanceType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AttendanceEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $attendanceEntries = AttendanceEntry::orderBy('id', 'desc')->paginate(20);
        return view('admin.attendances.entries.index', compact('attendanceEntries'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $children = Child::active()->get()->pluck('full_name', 'id');
        $attendanceTypes = AttendanceType::orderBy('default', 'desc')->get()->pluck('name', 'id');

        return view('admin.attendances.entries.create', compact('children', 'attendanceTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
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

        $timeEntry = AttendanceEntry::create([
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
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $timeEntry = AttendanceEntry::find($id);
        return view('admin.attendances.entries.edit', compact('timeEntry'))->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $timeEntry = AttendanceEntry::find($id);
        $children = Child::active()->get()->pluck('full_name', 'id');
        $attendanceTypes = AttendanceType::all()->pluck('name', 'id');

        return view('admin.attendances.entries.edit', compact('timeEntry', 'children', 'attendanceTypes'))->with('readonly', false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
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

                $timeEntry = AttendanceEntry::findOrFail($id);
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
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Request $request, $id)
    {
        $timeEntry = AttendanceEntry::find($id);
        $timeEntry->deleted_by_id = Auth::User()->id;
        $timeEntry->save();

        $timeEntry->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $timeEntry->name]));
    }

    public function checkIn(Request $request, $child_id = null)
    {
        if (($child_id != '') && ($child_id != null)) {
            if (!Auth::user()->children->contains($child_id)) {
                return redirect('dashboard')
                    ->withErrors(__('message.notYourChild'));
            }

            $child = Child::findOrFail($child_id);
            if ($child->hasOpenAttendanceEntry()) {
                return redirect('dashboard')
                    ->withErrors(__('message.activeAttendanceEntryExist'));
            }

            $children = Child::where('id', '=', $child_id)->get()->pluck('full_name', 'id');
        } else {
            $children = Auth::user()->children()->get()->pluck('full_name', 'id');
        }

        $attendanceTypes = AttendanceType::allowed()->orderBy('default', 'desc')->get()->pluck('name', 'id');

        return view('my.attendances.checkin', compact('children', 'attendanceTypes'));
    }

    public function storeCheckIn(Request $request)
    {
        if (Child::findOrFail($request->child)->hasOpenAttendanceEntry()) {
            return redirect('dashboard')
                ->withErrors(__('message.activeAttendanceEntryExist'));
        }

        $this->store($request);
        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => 'Check-In']));
    }

    public function checkOut(Request $request, $childId)
    {
        if (!Child::findOrFail($childId)->hasOpenAttendanceEntry()) {
            return redirect('dashboard')
                ->withErrors(__('message.noActiveAttendanceEntryExist'));
        }

        $attendanceEntry =
            AttendanceEntry::where('child_id', '=', $childId)
            ->whereBetween('time_start', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])
            ->whereNull('time_end')->get();

        if ($attendanceEntry->count() == 0) {
            return redirect('dashboard')
                ->withErrors(__('message.noActiveAttendanceEntryExist'));
        }

        $attendanceEntry = $attendanceEntry->first();
        return view('my.attendances.checkout', compact('attendanceEntry'));
    }

    public function storeCheckOut(Request $request, $entryId)
    {
        $this->validate($request, [
            'time_end_time' => 'required',
        ]);

        $timeEntry = AttendanceEntry::findOrFail($entryId);


        $time_end = null;
        if (($request->time_end_time) && ($request->time_end_time != '00:00')) {
            $time_end = $timeEntry->time_start_date . ' ' . $request->time_end_time;
        }

        if ($time_end < $timeEntry->time_start) {
            return redirect($request->url)
                ->withErrors(__('message.timeEndShouldBeGreaterThanStart'));
        }

        $timeEntry->update([
            'time_end' => $time_end,
            'updated_by_id' => Auth::User()->id,
            'comment' => $request->comment,
        ]);

        return redirect($request->url)
            ->with('success', __('message.successUpdated', ['name' => 'Check-Out']));
    }
}

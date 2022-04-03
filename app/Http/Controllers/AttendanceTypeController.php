<?php

namespace App\Http\Controllers;

use App\Models\AttendanceType;
use Illuminate\Http\Request;

class AttendanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attendanceTypes = AttendanceType::orderBy('name', 'asc')->paginate(20);
        return view('admin.attendances.types.index', compact('attendanceTypes'))
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
            $defaultAttendanceType = AttendanceType::where('default', 1)->first();
            if ($defaultAttendanceType != null) {
                $defaultAttendanceType->default = false;
                $defaultAttendanceType->save();
            }
        }

        $attendanceType = AttendanceType::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'default' => $request->input('default') ? true : false,
            'need_proof' => $request->input('need_proof') ? true : false,
            'need_permission' => $request->input('need_permission') ? true : false,
        ]);

        return redirect($request->url)
            ->with('success', __('message.successCreated', ['name' => $attendanceType->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendanceType = AttendanceType::find($id);
        return view('admin.attendances.types.edit', compact('attendanceType'))->with('readonly', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendanceType = AttendanceType::find($id);
        return view('admin.attendances.types.edit', compact('attendanceType'))->with('readonly', false);
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
                    $defaultAttendanceType = AttendanceType::where('id', '<>', $id)->where('default', 1)->first();
                    if ($defaultAttendanceType != null) {
                        $defaultAttendanceType->default = false;
                        $defaultAttendanceType->save();
                    }
                }

                $attendanceType = AttendanceType::find($id);
                $attendanceType->name = $request->input('name');
                $attendanceType->description = $request->input('description');
                $attendanceType->color = $request->input('color');
                $attendanceType->default = $request->input('default') ? true : false;
                $attendanceType->need_proof = $request->input('need_proof') ? true : false;
                $attendanceType->need_permission = $request->input('need_permission') ? true : false;
                $attendanceType->save();

                return redirect($request->url)
                    ->with('success', __('message.successUpdated', ['name' => $attendanceType->name]));
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
        $attendanceType = AttendanceType::find($id);
        $attendanceType->delete();

        return redirect($request->url)
            ->with('success', __('message.successDeleted', ['name' => $attendanceType->name]));
    }
}

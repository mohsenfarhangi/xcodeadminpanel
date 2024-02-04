<?php

namespace App\Http\Controllers;

use App\DataTables\DentistsDataTable;
use App\Http\Requests\Dentist\StoreRequest;
use App\Models\AttendanceTime;
use App\Models\Dentist;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class DentistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(DentistsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.dentist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $dentist = Dentist::create([
            'first_name'          => $request->input('first_name'),
            'last_name'           => $request->input('last_name'),
            'dr_number'           => $request->input('dr_number'),
            'percent'             => $request->input('percent'),
            'birth_date'          => $request->input('birth_date'),
            'gender'              => $request->input('gender'),
            'bank_name'           => $request->input('bank_name'),
            'bank_card_number'    => $request->input('bank_card_number'),
            'bank_account_number' => $request->input('bank_account_number'),
            'speciality'          => $request->input('speciality'),
            'conversance'         => $request->input('conversance'),
            'university'          => $request->input('university'),
            'presenter'           => $request->input('presenter'),
            'dossier'             => $request->input('dossier'),
            'insuranceNum'        => $request->input('insuranceNum'),
            'phone'               => $request->input('phone'),
            'mobile'              => $request->input('mobile'),
            'dentist_abstract'    => $request->input('dentist_abstract'),
            'dentist_visit_sms'   => $request->input('dentist_visit_sms'),
            'work_address'        => $request->input('work_address'),
            'home_address'        => $request->input('home_address'),
            'sort'                => $request->input('sort'),
        ]);
        $this->editAttendanceTime($request, $dentist);

        return redirect()->route('dentist.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dentist $dentist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dentist $dentist, DentistsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.dentist.create', ['dentist' => $dentist]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dentist $dentist)
    {
        $update = $dentist->update([
            'first_name'          => $request->input('first_name'),
            'last_name'           => $request->input('last_name'),
            'dr_number'           => $request->input('dr_number'),
            'percent'             => $request->input('percent'),
            'birth_date'          => jalaliToMiladi($request->input('birth_date'),'Y/m/d','Y-m-d H:i:s'),
            'gender'              => $request->input('gender'),
            'bank_name'           => $request->input('bank_name'),
            'bank_card_number'    => $request->input('bank_card_number'),
            'bank_account_number' => $request->input('bank_account_number'),
            'speciality'          => $request->input('speciality'),
            'conversance'         => $request->input('conversance'),
            'university'          => $request->input('university'),
            'presenter'           => $request->input('presenter'),
            'dossier'             => $request->input('dossier'),
            'insuranceNum'        => $request->input('insuranceNum'),
            'phone'               => $request->input('phone'),
            'mobile'              => $request->input('mobile'),
            'dentist_abstract'    => $request->input('dentist_abstract'),
            'dentist_visit_sms'   => $request->input('dentist_visit_sms'),
            'work_address'        => $request->input('work_address'),
            'home_address'        => $request->input('home_address'),
            'sort'                => $request->input('sort'),
        ]);

        $this->editAttendanceTime($request, $dentist);

        return redirect()->route('dentist.edit', ['dentist' => $dentist->id]);
    }

    public function editAttendanceTime(Request $request, Dentist $dentist)
    {
        foreach ($dentist->attendance_times as $attendance_time) {
            $attendance_time->delete();
        }
        $data = [];
        foreach ($request->input('saturday') as $key => $time) {
            $day = 'saturday';
            if (!empty($time['start']) && !empty($time['end'])) {
                $dentist->attendance_times()->save(new AttendanceTime([
                    'start_time'  => $time['start'],
                    'end_time'    => $time['end'],
                    'type'        => $key,
                    'day_in_week' => $day
                ]));
            }
        }
        foreach ($request->input('sunday') as $key => $time) {
            $day = 'sunday';
            if (!empty($time['start']) && !empty($time['end'])) {
                $dentist->attendance_times()->save(new AttendanceTime([
                    'start_time'  => $time['start'],
                    'end_time'    => $time['end'],
                    'type'        => $key,
                    'day_in_week' => $day
                ]));
            }
        }
        foreach ($request->input('monday') as $key => $time) {
            $day = 'monday';
            if (!empty($time['start']) && !empty($time['end'])) {
                $dentist->attendance_times()->save(new AttendanceTime([
                    'start_time'  => $time['start'],
                    'end_time'    => $time['end'],
                    'type'        => $key,
                    'day_in_week' => $day
                ]));
            }
        }
        foreach ($request->input('tuesday') as $key => $time) {
            $day = 'tuesday';
            if (!empty($time['start']) && !empty($time['end'])) {
                $dentist->attendance_times()->save(new AttendanceTime([
                    'start_time'  => $time['start'],
                    'end_time'    => $time['end'],
                    'type'        => $key,
                    'day_in_week' => $day
                ]));
            }
        }
        foreach ($request->input('wednesday') as $key => $time) {
            $day = 'wednesday';
            if (!empty($time['start']) && !empty($time['end'])) {
                $dentist->attendance_times()->save(new AttendanceTime([
                    'start_time'  => $time['start'],
                    'end_time'    => $time['end'],
                    'type'        => $key,
                    'day_in_week' => $day
                ]));
            }
        }
        foreach ($request->input('thursday') as $key => $time) {
            $day = 'thursday';
            if (!empty($time['start']) && !empty($time['end'])) {
                $dentist->attendance_times()->save(new AttendanceTime([
                    'start_time'  => $time['start'],
                    'end_time'    => $time['end'],
                    'type'        => $key,
                    'day_in_week' => $day
                ]));
            }
        }
        foreach ($request->input('friday') as $key => $time) {
            $day = 'friday';
            if (!empty($time['start']) && !empty($time['end'])) {
                $dentist->attendance_times()->save(new AttendanceTime([
                    'start_time'  => $time['start'],
                    'end_time'    => $time['end'],
                    'type'        => $key,
                    'day_in_week' => $day
                ]));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dentist $dentist)
    {
        foreach ($dentist->attendance_times as $attendance_time) {
            $attendance_time->delete();
        }

        $dentist->delete();

        return redirect()->route('dentist.create');
    }
}

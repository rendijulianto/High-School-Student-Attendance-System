<?php

namespace App\Http\Controllers;

use App\Models\{PresenceDetail, Presence,  Grade, Student, Schedule, GradeStudent};
use Illuminate\Http\Request;
// StorePresenceRequest
use App\Http\Requests\StorePresenceRequest;
use App\Http\Requests\StorePresenceDetailRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use DB;
class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search') ?? '';
        $grades = Auth::user()->teaches()->with('schedules')->get()->map(function ($teach) {
            return $teach->schedules->map(function ($schedule) {
                if ($schedule->teach->teacher_id == Auth::user()->id) {
                    return (object) [
                        'schedule_id' => $schedule->id,
                        'grade' => $schedule->grade->level . ' ' . $schedule->grade->major . ' ' . $schedule->grade->class . ' ' . $schedule->grade->school_year,
                        'subject' => $schedule->teach->subject->name,
                    ];
                }

            });
        })->flatten()->unique('schedule_id')->values();
        return Inertia::render('Presence/Index', ['grades' => $grades,  'search' => $search, 'url' => $request->url()]);
    }

    public function view($schedule, Request $request)
    {
        $search = $request->get('search') ?? '';
        $presences = Presence::where('schedule_id', $schedule)->where('material', 'like', '%' . $search . '%')->with('schedule.grade')->paginate(10)->withQueryString();
        return Inertia::render('Presence/View', ['presences' => $presences, 'schedule_id' => $schedule, 'search' => $search, 'url' => $request->url()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($schedule, Request $request)
    {
        $schedule = Schedule::find($schedule);
        return Inertia::render('Presence/Create', ['schedule_id' => $schedule]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store($schedule, StorePresenceRequest $request)
    {
        DB::beginTransaction();
        try {
            $presence = Presence::create([
                    'schedule_id' => $schedule,
                    'material' => $request->material,
                    'date' => $request->date,
            ]);
            DB::commit();
            return redirect()->route('presences.view', $schedule)->with('message', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return Redirect::route('presences.create',  [
                'schedule' => $schedule,
            ])->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PresenceDetail $presenceDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detail(Presence $presence, Schedule  $schedule, Grade $grade, Request $request)
    {
        $gradeStudents = GradeStudent::where('grade_id', $grade->id)->with('student')->whereHas('student', function ($query) use ($request) {
            $query->orderBy('name', 'asc')->where('name', 'like', '%' . $request->get('search') . '%' ?? '');
        })->get();
        return Inertia::render('Presence/Detail', ['presence' => $presence, 'schedule' => $schedule, 'grade' => $grade, 'gradeStudents' => $gradeStudents]);
    }

    public function detailStore(Presence $presence, Schedule  $schedule, Grade $grade, StorePresenceDetailRequest $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->presences as $pre)
            {
                $presenceDetail = PresenceDetail::create([
                    'presence_id' => $presence->id,
                    'student_id' => $pre['student_id'],
                    'status' => $pre['status'],
                    'date' => $presence->date,
                ]);
                if ($pre['status'] == 'H') {
                    $student = Student::find($pre['student_id']);
                    dispatch(new \App\Jobs\SendEmailConfirmationJob($student, $presence));
                }
            }
            DB::commit();
            return redirect()->route('presences.view', [
                'schedule' => $schedule->id,
            ])->with('message', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return Redirect::route('presences.detail',  [
                'presence' => $presence->id,
                'schedule' => $schedule->id,
                'grade' => $grade->id,
            ])->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PresenceDetail $presenceDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        $presence->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Inertia::location(route('presences.view', $presence->schedule_id));
    }
}

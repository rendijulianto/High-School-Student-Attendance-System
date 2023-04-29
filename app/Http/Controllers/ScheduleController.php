<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Grade, Student, Schedule,Subject,Teach};
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreScheduleRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($grade_id, Request $request)
    {
        $grade = Grade::findOrFail($grade_id);
    
        $search = $request->get('search') ?? '';

        $schedules = $grade->schedules()->latest()->where('teach_id', 'like', '%' . $search . '%')->orWhere('grade_id', 'like', '%' . $search . '%')->where('grade_id', $grade_id)->with('teach.teacher','teach.subject', 'grade')->WhereHas('grade', function ($query) use ($search) {
            $query->where('class', 'like', '%' . $search . '%');
        })->paginate(10)->withQueryString();


        // dd($schedules->toArray());

        return Inertia::render('Schedule/Index', ['schedules' => $schedules, 'search' => $search, 'url' => $request->url(), 'grade_id' => $grade_id, 'grade' => $grade]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($grade_id)
    {
        $subjects = Subject::orderBy('name')->with('teachers')->get();
        return Inertia::render('Schedule/Create', ['subjects' => $subjects, 'grade_id' => $grade_id]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store($grade_id, StoreScheduleRequest $request)
    {
        DB::beginTransaction();
        try {
            $grade = Grade::findOrFail($grade_id);
            $schedules = $request->input('schedules');
            foreach ($schedules as $schedule) {
               $subject_id = $schedule['subject_id'];
                $teacher_id = $schedule['teacher_id'];
                $teach = Teach::where('subject_id', $subject_id)->where('teacher_id', $teacher_id)->first();
                if (!$teach) {
                    $teach = Teach::create([
                        'subject_id' => $subject_id,
                        'teacher_id' => $teacher_id,
                    ]);
                }
                $grade->schedules()->create([
                    'teach_id' => $teach->id,
                ]);
            }
            DB::commit();
            return Redirect::route('schedules.index', [
                'grade' => $grade_id
            ])->with('message', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return Redirect::back()->withInput()->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Redirect::route('schedules.index', [
            'grade' => $schedule->grade_id
        ]);
    }

}

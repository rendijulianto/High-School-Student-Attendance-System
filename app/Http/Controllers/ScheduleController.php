<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Grade, Student, Schedule};
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

        $schedules = $grade->schedules()->latest()->where('teach_id', 'like', '%' . $search . '%')->orWhere('grade_id', 'like', '%' . $search . '%')->where('grade_id', $grade_id)->with('teacher', 'grade')->whereHas('teacher', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->orWhereHas('grade', function ($query) use ($search) {
            $query->where('class', 'like', '%' . $search . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Schedule/Index', ['schedules' => $schedules, 'search' => $search, 'url' => $request->url(), 'grade_id' => $grade_id, 'grade' => $grade]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($grade_id)
    {
        $students = Student::whereDoesntHave('grades', function ($query) use ($grade_id) {
            $query->where('grade_id', $grade_id);
        })->orderBy('name')->get();
        return Inertia::render('Schedule/Create', ['students' => $students, 'grade_id' => $grade_id]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store($grade_id, StoreScheduleRequest $request)
    {
        DB::beginTransaction();
        try {
            $grade = Grade::findOrFail($grade_id);
            // $grade->students tambahkan yang lama jangan dihapus
            foreach ($request->student_id as $student_id) {
                $schedule = new Schedule();
                $schedule->grade_id = $grade_id;
                $schedule->student_id = $student_id;
                $schedule->save();
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

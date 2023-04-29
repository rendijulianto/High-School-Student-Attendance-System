<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Grade, Student, GradeStudent};
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreGradeStudentRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class GradeStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($grade_id, Request $request)
    {
    
        $grade = Grade::findOrFail($grade_id);

        $search = $request->get('search') ?? '';

        $gradeStudents = GradeStudent::latest()->where('grade_id', 'like', '%' . $search . '%')->orWhere('student_id', 'like', '%' . $search . '%')->where('grade_id', $grade_id)->with('grade', 'student')->whereHas('grade', function ($query) use ($search) {
            $query->where('class', 'like', '%' . $search . '%');
        })->orWhereHas('student', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('GradeStudent/Index', ['gradeStudents' => $gradeStudents, 'search' => $search, 'url' => $request->url(), 'grade_id' => $grade_id, 'grade' => $grade]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($grade_id)
    {
        $students = Student::whereDoesntHave('grades', function ($query) use ($grade_id) {
            $query->where('grade_id', $grade_id);
        })->orderBy('name')->get();
        return Inertia::render('GradeStudent/Create', ['students' => $students, 'grade_id' => $grade_id]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store($grade_id, StoreGradeStudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $grade = Grade::findOrFail($grade_id);
            // $grade->students tambahkan yang lama jangan dihapus
            foreach ($request->student_id as $student_id) {
                $gradeStudent = new GradeStudent();
                $gradeStudent->grade_id = $grade_id;
                $gradeStudent->student_id = $student_id;
                $gradeStudent->save();
            }
            DB::commit();
            return Redirect::route('gradeStudents.index', [
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
    public function destroy(GradeStudent $gradeStudent)
    {
        $gradeStudent->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Redirect::route('gradeStudents.index', [
            'grade' => $gradeStudent->grade_id
        ]);
    }

}

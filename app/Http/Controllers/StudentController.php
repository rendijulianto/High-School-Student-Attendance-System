<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreStudentRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search') ?? '';
        $students = Student::latest()->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('nis', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        $totalData = Student::count();
        return Inertia::render('Student/Index', ['students' => $students, 'totalData' => $totalData, 'search' => $search, 'url' => $request->url()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Student/Create');
    }

    /**
     * Import student from excel.
     */
    public function import()
    {
        return Inertia::render('Student/Import');

    }


    /**
     * Import student from excel.
     */
    public function importStore(Request $request)
    {
        // ambil file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
        $path = $request->file('file')->getRealPath();

        $data = Excel::import(new \App\Imports\StudentsImport, $path);
        return Redirect::route('students.index')->with('message', 'Berhasil menambahkan data');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        DB::beginTransaction();
        try {


            $student = Student::create(
              [
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'nis' => $request->nis,
                'gender' => $request->gender,
              ]
            );


            // dispatch(new \App\Jobs\SendEmailRegisterStudentQueueJob($student->id, $password));
            DB::commit();
            return Redirect::route('students.index')->with('message', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return Redirect::route('students.create')->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return Inertia::render('Student/Edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        DB::beginTransaction();
        try {
            $student->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'nis' => $request->nis,
            ]);
            DB::commit();
            return Redirect::route('students.index')->with('message', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            DB::rollback();
            return Redirect::route('students.edit', $student->id)->with('error', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Inertia::location(route('students.index'));
    }
}

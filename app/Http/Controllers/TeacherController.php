<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
// StoreTeacherRequest
use App\Http\Requests\StoreTeacherRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search') ?? '';
        $teachers = Teacher::latest()->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->paginate(100);
        $totalData = Teacher::count();
        return Inertia::render('Teacher/Index', ['teachers' => $teachers, 'search' => $search, 'totalData' => $totalData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Teacher/Create');
    }

    /**
     * Import teacher from excel.
     */
    public function import()
    {
        return Inertia::render('Teacher/Import');

    }


    /**
     * Import teacher from excel.
     */
    public function importStore(Request $request)
    {
        // ambil file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
        $path = $request->file('file')->getRealPath();

        $data = Excel::import(new \App\Imports\TeachersImport, $path);
        return Redirect::route('teachers.index')->with('message', 'Berhasil menambahkan data');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
            $password = rand(100000, 999999);
            $teacher = Teacher::create(
              [
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($password),
                'nip' => $request->nip,
                'gender' => $request->gender,
              ]
            );
      

            dispatch(new \App\Jobs\SendEmailRegisterTeacherQueueJob($teacher->id, $password));
            DB::commit();
            return Redirect::route('teachers.index')->with('message', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return Redirect::route('teachers.create')->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return Inertia::render('Teacher/Edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            $teacher->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'nip' => $request->nip,
            ]);
            DB::commit();
            return Redirect::route('teachers.index')->with('message', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            DB::rollback();
            return Redirect::route('teachers.edit', $teacher->id)->with('error', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Inertia::location(route('teachers.index'));
    }
}

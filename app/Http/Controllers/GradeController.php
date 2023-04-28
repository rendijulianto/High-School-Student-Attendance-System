<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreGradeRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search') ?? '';
        $grades = Grade::latest()->where('level', 'like', '%' . $search . '%')->orWhere('major', 'like', '%' . $search . '%')->orWhere('class', 'like', '%' . $search . '%')->orWhere('school_year', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        $totalData = Grade::count();
        return Inertia::render('Grade/Index', ['grades' => $grades, 'totalData' => $totalData, 'search' => $search, 'url' => $request->url()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Grade/Create');
    }

    /**
     * Import grade from excel.
     */
    public function import()
    {
        return Inertia::render('Grade/Import');

    }


    /**
     * Import grade from excel.
     */
    public function importStore(Request $request)
    {
        // ambil file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
        $path = $request->file('file')->getRealPath();

        $data = Excel::import(new \App\Imports\GradesImport, $path);
        return Redirect::route('grades.index')->with('message', 'Berhasil menambahkan data');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        DB::beginTransaction();
        try {


            $grade = Grade::create(
              [
                'level' => $request->level,
                'major' => $request->major,
                'class' => $request->class,
                'school_year' => $request->school_year,
              ]
            );


            // dispatch(new \App\Jobs\SendEmailRegisterGradeQueueJob($grade->id, $password));
            DB::commit();
            return Redirect::route('grades.index')->with('message', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return Redirect::route('grades.create')->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        return Inertia::render('Grade/Edit', ['grade' => $grade]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        DB::beginTransaction();
        try {
            $grade->update([
               'level' => $request->level,
                'major' => $request->major,
                'class' => $request->class,
                'school_year' => $request->school_year,
            ]);
            DB::commit();
            return Redirect::route('grades.index')->with('message', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            DB::rollback();
            return Redirect::route('grades.edit', $grade->id)->with('error', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Inertia::location(route('grades.index'));
    }
}

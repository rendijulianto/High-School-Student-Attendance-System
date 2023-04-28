<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreSubjectRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search') ?? '';
        $subjects = Subject::latest()->where('name', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        $totalData = Subject::count();
        return Inertia::render('Subject/Index', ['subjects' => $subjects, 'totalData' => $totalData, 'search' => $search, 'url' => $request->url()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Subject/Create');
    }

    /**
     * Import subject from excel.
     */
    public function import()
    {
        return Inertia::render('Subject/Import');

    }


    /**
     * Import subject from excel.
     */
    public function importStore(Request $request)
    {
        // ambil file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
        $path = $request->file('file')->getRealPath();

        $data = Excel::import(new \App\Imports\SubjectsImport, $path);
        return Redirect::route('subjects.index')->with('message', 'Berhasil menambahkan data');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        DB::beginTransaction();
        try {


            $subject = Subject::create(
              [
                'name' => $request->name,
              ]
            );


            // dispatch(new \App\Jobs\SendEmailRegisterSubjectQueueJob($subject->id, $password));
            DB::commit();
            return Redirect::route('subjects.index')->with('message', 'Berhasil menambahkan data');
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return Redirect::route('subjects.create')->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return Inertia::render('Subject/Edit', ['subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        DB::beginTransaction();
        try {
            $subject->update([
                'name' => $request->name,
            ]);
            DB::commit();
            return Redirect::route('subjects.index')->with('message', 'Berhasil mengubah data');
        } catch (\Throwable $th) {
            DB::rollback();
            return Redirect::route('subjects.edit', $subject->id)->with('error', 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Inertia::location(route('subjects.index'));
    }
}

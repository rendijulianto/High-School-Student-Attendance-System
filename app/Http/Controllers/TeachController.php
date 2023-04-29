<?php

namespace App\Http\Controllers;

use App\Models\{Teach, Subject, Teacher};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreTeachRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TeachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($teacher_id, Request $request)
    {
        $teacher = Teacher::findOrFail($teacher_id);

        $search = $request->get('search') ?? '';
        $teaches = Teach::latest()->where('teacher_id', $teacher_id)->with('subject', 'teacher')->whereHas('subject', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10)->withQueryString();
      
        return Inertia::render('Teach/Index', ['teaches' => $teaches, 'search' => $search, 'url' => $request->url(), 'teacher_id' => $teacher_id, 'teacher' => $teacher]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($teacher_id)
    {
        $subjects = Subject::whereDoesntHave('teachers', function ($query) use ($teacher_id) {
            $query->where('teacher_id', $teacher_id);
        })->orderBy('name')->get();
        return Inertia::render('Teach/Create', ['subjects' => $subjects, 'teacher_id' => $teacher_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($teacher_id, StoreTeachRequest $request)
    {
        DB::beginTransaction();
        try {
            $teacher = Teacher::findOrFail($teacher_id);
            // $teacher->subjects tambahkan yang lama jangan dihapus
            foreach ($request->subject_id as $subject_id) {
                $teach = new Teach();
                $teach->teacher_id = $teacher_id;
                $teach->subject_id = $subject_id;
                $teach->save();
            }
            DB::commit();
            return Redirect::route('teaches.index', [
                'teacher' => $teacher_id
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
    public function show(Teach $teach)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teach $teach)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teach $teach)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teach $teach)
    {
        $teach->delete();
        request()->session()->flash('message', 'Berhasil menghapus data');
        return Redirect::route('teaches.index', [
            'teacher' => $teach->teacher_id
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\{PresenceDetail, Presence,  Grade, Student, Schedule};
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
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
                return (object) [
                    'schedule_id' => $schedule->id,
                    'grade' => $schedule->grade->level . ' ' . $schedule->grade->major . ' ' . $schedule->grade->class . ' ' . $schedule->grade->school_year,
                    'subject' => $schedule->teach->subject->name,
                ];
            });
        })->flatten()->unique('schedule_id')->values();
        return Inertia::render('Presence/Index', ['grades' => $grades,  'search' => $search, 'url' => $request->url()]);
    }

    public function view(Schedule $schedule)
    {
        dd($schedule);
        return Inertia::render('Presence/View', ['schedule' => $schedule, 'students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(PresenceDetail $presenceDetail)
    {
        //
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
    public function destroy(PresenceDetail $presenceDetail)
    {
        //
    }
}

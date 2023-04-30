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
        $presences = Presence::where('schedule_id', $schedule)->where('material', 'like', '%' . $search . '%')->paginate(10)->withQueryString();
        return Inertia::render('Presence/View', ['presences' => $presences, 'schedule_id' => $schedule, 'search' => $search, 'url' => $request->url()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($schedule, Request $request)
    {
        $schedule = Schedule::find($schedule);
        return Inertia::render('Presence/Create', ['schedule' => $schedule]);
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

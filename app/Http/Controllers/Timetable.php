<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Timetable extends Controller
{
    public function view()
    {
        return view('timetable', [
            'monday' => \App\Models\Timetable::query()->where('timetables.weekday', 'Monday')->get('*'),
            'tuesday' => \App\Models\Timetable::query()->where('timetables.weekday', 'Tuesday')->get('*'),
            'wednesday' => \App\Models\Timetable::query()->where('timetables.weekday', 'Wednesday')->get('*'),
            'thursday' => \App\Models\Timetable::query()->where('timetables.weekday', 'Thursday')->get('*'),
            'friday' => \App\Models\Timetable::query()->where('timetables.weekday', 'Friday')->get('*'),
        ]);
    }

    public function add()
    {
        return view('addlesson', [
            'subjects' => auth()->user()->Subject()->get(),
        ]);
    }

    public function create(Request $request)
    {
        \App\Models\Timetable::query()->create(
            [
                'start' => $request->input('start'),
                'end' => $request->input('end'),
                'subject_id' => $request->input('subject'),
                'user_id' => auth()->id(),
                'weekday' => $request->input('weekday'),
                'room' => $request->input('room')
            ]
        );

        return redirect(route('timetable'));
    }
}

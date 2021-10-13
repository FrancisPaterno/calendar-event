<?php

namespace App\Http\Controllers;

use App\Models\WeekDays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeekDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weekday = WeekDays::all()->first();
        return  $weekday;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $weekday = WeekDays::create(
            $this->validate(
                $request,
                [
                    'EventName' => ['required', 'max:500'],
                    'DateFrom' => 'sometimes',
                    'DateTo' => 'sometimes',
                    'Mon' => 'sometimes',
                    'Tue' =>  'sometimes',
                    'Wed' =>  'sometimes',
                    'Thu' => 'sometimes',
                    'Fri' => 'sometimes',
                    'Sat' =>  'sometimes',
                    'Sun' =>  'sometimes'
                ]
            )

        );
        return $weekday;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeekDays  $weekDays
     * @return \Illuminate\Http\Response
     */
    public function show(WeekDays $weekDays)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeekDays  $weekDays
     * @return \Illuminate\Http\Response
     */
    public function edit(WeekDays $weekDays)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WeekDays  $weekDays
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeekDays $weekday)
    {
        Log::debug($weekday);
        if ($weekday) {
            $weekday->update(
                $this->validate(
                    $request,
                    [
                        'EventName' => ['required', 'max:500'],
                        'DateFrom' => 'sometimes',
                        'DateTo' => 'sometimes',
                        'Mon' => 'sometimes',
                        'Tue' =>  'sometimes',
                        'Wed' =>  'sometimes',
                        'Thu' => 'sometimes',
                        'Fri' => 'sometimes',
                        'Sat' =>  'sometimes',
                        'Sun' =>  'sometimes'
                    ]
                )
            );
            return $weekday;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeekDays  $weekDays
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeekDays $weekday)
    {
        if ($weekday) {
            $weekday->delete();
            return $weekday;
        }
    }
}

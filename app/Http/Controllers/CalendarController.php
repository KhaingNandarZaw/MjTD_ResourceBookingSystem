<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Calendar;

class CalendarController extends Controller
{
    public function index()
    {
        $reservations=Reservation::get();
        return view('la.Calendar.index',compact('reservations'));

    }
}

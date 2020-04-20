<?php
/**
 * Controller generated using LaraAdmin
 * Help: http://laraadmin.com
 * LaraAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Dwij IT Solutions
 * Developer Website: http://dwijitsolutions.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Reservation;
use DB;
use Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $now_str = \Carbon\Carbon::now()->format('Y-m-d');
        $bookinglist = DB::table('reservations')
                    ->whereDate('begin_date', '>=', $now_str)
                    ->get();
        $user = Auth::user();
        $sql = "SELECT reservations.* FROM reservations left join reservations_users on reservations_users.reservations_id = reservations.id
        where reservations_users.user_id = 1 or reservations.owner_id = 1";

        $query = DB::table(DB::raw("($sql) as catch"));
        $reservations_list = $query->get();

        foreach ($bookinglist as $booking) {
            $booking->resource = DB::table('resources')->where('id', $booking->resource_id)->whereNull('deleted_at')->first();
        }

        $reservations=Reservation::get();
        
        return view('la.dashboard',compact('bookinglist','reservations_list','reservations'));
    }
}
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
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Accessory;
use App\Models\Reservations_invitee;
use App\Models\Reservation_Accessory;
use App\Models\Reservations_user;
use App\Models\Resource;
use App\Models\All_Schedule;
use App\SlotZero;
use Illuminate\Support\Facades\Input;
use Calendar;
use Redirect;


use Carbon\Carbon;

class ReservationsController extends Controller
{
    public $show_action = true;
    
    /**
     * Display a listing of the Reservations.
     *
     * @return mixed
     */
    public function index()
    {
        $module = Module::get('Reservations');
        $all_schedule=All_Schedule::All();
        
        if(Module::hasAccess($module->id)) {
            return View('la.reservations.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => Module::getListingColumns('All_Schedules'),
                'module' => $module
            ])->with('all_schedule',$all_schedule);
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Show the form for creating a new reservation.
     *
     * @return mixed
     */
    public function create()
    {
       
    }
    
    /**
     * Store a newly created reservation in database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    
    public function store(Request $request)
    {
        $reservation = Reservation::create([
            'resource_id' => $request['resource'],
            'title' => $request['title'],
            'description' => $request['description'],
            'owner_id' =>$request['owner_id'],
            'begin_date' => $request['begin_date'],
            'begin_time' => $request['begin_time'],
            'end_date' => $request['end_date'],
            'end_time' => $request['end_time'],
            'no_of_participant' => $request['no_of_participant']
        ]);
       
        $reservations_invitees=Reservations_invitee::create([
            'email' => $request['invitees'],
            'reservations_id' =>$reservation['id']
        ]);

        if($request->input('user_id')){
            foreach($request->input('user_id') as $user)
            {
                $reservations_user=Reservations_user::create([
            
                    'user_id' => $user,
                    'reservations_id' =>$reservation['id']
                ]);
            }
        }
        $accessories_id = $request->accessories_id;  
        $quantity = $request->quantity;       

        foreach($accessories_id as $key => $accessories)
        {
            $input['accessories_id'] = $accessories;
            $input['quantity'] = $quantity[$key];
            $input['reservations_id']=$reservation['id'];
            Reservation_accessory::create($input);

        }     
           
        return redirect()->route('admin.reservations.show', ['id' => $request->schedule_id]);
    }
    


    public function getstartendtime(Request $request)
    {
       
        $sid = $request->scheduleidone;
        $day = $request->day;
        $same_layout = $request->same_layout;

        if(!$same_layout){
            $for_same_day= DB::table('slot_zeros')
                        ->select('*')
                        ->where('schedule_id',$sid)
                        ->orderBy('created_at', 'desc')
                        ->first();
        
            switch ($day) {
                case "0":
                    $betimes=($for_same_day->time_slot_0);
                    break;
                case "1":
                    $betimes=($for_same_day->time_slot_1);
                    break;
                case "2":
                    $betimes=($for_same_day->time_slot_2);
                    break;
                case "3":
                    $betimes=($for_same_day->time_slot_3);
                    break;
                case "4":
                    $betimes=($for_same_day->time_slot_4);
                    break;
                case "5":
                    $betimes=($for_same_day->time_slot_5);
                    break;
                case "6":
                    $betimes=($for_same_day->time_slot_6);
                    break;
                default:
                    echo"null";
            }
        }else{
            $for_same_day= DB::table('slot_ones')
                        ->select('*')
                        ->where('schedule_id',$sid)
                        ->orderBy('created_at', 'desc')
                        ->first();

            $betimes=($for_same_day->time_slot);
        }
        return response()->json([
            'betimes' => unserialize($betimes),
            'day' => $day
        ]);
    }
    /**
     * Display the specified reservation.
     *
     * @param int $id reservation ID
     * @return mixed
     */
    public function show($id,Request $request)
    {
        
        if(Module::hasAccess("Reservations", "view")) {
            $user = User::All();
            $all_schedule = All_Schedule::find($id);

            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

            $week = []; 
            for ($i=0; $i <7 ; $i++) {
                $week[] = $now->startOfWeek()->addDay($i)->format('Y-m-d');//push the current day and plus the mount of $i 
            }

            $accessorie = Accessory::All();
            $sql = "select resources.* from resources left join all_schedules on all_schedules.id = resources.schedule
                where resources.deleted_at is null and all_schedules.deleted_at is null and all_schedules.id = $id";
            $query = DB::table(DB::raw("($sql) as catch"));
            $resource = $query->get();

            $sql = "select reservations.* from reservations left join resources on resources.id = reservations.resource_id
                left join all_schedules on all_schedules.id = resources.schedule
                where reservations.deleted_at is null and resources.deleted_at is null and all_schedules.deleted_at is null and all_schedules.id = $id";
            $query = DB::table(DB::raw("($sql) as catch"));
            $reservation = $query->get();

            $bookdate = [];
            $endbookdate = [];
            foreach($reservation as $reservations)
            {
                $datetime= trim(str_replace( ['\'', '"', '-' , ':', '<', '>','\\u00a0'], '', $reservations->begin_date.$reservations->begin_time.$reservations->resource_id));
                $enddatetime= trim(str_replace( ['\'', '"', '-' , ':', '<', '>','\\u00a0'], '', $reservations->begin_date.$reservations->end_time.$reservations->resource_id));
                $bookdate[]=trim($datetime);
                $endbookdate[]=trim($enddatetime);
            }
            
            if(isset($all_schedule->id)) {
                $module = Module::get('Reservations');
                $module->row = $all_schedule;
                
                return view('la.reservations.show', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                    'no_header' => true,
                    'no_padding' => "no-padding"
                    ])->with('all_schedule', $all_schedule)
                    ->with('user',$user)
                    ->with('accessorie',$accessorie)
                    ->with('resource',$resource)
                    ->with('reservation',$reservation)
                    ->with('bookdate',$bookdate)
                    ->with('endbookdate',$endbookdate)
                    ->with('scheduleid', $id)
                    ->with('week', $week);
                    
            } else {

                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("all_schedule"),
                ]);
            }
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }

    public function next(Request $request)
    {
        // return response()->json([
        //     'request'=>$request->all()
        // ]);
        if(Module::hasAccess("Reservations", "view")) {
            $id = $request->schedule_id;

            $previous_weeks = json_decode($request->week);

            $user = User::All();
            $all_schedule = All_Schedule::find($id);

            $carbaoDay = Carbon::createFromFormat('Y-m-d', $previous_weeks[6])->addDay(1); //spesific day

            $week = []; 
            for ($i=0; $i <7 ; $i++) {
                $week[] = $carbaoDay->startOfWeek()->addDay($i)->format('Y-m-d');//push the current day and plus the mount of $i 
            }

            $accessorie = Accessory::All();
            $sql = "select resources.* from resources left join all_schedules on all_schedules.id = resources.schedule
                where resources.deleted_at is null and all_schedules.deleted_at is null and all_schedules.id = $id";
            $query = DB::table(DB::raw("($sql) as catch"));
            $resource = $query->get();

            $sql = "select reservations.* from reservations left join resources on resources.id = reservations.resource_id
                left join all_schedules on all_schedules.id = resources.schedule
                where reservations.deleted_at is null and resources.deleted_at is null and all_schedules.deleted_at is null and all_schedules.id = $id";
            $query = DB::table(DB::raw("($sql) as catch"));
            $reservation = $query->get();

            $bookdate = [];
            $endbookdate = [];
            foreach($reservation as $reservations)
            {
                $datetime= trim(str_replace( ['\'', '"', '-' , ':', '<', '>','\\u00a0'], '', $reservations->begin_date.$reservations->begin_time.$reservations->resource_id));
                $enddatetime= trim(str_replace( ['\'', '"', '-' , ':', '<', '>','\\u00a0'], '', $reservations->begin_date.$reservations->end_time.$reservations->resource_id));
                $bookdate[]=trim($datetime);
                $endbookdate[]=trim($enddatetime);
            }
            
            if(isset($all_schedule->id)) {
                $module = Module::get('Reservations');
                $module->row = $all_schedule;
                
                return view('la.reservations.show', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                    'no_header' => true,
                    'no_padding' => "no-padding"
                    ])->with('all_schedule', $all_schedule)
                    ->with('user',$user)
                    ->with('accessorie',$accessorie)
                    ->with('resource',$resource)
                    ->with('reservation',$reservation)
                    ->with('bookdate',$bookdate)
                    ->with('endbookdate',$endbookdate)
                    ->with('scheduleid', $id)
                    ->with('week', $week);
                    
            } else {

                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("all_schedule"),
                ]);
            }
        } else {
            return redirect()->route('admin.reservations.show', ['id' => $id]);
        }
    }

    public function previous(Request $request)
    {
        if(Module::hasAccess("Reservations", "view")) {
            $id = $request->schedule_id;

            $previous_weeks = json_decode($request->week);
            
            $user = User::All();
            $all_schedule = All_Schedule::find($id);

            $carbaoDay = Carbon::createFromFormat('Y-m-d', $previous_weeks[0])->addDay(-1);

            $week = []; 
            for ($i=0; $i <7 ; $i++) {
                $week[] = $carbaoDay->startOfWeek()->addDay($i)->format('Y-m-d');//push the current day and plus the mount of $i 
            }

            $accessorie = Accessory::All();
            $sql = "select resources.* from resources left join all_schedules on all_schedules.id = resources.schedule
                where resources.deleted_at is null and all_schedules.deleted_at is null and all_schedules.id = $id";
            $query = DB::table(DB::raw("($sql) as catch"));
            $resource = $query->get();

            $sql = "select reservations.* from reservations left join resources on resources.id = reservations.resource_id
                left join all_schedules on all_schedules.id = resources.schedule
                where reservations.deleted_at is null and resources.deleted_at is null and all_schedules.deleted_at is null and all_schedules.id = $id";
            $query = DB::table(DB::raw("($sql) as catch"));
            $reservation = $query->get();

            $bookdate = [];
            $endbookdate = [];
            foreach($reservation as $reservations)
            {
                $datetime= trim(str_replace( ['\'', '"', '-' , ':', '<', '>','\\u00a0'], '', $reservations->begin_date.$reservations->begin_time.$reservations->resource_id));
                $enddatetime= trim(str_replace( ['\'', '"', '-' , ':', '<', '>','\\u00a0'], '', $reservations->begin_date.$reservations->end_time.$reservations->resource_id));
                $bookdate[]=trim($datetime);
                $endbookdate[]=trim($enddatetime);
            }
            
            if(isset($all_schedule->id)) {
                $module = Module::get('Reservations');
                $module->row = $all_schedule;
                
                return view('la.reservations.show', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                    'no_header' => true,
                    'no_padding' => "no-padding"
                    ])->with('all_schedule', $all_schedule)
                    ->with('user',$user)
                    ->with('accessorie',$accessorie)
                    ->with('resource',$resource)
                    ->with('reservation',$reservation)
                    ->with('bookdate',$bookdate)
                    ->with('endbookdate',$endbookdate)
                    ->with('scheduleid', $id)
                    ->with('week', $week);
                    
            } else {

                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("all_schedule"),
                ]);
            }
        } else {
            return redirect()->route('admin.reservations.show', ['id' => $id]);
        }
    }
    
    /**
     * Show the form for editing the specified reservation.
     *
     * @param int $id reservation ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        if(Module::hasAccess("Reservations", "edit")) {
            $reservation = Reservation::find($id);
            if(isset($reservation->id)) {
                $module = Module::get('Reservations');
                
                $module->row = $reservation;
                
                return view('la.reservations.edit', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                ])->with('reservation', $reservation);
            } else {
                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("reservation"),
                ]);
            }
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Update the specified reservation in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id reservation ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if(Module::hasAccess("Reservations", "edit")) {
            
            $rules = Module::validateRules("Reservations", $request, true);
            
            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();;
            }
            
            $insert_id = Module::updateRow("Reservations", $request, $id);
            
            return redirect()->route(config('laraadmin.adminRoute') . '.reservations.index');
            
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Remove the specified reservation from storage.
     *
     * @param int $id reservation ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(Module::hasAccess("Reservations", "delete")) {
            Reservation::find($id)->delete();
            
            // Redirecting to index() method
            return redirect()->route(config('laraadmin.adminRoute') . '.reservations.index');
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Server side Datatable fetch via Ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dtajax(Request $request)
    {
        $module = Module::get('Reservations');
        $listing_cols = Module::getListingColumns('Reservations');
        
        $values = DB::table('reservations')->select($listing_cols)->whereNull('deleted_at');
        $out = Datatables::of($values)->make();
        $data = $out->getData();
        
        $fields_popup = ModuleFields::getModuleFields('Reservations');
        
        for($i = 0; $i < count($data->data); $i++) {
            for($j = 0; $j < count($listing_cols); $j++) {
                $col = $listing_cols[$j];
                if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                    $data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
                }
                if($col == $module->view_col) {
                    $data->data[$i][$j] = '<a href="' . url(config('laraadmin.adminRoute') . '/reservations/' . $data->data[$i][0]) . '">' . $data->data[$i][$j] . '</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            
            if($this->show_action) {
                $output = '';
                if(Module::hasAccess("Reservations", "edit")) {
                    $output .= '<a href="' . url(config('laraadmin.adminRoute') . '/reservations/' . $data->data[$i][0] . '/edit') . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                }
                
                if(Module::hasAccess("Reservations", "delete")) {
                    $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.reservations.destroy', $data->data[$i][0]], 'method' => 'delete', 'style' => 'display:inline']);
                    $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                    $output .= Form::close();
                }
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

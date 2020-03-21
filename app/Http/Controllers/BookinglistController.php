<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use DB;
use Auth;
use Carbon\Carbon;
use Module;
use Zizaco\Entrust\EntrustFacade as Entrust;
use App\Models\User;
use App\Models\Resource;


class BookinglistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookinglist=Reservation::all();
        $user = Auth::user();
        $resource = DB::table('resources')
            ->select('resources.id','name')
            ->leftJoin('reservations', 'resources.id', '=', 'reservations.resource_id')
            ->get();
            foreach($bookinglist as $key=>$data)
            {
            $newarr=array();
            $newarr['id']=$data->id;
            $newarr['title']=$data->title;
            $newarr['resourcename']=$resource[$key]->name;
            $newarr['begin_date']=$data->begin_date;
            $newarr['begin_time']=$data->begin_time;
            $newarr['end_date']=$data->end_date;
            $newarr['end_time']=$data->end_time;
            $newarr['username']=$user->name;
            $results[]=$newarr;
            }
            return view('la.bookinglist.index')->with('results',$results);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $bookinglist = Reservation::find($id);
        $resourceid=DB::table('reservations')
                    ->select('resource_id')
                    ->where('id',$id)
                    ->first(); 
        $resource = DB::table('resources')
                    ->select('name')
                    ->where('id', '=',$resourceid->resource_id)
                    ->first();
        $sql = "SELECT users.* FROM users left join reservations_users on reservations_users.user_id = users.id
        where reservations_users.reservations_id =$id";
        $query = DB::table(DB::raw("($sql) as catch"));
        $participants_list = $query->get();
        
        $invitees = DB::table('reservations_invitees')
                    ->select('email')
                    ->where('reservations_id',$id)
                    ->first();

        $sql = "SELECT accessories.*, reservation_accessories.quantity FROM accessories left join reservation_accessories on reservation_accessories.accessories_id = accessories.id where reservation_accessories.reservations_id = $id";
        $query = DB::table(DB::raw("($sql) as catch"));
        $accessories_list = $query->get();
         
        return view('la.bookinglist.show', [
            'no_header' => true,
            'no_padding' => "no-padding"
        ], compact('bookinglist','resource','participants_list','invitees','accessories_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function bookinglist_filter(Request $request)
    {
        $query = "";
        $today = date("Y-m-d");
        $input_from_date = '';
        $input_to_date = '';
        $resourcename='0';
        $bookinglist=Reservation::all();
        $user = Auth::user();
        $resources=Resource::all();
        
        $query = DB::table('resources')
            ->select('resources.id','name','title','begin_date','end_date','begin_time','end_time')
            ->leftJoin('reservations', 'resources.id', '=', 'reservations.resource_id');
        
        $from_date = Carbon::now()->startOfMonth()->toDateString();
        $to_date = Carbon::now()->endOfMonth()->toDateString();
        $input_from_date = Carbon::createFromFormat('Y-m-d', $from_date)->format('d/m/Y');
        $input_to_date = Carbon::createFromFormat('Y-m-d', $to_date)->format('d/m/Y');
        
        //filter
        if($request->has('resourcename')){
            $resourcename = $request->input('resourcename');
            //dd($resourcename);
        }
        
        if($request->has('from_date') && $request->input('from_date') != ''){
            $input_from_date = $request->input('from_date');
            $from_date = Carbon::createFromFormat('d/m/Y', $input_from_date)->format('Y-m-d');
        }
        
        if($request->has('to_date') && $request->input('to_date') != ''){
            $input_to_date = $request->input('to_date');
            $to_date = Carbon::createFromFormat('d/m/Y', $input_to_date)->format('Y-m-d');
        }
        
        
        // $query = $results;
        //$query = DB::table('reservations');
        //dd($query);

        if(isset($from_date) && $from_date != ""){
            $query = $query->whereDate('begin_date', '>=', $from_date);
        }
        if(isset($to_date) && $to_date != ""){
            $query = $query->whereDate('end_date', '<=', $to_date);
        }
        if(isset($resourcename) && $resourcename != "0"){
            $query = $query->where('resources.id', '=', $resourcename);
        }
        $all_bookinglists = $query->get();
        //dd($all_bookinglists);

            foreach($all_bookinglists as $key=>$data)
            {
            $newarr=array();
            $newarr['id']=$data->id;
            $newarr['title']=$data->title;
            $newarr['resourcename']=$data->name;
            $newarr['resourceid']=$data->id;
            $newarr['begin_date']=$data->begin_date;
            $newarr['begin_time']=$data->begin_time;
            $newarr['end_date']=$data->end_date;
            $newarr['end_time']=$data->end_time;
            $newarr['username']=$user->name;
            $results[]=$newarr;
            }
        

        
        //dd($all_bookinglists);
        return View('la.bookinglist.index', [
            'from_date' => $input_from_date,
            'to_date' => $input_to_date,
            'results' => $results,
            'resources' => $resources
        ]);
        
    }


}

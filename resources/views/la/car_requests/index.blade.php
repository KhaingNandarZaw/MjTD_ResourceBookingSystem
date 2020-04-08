@extends("la.layouts.app")

@section("contentheader_title", "Car Requests")
@section("contentheader_description", "Car Requests listing")
@section("section", "Car Requests")
@section("sub_section", "Listing")
@section("htmlheader_title", "Car Requests Listing")

@section("headerElems")
@la_access("Car_Requests", "create")
    <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Car Request</button>
@endla_access
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
    <!--<div class="box-header"></div>-->
    <div class="box-body">
        <table id="example1" class="table table-bordered">
        <thead>
        <tr class="success">
            <th>ID</th>
            <th>Requested Person</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Way</th>
            <th>Number of Participants</th>
            <th>Participants</th>
            <th>Remark</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $car_request_list as $car_request_lists )
            <tr>
            <td>{{$car_request_lists->id}}</td>
            <?php $user = DB::table('users')->where('id', $car_request_lists->user_id)->first(); ?>
            <td><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id) }}">@if(isset($user)) {{$user->name}} @endif</a></td>
            <td><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id) }}">{{$car_request_lists->start_date}}</a></td>
            <td><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id) }}">{{$car_request_lists->end_date}}</a></td>
            <td><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id) }}">{{$car_request_lists->start_time}}</a></td>
            <td><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id) }}">{{$car_request_lists->end_time}}</a></td>
            <td><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id) }}">{{$car_request_lists->way}}</a></td>            
            <td>{{$car_request_lists->no_of_participant}}</td>
            <td>{{$car_request_lists->participants}}</td>
            <td>{{$car_request_lists->remark}}</td>
            <td><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id) }}">{{ $car_request_lists->status }}</a></td>
            <td>
                <a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id . '/edit') }}" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;">Edit</i></a>
                <a href="{{ url(config('laraadmin.adminRoute') . '/car_requests/'.$car_request_lists->id . '/cancel') }}" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;">Cancel</i></a>
            </td>
            </tr>
            @endforeach
        
            
        </tbody>
        </table>
    </div>
</div>

@la_access("Car_Requests", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Car Request</h4>
            </div>
            {!! Form::open(['action' => 'LA\Car_RequestsController@store', 'id' => 'car_request-add-form']) !!}
            <div class="modal-body">
                <div class="box-body">
                    
                    
                    <input type="hidden" name="user_id" value="{{$user_id}}">
					@la_input($module, 'start_date')
					@la_input($module, 'end_date')
                        <div class="row">
                            <div class='col-sm-6'>
                                <div class="form-group bootstrap-timepicker timepicker">
                                <label for="">Start Time :</label>
                                    <div class='input-group time' id='timepicker1'>
                                    <input id="timepicker1" name="start_time" type="text" class="form-control input-small">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class='col-sm-6'>
                                <div class="form-group bootstrap-timepicker timepicker">
                                <label for="">End Time :</label>
                                    <div class='input-group time' id='timepicker2'>
                                        <input type='text' name="end_time" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
					@la_input($module, 'way')
					@la_input($module, 'no_of_participant')
					@la_input($module, 'participants')
					@la_input($module, 'remark')
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script>
$(function () {
    $("#example1").DataTable({
        processing: true,
        @if($show_actions)
        columnDefs: [ { orderable: false, targets: [-1] }],
        @endif
    });
    $("#car_request-add-form").validate({
        
    });
});
</script>
<script type="text/javascript">
$('#end_date').val($('#start_date').val());

    $('#timepicker1').datetimepicker({
        format: 'LT'
  });
  
  $('#timepicker2').datetimepicker({
    format: 'LT'
  });
</script>


@endpush

@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/car_requests') }}">Car Request</a> :
@endsection
@section("contentheader_description", $car_request->$view_col)
@section("section", "Car Requests")
@section("section_url", url(config('laraadmin.adminRoute') . '/car_requests'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Car Requests Edit : ".$car_request->$view_col)

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

<div class="box box-purple">
    <div class="box-header">
        
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::model($car_request, ['route' => [config('laraadmin.adminRoute') . '.car_requests.update', $car_request->id ], 'method'=>'PUT', 'id' => 'car_request-edit-form']) !!}
                    
                    
                    
					@la_input($module, 'start_date')
					@la_input($module, 'end_date')
					<div class="row">
                            <div class='col-sm-6'>
                                <div class="form-group bootstrap-timepicker timepicker">
                                <label for="">Start Time :</label>
                                    <div class='input-group time' id='timepicker1'>
                                    <input id="timepicker1" name="start_time" type="text" value="{{$car_request->start_time}}" class="form-control input-small">
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
                                        <input type='text' name="end_time" value="{{$car_request->end_time}}" class="form-control" />
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
                    
                    <br>
                    <div class="form-group">
                        {!! Form::submit( 'Update', ['class'=>'btn btn-info']) !!} <a href="{{ url(config('laraadmin.adminRoute') . '/car_requests') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script>
$(function () {
    $("#car_request-edit-form").validate({
        
    });
});

</script>
<script type="text/javascript">
    $('#timepicker1').datetimepicker({
        format: 'LT'
  });
  
  $('#timepicker2').datetimepicker({
    format: 'LT'
  });
</script>
@endpush

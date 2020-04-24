@extends('la.layouts.app')

@section('htmlheader_title')
    Car Request View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
    
    <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
        <li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/car_requests') }}" data-toggle="tooltip" data-placement="right" title="Back to Car Requests"><i class="fa fa-chevron-left"></i></a></li>
        <li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> General Info</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
            <div class="tab-content">
                <div class="panel infolist">
                    <div class="panel-default panel-heading">
                        <h4>General Info</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                                <label class="col-md-4 col-sm-6 col-xs-6">Requested By :</label>
                                <?php $user = DB::table('users')->wherenull('deleted_at')->where('id', $car_request->user_id)->first(); ?>
                                <div class="col-md-8 col-sm-6 col-xs-6">{{ $user->name }}</div>
                        </div>
                        <div class="form-group">
                                <label class="col-md-4 col-sm-6 col-xs-6">Requested Date :</label>
                                <div class="col-md-8 col-sm-6 col-xs-6">{{ $car_request->created_at }}</div>
                        </div>
						@la_display($module, 'start_date')
						@la_display($module, 'end_date')
						@la_display($module, 'start_time')
						@la_display($module, 'end_time')
						@la_display($module, 'way')
						@la_display($module, 'no_of_participant')
						@la_display($module, 'participants')
						@la_display($module, 'remark')
                        <div class="form-group">
                                <label class="col-md-4 col-sm-6 col-xs-6">Status :</label>
                                <div class="col-md-8 col-sm-6 col-xs-6">{{ $car_request->status }}</div>
                        </div>

                        History
                    
                        <table class="table"> 
                            <tr>
                                <th>User</th>
                                <th>Status</th>
                                <th>Effected Date</th>
                                <th>Remark</th>
                            </tr>
                            <tr>
                                <td> <?php $user = DB::table('users')->wherenull('deleted_at')->where('id', $car_request->user_id)->first(); ?>
                                {{ $user->name }}</td>
                                <td>{{ $car_request->status }}</td>
                                <td>{{ $car_request->created_at }}</td>
                                <td>{{ $car_request->remark }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </div>
    </div>
</div>
@endsection

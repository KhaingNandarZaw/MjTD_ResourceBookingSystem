@extends('la.layouts.app')

@section('htmlheader_title')
    Booking List View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
    
    <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
        <li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/bookinglist') }}" data-toggle="tooltip" data-placement="right" title="Back to Resources"><i class="fa fa-chevron-left"></i></a></li>
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
                        
                        <table class="table">
                            
                            <tbody>
                                <tr>
                                    <th scope="row">Title</th>
                                    <th>:</th>
                                    <td>{{$bookinglist->title}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <th>:</th>
                                    <td>{{$bookinglist->description}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Begin Date</th>
                                    <th>:</th>
                                    <td>{{$bookinglist->begin_date}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Booking Time</th>
                                    <th>:</th>
                                    <td>{{$bookinglist->begin_time}}-{{$bookinglist->end_time}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">End Date</th>
                                    <th>:</th>
                                    <td>{{$bookinglist->end_date}}</td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Resource</th>
                                    <th>:</th>
                                    <td>{{$resource->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Participant Users</th>
                                    <th scope="row">Invitees</th>
                                    <th scope="row">Accessories List</th>
                                </tr>
                                <tr>
                                    <td>
                                        @foreach($participants_list as $participants_lists)
                                        {{$participants_lists->name}}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$invitees->email}}
                                    </td>
                                    <td>
                                        @foreach($accessories_list as $accessories_lists)
                                        {{$accessories_lists->name}}<br>
                                        @endforeach
                                    </td>
                                </tr>                                
                            </tbody>
                            </table>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

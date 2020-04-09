@extends("la.layouts.app")

@section("contentheader_title", "Booking Lists")
@section("contentheader_description", "")
@section("section", "Booking")
@section("sub_section", "Listing")
@section("htmlheader_title", "Booking Listing")

@section("main-content")

<div class="box box-purple">  
    <div class="box-body">
    {!! Form::open(['action' => 'BookinglistController@bookinglist_filter', 'method' => 'POST']) !!}
        <div class="row form-group">
            <div class="col-sm-2">
                <label>Resource</label>
                <select class="form-control input-sm" data-placeholder="Select User" rel="select2" name="resourcename">
                    <option value="0" selected>*</option>
                    @foreach($resources as $resource)
                        <option value="{{$resource->id}}">{{$resource->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <label>From Date</label>
                <div class="input-group date"><input class="form-control input-sm" placeholder="Enter From Date" data-rule-minlength="0" id="from_date" name="from_date" type="text" value="{{$from_date}}"><span class="input-group-addon input_dt"><span class="fa fa-calendar"></span></span></div>
            </div>
            <div class="col-sm-2">
                <label>To Date</label>
                <div class="input-group date"><input class="form-control input-sm" placeholder="Enter To Date" data-rule-minlength="0" id="to_date" name="to_date" type="text" value="{{$to_date}}"><span class="input-group-addon input_dt"><span class="fa fa-calendar"></span></span></div>
            </div>
            <div class="col-md-1" style="margin-top:25px;">
                {{ Form::button('<i class="fa fa-search"> 
                
                </i>', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'] )  }} 
            </div>
            
        </div>
    {!! Form::close() !!}

        <table id="example1" class="table table-bordered table-striped" data-form="deleteFormusers">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Resource</th>
                    <th>Title</th>
                    <th>Begin Date</th>
                    <th>Begin Time</th>
                    <th>End Date</th>
                    <th>End Time</th>
                    <th>Number Of Participant</th>
                    <th>Reserved By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($results as $all_bookinglist)
                <tr>
                    <td>{{$all_bookinglist['id']}}</td>
                    <td><a href="{{route('admin.bookinglist.show',$all_bookinglist['id'])}}">{{$all_bookinglist['resourcename']}}</a></td>
                    <td><a href="{{route('admin.bookinglist.show',$all_bookinglist['id'])}}">{{$all_bookinglist['title']}}</a></td>
                    <td>{{$all_bookinglist['begin_date']}}</td>
                    <td id="begintime" data-time="{{$all_bookinglist['begin_time']}}">{{$all_bookinglist['begin_time']}}</td>
                    <td>{{$all_bookinglist['end_date']}}</td>
                    <td>{{$all_bookinglist['end_time']}}</td>
                    <td>{{$all_bookinglist['no_of_participant']}}</td>
                    <td>{{$all_bookinglist['username']}}</td>
                    @if('09:00' < $all_bookinglist['end_time'])
                    <td><a href="{{ url(config('laraadmin.adminRoute') . '/bookinglist/'.$all_bookinglist['id'] . '/cancel') }}" class="btn btn-danger btn-xs" id="bookingcancel" style="display:inline;padding:2px 5px 3px 5px;">Cancel</i></a></td>
                    @endif
                </tr>
                
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
    $('table[data-form="deleteFormusers"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
    });
    $("#example1").DataTable({

    });
    
});
</script>
<script>
$("#bookingcancel").hide;  

// function CompareDate() {  
//     var begintime = $("#begintime").data("time") ;
//         alert(begintime);
//     var now = new Date();
//     var current_date_time = moment(now).format('HH:mm');
//     console.log(current_date_time);
 
    
//     if (current_date_time < begintime) {  
        
//     }else {  
//         alert("no");  
//     }  
// }  
// CompareDate();  

</script>
@endpush

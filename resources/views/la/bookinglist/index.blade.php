@extends("la.layouts.app")

@section("contentheader_title", "")
@section("contentheader_description", "")
@section("section", "Booking")
@section("sub_section", "Listing")
@section("htmlheader_title", "Booking Listing")

@section("main-content")



<div class="box box-green">
    <div class="box-header with-border">
        Booking List
        
    </div>    
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped" data-form="deleteFormusers">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Begin Date</th>
            <th>Begin Time</th>
            <th>End Date</th>
            <th>End Time</th>
        </tr>
        
        @foreach($bookinglist as $bookinglists)
        <tr>
            <td>{{$bookinglists->id}}</td>
            <td>{{$bookinglists->title}}</td>
            <td>{{$bookinglists->description}}</td>
            <td>{{$bookinglists->begin_date}}</td>
            <td>{{$bookinglists->begin_time}}</td>
            <td>{{$bookinglists->end_date}}</td>
            <td>{{$bookinglists->end_time}}</td>
        </tr>
        @endforeach
        
        </thead>
        <tbody>
            
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
    // $("#example1").DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ url(config('laraadmin.adminRoute') . '/user_dt_ajax') }}",
    //     language: {
    //         lengthMenu: "_MENU_",
    //         search: "_INPUT_",
    //         searchPlaceholder: "Search"
    //     },
        
    // });
    
});
</script>
@endpush

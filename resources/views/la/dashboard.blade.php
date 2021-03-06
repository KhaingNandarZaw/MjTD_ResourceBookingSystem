@extends('la.layouts.app')

@section('htmlheader_title') Dashboard @endsection
@section('contentheader_title') Dashboard @endsection
@section('contentheader_description') Organisation Overview @endsection

@section('main-content')
<!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <div class="col-md-6">
              <div class="box box-purple">
                    <div class="box-header">
                        <h4 class="box-title">Upcoming reservations</h4>
                    </div>
                    <div class="box-body">
                      @if(count($bookinglist) <= 0)
                      <span>You have no upcoming reservations.</span>
                      @endif
                      @foreach($bookinglist as $bookinglists)
                        <ul class="products-list product-list-in-box">
                          <li class="item">
                            <div class="product-img">
                              <span class="fa fa-clock-o" style="font-size:15px;"></span>
                            </div>
                            
                            <div class="product-info">
                              <a href="{{route('admin.bookinglist.show',$bookinglists->id)}}" class="product-title">
                                <span class="label label-success" style="font-size: 12px;
                                ">{{$bookinglists->resource->name}}</span> {{$bookinglists->title}}
                                <span class="label label-warning pull-right">{{$bookinglists->begin_date}}</span>
                              </a>
                              <span class="product-description">{{$bookinglists->begin_time}}-{{$bookinglists->end_time}}</span>
                            </div>
                          </li>
                        </ul>
                      @endforeach
                    </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-6">
              <div class="box box-purple">
                    <div class="box-header">
                        <h4 class="box-title">Your Calendar</h4>
                    </div>
                    <div class="box-body">
                    <div class="panel panel-primary">
                      <div id="fullCalendar">
                      </div>
                    </div>
                    </div>
              </div>
            </div>


          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
@endsection

@push('styles')
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/morris/morris.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/css/calendar.css') }}"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
@endpush

@push('scripts')
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('la-assets/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('la-assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('la-assets/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('la-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('la-assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('la-assets/plugins/fastclick/fastclick.js') }}"></script>
<!-- dashboard -->
<script src="{{ asset('la-assets/js/pages/dashboard.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script src="{{ asset('la-assets/js/apexcharts.js') }}"></script>
@endpush

@push('scripts')
<script>
(function($) {
  // $('body').pgNotification({
  //  style: 'circle',
  //  title: 'LaraAdmin',
  //  message: "Welcome to LaraAdmin...",
  //  position: "top-right",
  //  timeout: 0,
  //  type: "success",
  //  thumbnail: '<img width="40" height="40" style="display: inline-block;" src="{{ Gravatar::fallback(asset('la-assets/img/user2-160x160.jpg'))->get(Auth::user()->email, 'default') }}" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">'
  // }).show();
})(window.jQuery);

$('#fullCalendar').fullCalendar({
	    // put your options and callbacks here
	    left:   'title',
	    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listYear'
      },
      slotLabelFormat:"HH:mm",
	    events: [
                @foreach($reservations as $reservations_lists)
                {
                    title: '{{ $reservations_lists->title." ".$reservations_lists->begin_time."-".$reservations_lists->end_time }}',
                    start: '{{ $reservations_lists->begin_date." ".$reservations_lists->begin_time }}',
                    end: '{{ $reservations_lists->end_date." ".$reservations_lists->end_time }}'
                },
                @endforeach
            ]
	});


</script>

@endpush
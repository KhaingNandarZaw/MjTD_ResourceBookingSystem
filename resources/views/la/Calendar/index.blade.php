@extends("la.layouts.app")
@section("contentheader_title", "Calendar")
@section("contentheader_description", "Calendar")
@section("section", "Calendar")
@section("sub_section", "Listing")
@section("htmlheader_title", "Calendar")
@section("headerElems")

@endsection
@section("main-content")

    <!-- <div class="panel panel-primary">
        <div class="panel-heading">
            My Event Details
        </div>
        <div class="panel-body">
        </div>
        
    
    </div>
 -->

    <div class="panel panel-primary">
        <div id="calendar">
        </div>
    </div>
    

@endsection
@push('styles')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/mine.css') }}"/>
@endpush
@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script>
    $(document).ready(function(){
        $("#calendar").fullCalendar({
            header : {
                left : "prev, next, today",
                center : "title", 
                right : "month,agendaWeek,agendaDay,listYear"
            },
            slotLabelFormat:"HH:mm",
            //defaultView: 'agendaWeek',
            events : [
                @foreach($reservations as $reservation)
                {
                    title: '{{ $reservation->title." ".$reservation->begin_time."-".$reservation->end_time }}',
                    start: '{{ $reservation->begin_date." ".$reservation->begin_time }}',
                    end: '{{ $reservation->end_date." ".$reservation->end_time }}'
                },
                @endforeach
            ]
        })
    });
</script>

@endpush
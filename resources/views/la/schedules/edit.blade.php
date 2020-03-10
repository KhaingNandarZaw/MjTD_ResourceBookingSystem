@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/schedules') }}">Schedule</a> :
@endsection
@section("contentheader_description", $schedule->$view_col)
@section("section", "Schedules")
@section("section_url", url(config('laraadmin.adminRoute') . '/schedules'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Schedules Edit : ".$schedule->$view_col)

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

<div class="box">
    <div class="box-header">
        
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::model($schedule, ['route' => [config('laraadmin.adminRoute') . '.schedules.update', $schedule->id ], 'method'=>'PUT', 'id' => 'schedule-edit-form']) !!}
                    @la_form($module)
                    
                    {{--
                    
                    --}}
                    <br>
                    <div class="form-group">
                        {!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <a href="{{ url(config('laraadmin.adminRoute') . '/schedules') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
    $("#schedule-edit-form").validate({
        
    });
});
</script>
@endpush

@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/resources') }}">Resource</a> :
@endsection
@section("contentheader_description", $resource->$view_col)
@section("section", "Resources")
@section("section_url", url(config('laraadmin.adminRoute') . '/resources'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Resources Edit : ".$resource->$view_col)

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

<div class="box box-info container contact">
	<div class="box-body">
                
        {!! Form::model($resource, ['route' => [config('laraadmin.adminRoute') . '.resources.update', $resource->id ], 'method'=>'PUT', 'id' => 'resource-edit-form']) !!}
            @la_form($module)
            
            {{--
            @la_input($module, 'name')
			@la_input($module, 'schedule')
			@la_input($module, 'image')
			@la_input($module, 'notes')
			@la_input($module, 'status')
			@la_input($module, 'is_public')
			@la_input($module, 'need_approval')
            --}}
            <br>
            <div class="form-group col-sm-12">
                <div class="col-sm-6">
                    {!! Form::submit( 'Update', ['class'=>'btn btn-sm btn-success pull-right']) !!}
                </div>
                <div class="col-sm-6">
                    <a href="{{ url(config('laraadmin.adminRoute') . '/resources') }}" class="btn btn-sm btn-default">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}

	</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('la-assets/mine.js') }}"></script>
<script>
$(function () {
    $("#resource-edit-form").validate({
        
    });
});
</script>
@endpush

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/mine.css') }}"/>
@endpush


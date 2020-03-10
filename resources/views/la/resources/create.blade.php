@extends("la.layouts.app")

@section("contentheader_title", "Add Resource")
@section("contentheader_description", "Resources listing")
@section("section", "Resources")
@section("sub_section", "Add Resource")
@section("htmlheader_title", "Adding Resource")

@section("main-content")

<div class="box box-info">
    <div class="box-header with-border">
        Resource Entry
    </div> 
	<div class="box-body">
        {!! Form::open(['action' => 'LA\ResourcesController@store', 'id' => 'resource-add-form']) !!}
            <div class="box-body">
                @la_form($module)
            </div>
            <div class="modal-footer">
                <a href="{{ url(config('laraadmin.adminRoute') . '/resources') }}" class="btn btn-default btn-sm">Cancel</a>
                {!! Form::submit( 'Submit', ['class'=>'btn btn-sm btn-primary']) !!}
            </div>
        {!! Form::close() !!}
            
	</div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/mine.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/mine.js') }}"></script>
<script>
$(function () {
    $("#resource-add-form").validate({
        
    });
});
</script>
@endpush
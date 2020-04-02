@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/accessories') }}">Accessory</a> :
@endsection
@section("contentheader_description", $accessory->$view_col)
@section("section", "Accessories")
@section("section_url", url(config('laraadmin.adminRoute') . '/accessories'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Accessories Edit : ".$accessory->$view_col)

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

<div class="col-md-7 box">
    <div class="box-body">
        <div class="row">
            <div class="content">

                <div class="col-md-4">
                    <h4><b>Update Accessory</b></h4><br>
                    {!! Form::model($accessory, ['route' => [config('laraadmin.adminRoute') . '.accessories.update', $accessory->id ], 'method'=>'PUT', 'id' => 'accessory-edit-form']) !!}
                        @la_form($module)
                        <br>
                        <div class="form-group">
                            {!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <a href="{{ url(config('laraadmin.adminRoute') . '/accessories') }}" class="btn btn-default pull-right">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-8">             
                    <div id="page-content" class="profile2">
                        <div class="tab-content"> 
                            <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
                                <div class="tab-content">
                                    <div class="panel infolist">
                                        <div class="panel-default panel-heading">
                                            <h4><b>General Info</b></h4>
                                        </div>
                                    
                                        <div class="panel-body">
                                            @la_display($module, 'name')
                                            @la_display($module, 'available_quantity')
                                           
                                        </div>
                                        
                                    </div>
                                    <div class="pull-right">
                                        <b style="color:red;">Delete {{ $accessory->$view_col }}</b>&nbsp;
                                        @la_access("Accessories", "delete")
                                       
                                        {{ Form::open(['route' => [config('laraadmin.adminRoute') . '.accessories.destroy', $accessory->id], 'method' => 'delete', 'style'=>'display:inline']) }}
                                        
                                            <button data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash"></i></button>
                                            <div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="width:350px;">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                        <span style="text-align:center;">
                                                            <h4>Are you sure, you want to delete? </h4>
                                                            <p class="text-secondary">
                                                                <small>
                                                                This will delete your record permanently
                                                                </small>
                                                            </p>
                                                            </span>
                                                            <p class="debug-url"></p>
                                                        </div>
                                                    
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{ Form::close() }}    
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                        
                        
            @endla_access
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
$(function () {
    $("#accessory-edit-form").validate({
        
    });
});
</script>
@endpush

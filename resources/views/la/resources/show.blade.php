@extends('la.layouts.app')

@section('htmlheader_title')
    Resource View
@endsection


@section('main-content')
<div id="page-content" class="profile2">
    
    <ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
        <li class=""><a href="javascript:history.back()" data-toggle="tooltip" data-placement="right" title="Back to Resources"><i class="fa fa-chevron-left"></i></a></li>
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
                        @la_display($module, 'name')
						@la_display($module, 'schedule')
						@la_display($module, 'image')
						@la_display($module, 'notes')
						@la_display($module, 'status')
						@la_display($module, 'is_public')
						@la_display($module, 'need_approval')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

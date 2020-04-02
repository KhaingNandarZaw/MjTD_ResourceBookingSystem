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
                
                @la_input($module, 'name')
                @la_input($module, 'schedule')
                @la_input($module, 'image')
                @la_input($module, 'notes')
                @la_input($module, 'status')
                @la_input($module, 'no_of_maximum_people')
                <div class='public'>
                    @la_input($module, 'is_public')
                </div>

                <div class="col-6 UG">
                            <label for="">Users<sup>*</sup>:</label>
                            <div class="input-group">
                                <select class="form-control" required="1" data-placeholder="Select Operator" rel="select2" name="selectoperator" id="selectoperator">
                                        <option value="0" disabled selected>Select User</option>
                                    @foreach($user as $users)
                                        <option value="{{ $users->id }}">{{ $users->name }}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" onclick="buttonClick();" id="btnoperator">Add</button>
                                </span>                  
                            </div>   
                    </div>

                    <div class="col-md-6">                         
                        <div class="panel panel-green operators">
                            <div class="panel-heading">Users</div>
                            <div class="panel-body">
                            
                            <table class="table table-striped table-hover" id="operatortable" >
                                <thead>
                                    <tr>
                                        <td> ID </td>
                                        <th> User Name </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>                           
                </div>
            
                
                    
                

                
                
            </div>
            <div class="col-6 UG">
                    <label for="">Groups<sup>*</sup>:</label>
                    <div class="input-group">
                        <select class="form-control" required="1" data-placeholder="Select Group" rel="select2" name="selectgroup" id="selectgroup">
                                <option value="0" disabled selected>Select Group</option>
                            @foreach($group as $groups)
                                <option value="{{ $groups->id }}">{{ $groups->name }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary" onclick="buttonClick();" id="btngroup">Add</button>
                        </span>                  
                    </div>   
                </div>

                <div class="col-md-6">                         
                        <div class="panel panel-green group">
                            <div class="panel-heading">Groups</div>
                            <div class="panel-body">
                                <table class="table otable table-striped table-hover" id="grouptable" >
                                    <thead>
                                        <tr>
                                            <td> ID </td>
                                            <th> Group Name </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>                           
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

    $(document).ready(function(){
    $(".UG").show();
    $(".public").click(function () {
        $(".UG").toggle();
    })
})
    
});

let operator_row = 1;
    let operator = [];



    // Operators
    
    // Add
    document.querySelector("#btnoperator").addEventListener('click',addoperator);

    const otable = document.querySelector("#operatortable").children[1];

    if(operator.length == 0)
    {
        document.querySelector(".operators").style.display = "none";
    }

    
    var i = 0;
    
        i++;
        
    
    
    function addoperator()
    {
        document.querySelector(".operators").style.display = "block";   
        let selectoperator = document.querySelector("#selectoperator");
        let operator_id = selectoperator.value;
        let operator_name = selectoperator.options[selectoperator.selectedIndex].text;
        let i=selectoperator.value;

        let op = selectoperator.options;        
    
        const row = document.createElement('tr');
        row.className = 'operator_'+operator_id;
        row.innerHTML = `<td>${i}</td>
                        <td><input type='hidden' name='user_id[]' value='${operator_id}'>${operator_name}</td>
                         <td><button class="btn btn-danger btn-xs" id="btndelete" onclick="deleteoperator(${operator_id})" ><i class="fa fa-times"></i> Delete</button></td>`;
 
        if(operator.includes(operator_id)) {
            alert("Cannot Add");
            return;
        } else {
            if(operator_id == 0) {
                alert("Cannot Add");
                return;
            } else {
            operator_row++;
            let i=0;
            i++;
            operator.push(i);
            operator.push(operator_id);                         
            otable.appendChild(row);
            }
        }

        document.getElementById("operator_list").value = operator;
    }

// Remove
function deleteoperator(operator_id) 
    {
        $(`.operator_${operator_id}`).remove();
        var operator_info = String(operator_id);
        var index = operator.indexOf(operator_info);
        console.log(index);
        if(index > -1) {
            operator.splice(index, 1);
        }
        operator_row--;
        console.log(operator);
        document.getElementById("operator_list").value = operator;
    }



  
    let group_row = 1;
    let group = [];
    // Groups
    
    // Add
    document.querySelector("#btngroup").addEventListener('click',addgroup);

    const table = document.querySelector("#grouptable").children[1];

    if(group.length == 0)
    {
        document.querySelector(".group").style.display = "none";
    }
    
    function addgroup()
    {
        document.querySelector(".group").style.display = "block";   
        let selectgroup = document.querySelector("#selectgroup");
        let group_id = selectgroup.value;
        let group_name = selectgroup.options[selectgroup.selectedIndex].text;
        let i=selectgroup.value;

        let op = selectgroup.options;        
        
        const row = document.createElement('tr');
        row.className = 'group_'+group_id;
        row.innerHTML = `<td>${i}</td>
                        <td><input type='hidden' name='group_id[]' value='${group_id}'>${group_name}</td>
                         <td><button class="btn btn-danger btn-xs" id="btndelete" onclick="deletegroup(${group_id})" ><i class="fa fa-times"></i> Delete</button></td>`
        
        if(group.includes(group_id)) {
            alert("Cannot Add");
            return;
        } else {
            if(group_id == 0) {
                alert("Cannot Add");
                return;
            } else {
            group_row++;
            let i=0;
            i++;
            group.push(i);
            group.push(group_id);                         
            table.appendChild(row);
            }
        }
    }

// Remove
function deletegroup(group_id) 
    {
        $(`.group_${group_id}`).remove();
        var group_info = String(group_id);
        var index = group.indexOf(group_info);
        console.log(index);
        if(index > -1) {
            group.splice(index, 1);
        }
        group_row--;
        console.log(group);
        document.getElementById("group_list").value = group;
    }





</script>

@endpush
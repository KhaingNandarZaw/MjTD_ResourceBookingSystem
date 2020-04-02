@extends("la.layouts.app")

@section("contentheader_title")
    <a href="{{ url(config('laraadmin.adminRoute') . '/groups') }}">Group</a> :
@endsection
@section("contentheader_description", $group->$view_col)
@section("section", "Groups")
@section("section_url", url(config('laraadmin.adminRoute') . '/groups'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Groups Edit : ".$group->$view_col)

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
                {!! Form::model($group, ['route' => [config('laraadmin.adminRoute') . '.groups.update', $group->id ], 'method'=>'PUT', 'id' => 'group-edit-form']) !!}
                    @la_form($module)
                    {{--
                    @la_input($module, 'name')
                    --}}
                    <br>
                    <div class="form-group">
                    <div class="row">
                            <label for="">Users<sup>*</sup>:</label>
                            
                            <table class="table">
                                @foreach($username as $usernames)
                                <input type='text' id="removelist" name='removeuserlist' value=''>
                                    <tr class="tbrow_{{$usernames->id}}">
                                        <td>{{$usernames->name}}</td>
                                        <td><button class="btn btn-danger btn-xs" id="btneditdelete" value='{{$usernames->id}}' onclick="deleteuser({{$usernames->id}})" ><i class="fa fa-times"></i> Delete</button></td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="input-group">
                                <select class="form-control" required="1" data-placeholder="Select Operator" rel="select2" name="selectoperator" id="selectoperator">
                                        <option value="0" disabled selected>Select User</option>
                                    @foreach($user as $users)
                                        <option value="{{ $users->id}}">{{ $users->name }}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" id="btnoperator">Add</button>
                                </span>                  
                            </div>   
                    </div>

                    <div class="col">                         
                           <div class="panel panel-green operators">                               
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


                        {!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <a href="{{ url(config('laraadmin.adminRoute') . '/groups') }}" class="btn btn-default pull-right">Cancel</a>
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
    $("#group-edit-form").validate({
        
    });
});

let operator_row = 1;
    let operator = [];
    // Operators
    
    // Add
    document.querySelector("#btnoperator").addEventListener('click',addoperator);

    const table = document.querySelector("#operatortable").children[1];

    if(operator.length == 0)
    {
        document.querySelector(".operators").style.display = "none";
    }
    
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
                         <td><button class="btn btn-danger btn-xs" id="btndelete" onclick="deleteoperator(${operator_id})" ><i class="fa fa-times"></i> Delete</button></td>`
        
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
            table.appendChild(row);
            }
        }
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




    let user_row = 1;
    let user = [];
    let user_id=btneditdelete.value;
    function deleteuser(user_id)
        {
            $(`.tbrow_${user_id}`).remove();
            var user_info = String(user_id);
            var index = user.indexOf(user_info);
            if(index > -1) {
                user.splice(index, 1);
            }
            user_row--;
            console.log(user);
            
        }




</script>
@endpush

@extends('la.layouts.app')
@section('htmlheader_title')
Reservations View
@endsection
@section('main-content')
<div id="page-content" class="profile2">
    
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active fade in" id="tab-info">
            <div class="tab-content">
                <div class="panel infolist">
                    <div class="panel-default panel-heading">
                        <h4>Bookings</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-sm-12">
                            <div class="col-sm-6">
                                <form method="post" action="{{ url(config('laraadmin.adminRoute') . '/reservations/previous')}}" enctype="multipart/form-data" class="form-inline">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" class="scheduleid" name="schedule_id" value="{{$scheduleid}}">
                                    <input type="hidden" name="week" value="{{json_encode($week)}}">
                                    <button type="submit" class="btn btn-info previous" value="Previous">Previous</button>
                                </form>
                                <span class="startdate"></span>
                                <span>/</span>
                                <span class="enddate"></span>
                                <form method="post" action="{{ url(config('laraadmin.adminRoute') . '/reservations/next')}}" enctype="multipart/form-data" class="form-inline">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" class="scheduleid" name="schedule_id" value="{{$scheduleid}}">
                                    <input type="hidden" name="week" value="{{json_encode($week)}}">
                                    <button type="submit" class="btn btn-info next" value="Next" >Next</button>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary addreservation pull-right" data-toggle="modal" data-target-id="2" data-target="#AddNewBooking">Add Reservation</button>
                            </div>
                        </div>
                    <div>
                    <table id="custom-table">
                        <thead>
                            <?php
                            
                            if($module->row['same_layout']){
                                $for_same_day = DB::table('slot_ones')
                                    ->select('*')
                                    ->where('schedule_id', $scheduleid)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                            }else{
                                $for_same_day = DB::table('slot_zeros')
                                    ->select('*')
                                    ->where('schedule_id', $scheduleid)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                            }
                            
                            $data_resources = DB::table('resources')
                                ->select('resources.name','resources.id')
                                ->where('schedule', $scheduleid)
                                ->get();
                                
                            if($module->row['start_on'] == 8 && $module->row['no_of_days_visible'] > 1){
                                switch($module->row['no_of_days_visible']){
                                    case 1:
                                        if($module->row['same_layout'])
                                        $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>" . $res['start'] . "</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                    echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 2:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>" . $res['start'] . "</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                    echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 3:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                foreach ($result as $res) {
                                                    echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        $variable = str_replace( ['\'', '"', ',' , ';', '<', '>' ], ' ', $res['start']);
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 4:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 5:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 6:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 7:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;                                    
                                }
                            }elseif($module->row['start_on'] == 7 && $module->row['no_of_days_visible'] > 1){
                                switch($module->row['no_of_days_visible']){
                                    case 1:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 2:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 3:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 4:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 5:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']}} lass='res'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 6:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 7:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                }
                            }elseif($module->row['start_on'] == 6 && $module->row['no_of_days_visible'] > 1){
                                switch($module->row['no_of_days_visible']){
                                    case 1:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 2:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 3:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 4:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 5:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 6:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 7:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                }
                            }elseif($module->row['start_on'] == 5 && $module->row['no_of_days_visible'] > 1){
                                switch($module->row['no_of_days_visible']){
                                    case 1:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 2:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 3:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 4:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 5:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 6:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                    echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 7:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                     echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                }
                            }elseif($module->row['start_on'] == 4 && $module->row['no_of_days_visible'] > 1){
                                switch($module->row['no_of_days_visible']){
                                    case 1:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 2:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 3:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 4:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 5:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 6:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 7:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                }
                            }elseif($module->row['start_on'] == 3 && $module->row['no_of_days_visible'] > 1){
                                switch($module->row['no_of_days_visible']){
                                    case 1:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 2:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 3:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 4:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 5:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 6:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    break;
                                    case 7:
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_1);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_2);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_3);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_4);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_5);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_6);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                        if($module->row['same_layout'])
                                            $result = unserialize($for_same_day->time_slot);
                                        else
                                            $result = unserialize($for_same_day->time_slot_0);
                                        if (!empty($result)) {
                                            echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                            foreach ($result as $res) {
                                                echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                            }
                                            echo "</tr>";
                                            foreach ($data_resources as $data_resource) {
                                                echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                                    foreach ($result as $res) {
                                                        echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                                    }
                                                echo "</tr>";
                                            }
                                        }
                                    
                                    break;
                                }
                            }elseif(isset($for_same_day)){
                                if($module->row['same_layout'])
                                    $result = unserialize($for_same_day->time_slot);
                                else
                                    $result = unserialize($for_same_day->time_slot_0);
                                if (!empty($result)) {
                                    echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='sunday' data-sun=6></th> ";
                                    foreach ($result as $res) {
                                        echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($data_resources as $data_resource) {
                                        echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                            foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sun dates {$data_resource->id}'></td>";
                                            }
                                        echo "</tr>";
                                    }
                                }
                                if($module->row['same_layout'])
                                    $result = unserialize($for_same_day->time_slot);
                                else
                                    $result = unserialize($for_same_day->time_slot_1);
                                if (!empty($result)) {
                                    echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='monday' data-day=0></th> ";
                                    foreach ($result as $res) {
                                        echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($data_resources as $data_resource) {
                                        echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                            foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} data-mondaycolor='' class='slots dates {$data_resource->id} mondaycolor {$res['start']}'></td>";
                                            }
                                        echo "</tr>";
                                    }
                                }
                                if($module->row['same_layout'])
                                    $result = unserialize($for_same_day->time_slot);
                                else
                                    $result = unserialize($for_same_day->time_slot_2);
                                if (!empty($result)) {
                                    echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='tuesday' data-tue=1></th> ";
                                    foreach ($result as $res) {
                                        echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($data_resources as $data_resource) {
                                        echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                            foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots tuesdaycolor dates {$data_resource->id}'></td>";
                                            }
                                        echo "</tr>";
                                    }
                                }
                                if($module->row['same_layout'])
                                    $result = unserialize($for_same_day->time_slot);
                                else
                                    $result = unserialize($for_same_day->time_slot_3);
                                if (!empty($result)) {
                                    echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='wednesday' data-wed=2></th> ";
                                    foreach ($result as $res) {
                                        echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($data_resources as $data_resource) {
                                        echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                            foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots wed dates {$data_resource->id}'></td>";
                                            }
                                        echo "</tr>";
                                    }
                                }
                                if($module->row['same_layout'])
                                    $result = unserialize($for_same_day->time_slot);
                                else
                                    $result = unserialize($for_same_day->time_slot_4);
                                if (!empty($result)) {
                                    echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='thursday' data-thu=3></th> ";
                                    foreach ($result as $res) {
                                        echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($data_resources as $data_resource) {
                                        echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                            foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots thu dates {$data_resource->id}'></td>";
                                            }
                                        echo "</tr>";
                                    }
                                }
                                if($module->row['same_layout'])
                                    $result = unserialize($for_same_day->time_slot);
                                else
                                    $result = unserialize($for_same_day->time_slot_5);
                                if (!empty($result)) {
                                    echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='friday' data-fri=4></th> ";
                                    foreach ($result as $res) {
                                        echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($data_resources as $data_resource) {
                                        echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                            foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots fri dates {$data_resource->id}'></td>";
                                            }
                                        echo "</tr>";
                                    }
                                }
                                if($module->row['same_layout'])
                                    $result = unserialize($for_same_day->time_slot);
                                else
                                    $result = unserialize($for_same_day->time_slot_6);
                                if (!empty($result)) {
                                    echo "<tr class='ui-widget-content'><th class='resdate days px-5' id='saturday' data-sat=5></th> ";
                                    foreach ($result as $res) {
                                        echo "<td class='reslabel'>".$res['start'].'&nbsp;'."</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($data_resources as $data_resource) {
                                        echo "<tr data-id={$data_resource->id} class='ui-widget-content'><th>".$data_resource->name."</th>";
                                            foreach ($result as $res) {
                                                echo "<td data-id='' data-resourceid={$data_resource->id} data-date={$res['start']} class='slots sat dates {$data_resource->id}'></td>";
                                            }
                                        echo "</tr>";
                                    }
                                }
                            }
                        ?>
                        </thead> 
                    </table>
                </div>

                <!-- hidden div -->
                <div>
                    @foreach($bookdate as $bookdates)
                        <input type="hidden" class="bookdate" value="{{$bookdates}}">
                    @endforeach
                    @foreach($endbookdate as $endbookdates)
                        <input type="hidden" class="endbookdate" value="{{$endbookdates}}">
                    @endforeach
                    @foreach($reservation as $reservations)
                        <input type="hidden" class="begindate" value="{{$reservations->begin_date}}">
                        <input type="hidden" class="begintime" value="{{$reservations->begin_time}}">
                        <input type="hidden" class="resource" value="{{$reservations->resource_id}}">
                    @endforeach
                    @foreach($resource as $res)

                    @endforeach
                </div>
                  
            </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="AddNewBooking" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Reservation</h5>
            </div>
            <div class="modal-body">
                <div id="ok" class="container-fluid">
                    <form action="{{route('admin.reservations.store')}}" method="post" enctype="multipart/form-data" id="new_reservation_form">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />    
                        <input type="hidden" value="{{ Auth::user()->id }}" name="owner_id">
                        <input type="hidden" id="selected_booking_id" name="schedule_id" value = "{{$scheduleid}}" class="form-control input-sm" >
                        <input type="hidden" name="week" value="{{json_encode($week)}}">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label class="control-label">Resource : </label>                
                                <select class="js-example-basic-multiple form-control input-sm" onchange="getAccessoriesByResource(this.value)" name="resource" required>
                                    @foreach($resource as $resources)
                                        <option value="{{$resources->id}}">
                                            {{$resources->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="inputEmail4">Begin : <span style="color: red;">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="date" id="begindate" name="begin_date" required class="form-control input-sm" value="" onmouseout="getTheDays({{$module->row['same_layout']}})"> 
                                    </div>
                                    <div class="col-md-6">
                                        <select name="begin_time" id="begintime" class="form-control input-sm"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4">End : <span style="color: red;">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="date" id="enddate" name="end_date" class="form-control input-sm" value="" onmouseout="getTheEndDays({{$module->row['same_layout']}})" required>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="end_time" id="end_time" class="form-control input-sm"></select>
                                    </div>
                                </div>                  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Title : <span style="color: red">*</span></label>
                                <input type="text" required class="form-control input-sm" id="" name="title">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Description : </label>
                                <textarea cols="30" rows="2" class="form-control input-sm" name="description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="row">   
                                    <div class="col-md-12 mx-auto">
                                        <label class="control-label">Participants : </label>                
                                        <select class="js-example-basic-multiple form-control input-sm" name="user_id[]" multiple="multiple">
                                            @foreach($user as $users)
                                                @if($users->id != 1)
                                                <option value="{{$users->id}}">{{$users->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Invitees(comma(,) separted for each mail) :</label>
                                <input type="text" class="form-control input-sm" name="invitees">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                    <label>Accessories</label>
                            </div> 
                            <div class="col-md-3">
                                    <label>Quantity Requested</label>
                            </div>    
                            <div class="col-md-3">
                                    <label>Quantity Available</label>
                            </div>    
                            <div class="col-md-3">
                                    <label>Actions</label>
                            </div>    
                        </div>
                        <div class="inc_row">
                            <?php $i = 1 ?>
                            <div class="row" id="accessories_grid_{{ $i }}">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control input-sm" data-placeholder="Select Accessories" rel="select2" onchange="GetAccessory(this.value, {{$i}})" id="accessories_{{$i}}" name="accessories_{{$i}}" required>
                                            <option selected disabled>Choose Accessories</option>
                                            @foreach($accessorie as $accessories)
                                                <option value="{{ $accessories->id }}">{{ $accessories->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="requested_{{ $i }}" id="requested_{{ $i }}" onkeypress="return isNumberdecimal(this.event)"  class="form-control input-sm" placeholder="Quantity Requested">
                                    </div>                       
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="available_{{ $i }}" onkeypress="return isNumberdecimal(this.event)" readonly="true" class="form-control input-sm" id="available_{{ $i }}" >
                                </div>
                                <div class="col-md-3 next">
                                    <div class="form-group">
                                        <a class="btn btn-primary btn-sm" onclick="insertRow()"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow({{ $i }})"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="count1" id="count1" value="{{ $i }}"> 
                        </div>
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="row col-sm-12">
                            <div class="form-group col-sm-6">
                                <button type="submit" class="btn btn-sm btn-primary pull-right" >Create</button>
                            </div>
                            <div class="form-group col-sm-6">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>  
                <div>
            </div> 
        </div>                
    </div>
</div>

@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/mine.css') }}"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #feedback { font-size: 1.4em; }
    #custom-table .ui-selecting { background: #FECA40; }
    #custom-table .ui-selected { background: #F39814; color: white; }
    #custom-table { list-style-type: none; margin: 0; padding: 0; width: 100%; border: solid #36648B 1px;  }
    #custom-table td { margin: 3px; padding: 0.4em; height: 30px; border: solid #36648B 1px; }
    #custom-table
    {
        margin-top: 30px;
    }
    .addreservation
    {
        margin-left: 900px;
    }
    th{
        padding-left: 10px;
        padding-bottom: 0px;
        border: solid #36648B 1px;
    }
    .resdate{
        width: 200px;
        padding: 0 3px;
        background-color: #36648B !important;
        color: #F0F0F0 !important;
    }
    td.reslabel {
        padding-left: 2px;
        background-color: #EDEDED !important;
        color: #333333 !important;
    }
</style>
@endpush
@push('scripts')
<script src="{{ asset('la-assets/mine.js') }}"></script>
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

<!----------------------------------------------------------------------------------------------------->
<script type="text/javascript">

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.acinput').hide();
        $('.acces').click(function(){
            $('.acinput').show();
        });

        var first, day;

        var week = <?php echo json_encode($week); ?>;
        dateBinding(week);

        $("#new_reservation_form").validate({

        });
    });
    
</script>
<!----------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('#csrf-token').attr('content')
        }
    });
</script>
<!-------------------------time binding in new reservations ----------------------------->
<script type="text/javascript">
    function getTheDays(same_layout) {
        var dategtc = new Date($('#begindate').val());
        var day=dategtc.getDay();

        $('#enddate').val($('#begindate').val());

        var scheduleidone =$('#selected_booking_id').val();
        var date = new Date(dategtc.getTime() - (dategtc.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
       
        $.ajax({
            type: "POST",
            data: {"_token": "{{ csrf_token() }}","day": day,"scheduleidone": scheduleidone, "same_layout" : same_layout},
            url: "{{ url(config('laraadmin.adminRoute') . '/getstartendtime') }}",
            success: function(response)
            {
                var day=response.day;
                var data=response.betimes;
                var i = 0;
                $("#begintime").html('');
                if(day=='0'){
                    for(i=0;i<data.length;i++)
                    {
                        $("#begintime").append('<option value=' + data[i].start+ '>' +data[i].start+ '</option>');
                    }
                }else if(day=='1'){
                    for(i=0;i<data.length;i++)
                    {
                        $("#begintime").append('<option value=' + data[i].start+ '>' +data[i].start+ '</option>');
                    }
                }else if(day=='2'){
                    for(i=0;i<data.length;i++)
                    {
                        $("#begintime").append('<option value=' + data[i].start+ '>' +data[i].start+ '</option>');
                    }
                }else if(day=='3'){
                    for(i=0;i<data.length;i++)
                    {
                        $("#begintime").append('<option value=' + data[i].start+ '>' +data[i].start+ '</option>');
                    }
                }
                else if(day=='4'){
                    for(i=0;i<data.length;i++)
                    {
                        $("#begintime").append('<option value=' + data[i].start+ '>' +data[i].start+ '</option>');
                    }
                }
                else if(day=='5'){
                    for(i=0;i<data.length;i++)
                    {
                        $("#begintime").append('<option value=' + data[i].start+ '>' +data[i].start+ '</option>');
                    }
                }
                else if(day=='6'){
                    for(i=0;i<data.length;i++)
                    {
                        $("#begintime").append('<option value=' + data[i].start+ '>' +data[i].start+ '</option>');
                    }
                }
            }
        });
    }
        
    function getTheEndDays(same_layout) {
        var enddate = new Date($('#enddate').val());
        var day = enddate.getDay();

        var scheduleidone =$('#selected_booking_id').val();
        var date = new Date(enddate.getTime() - (enddate.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        
        $.ajax({
            type: "POST",
            data: {"_token": "{{ csrf_token() }}","day": day,"scheduleidone": scheduleidone, "same_layout" : same_layout},
            url: "{{ url(config('laraadmin.adminRoute') . '/getstartendtime') }}",
            success: function(response)
            {
                var day=response.day;
                var data=response.betimes;
                var i = 0;
                $("#end_time").html('');
                if(day=='0')
                {
                    for(i=0;i<data.length;i++)
                    {
                        $("#end_time").append('<option value=' + data[i].end+ '>' +data[i].end+ '</option>');
                    }
                }else if(day=='1')
                {
                    for(i=0;i<data.length;i++)
                    {
                        $("#end_time").append('<option value=' + data[i].end+ '>' +data[i].end+ '</option>');
                    }
                }else if(day=='2')
                {
                    for(i=0;i<data.length;i++)
                    {
                        $("#end_time").append('<option value=' + data[i].end+ '>' +data[i].end+ '</option>');
                    }
                }else if(day=='3')
                {
                    for(i=0;i<data.length;i++)
                    {
                        $("#end_time").append('<option value=' + data[i].end+ '>' +data[i].end+ '</option>');
                    }
                }else if(day=='4')
                {
                    for(i=0;i<data.length;i++)
                    {
                        $("#end_time").append('<option value=' + data[i].end+ '>' +data[i].end+ '</option>');
                    }
                }else if(day=='5')
                {
                    for(i=0;i<data.length;i++)
                    {
                        $("#end_time").append('<option value=' + data[i].end+ '>' +data[i].end+ '</option>');
                    }
                }else if(day=='6')
                {
                    for(i=0;i<data.length;i++)
                    {
                        $("#end_time").append('<option value=' + data[i].end+ '>' +data[i].end+ '</option>');
                    }
                }
            }
        });
    }
</script>
<!-- date binding -->
<script type="text/javascript">
function dateBinding(week){
    $('.startdate').html(week[0]);
    $('.startdate').attr("data-start",week[0]);
    $('.enddate').html(week[6]);
    $('.enddate').attr("data-end",week[6]);

    var mon = $(".days").map(function() {
        return $(this).data('day');
    }).get();
    if(mon==0)
    {
        $('#monday').html("Monday, "+week[0]);
    }
    var tue = $(".days").map(function() {
        return $(this).data('tue');
    }).get();
    if(tue==1)
    {
        $('#tuesday').html("Tuesday, "+week[1]);
    }
    var wed = $(".days").map(function() {
        return $(this).data('wed');
    }).get();
    if(wed==2)
    {
        $('#wednesday').html("Wednesday, "+week[2]);
    }
    var thu = $(".days").map(function() {
        return $(this).data('thu');
    }).get();
    if(thu==3)
    {
        $('#thursday').html("Thursday, "+week[3]);
    }
    var fri = $(".days").map(function() {
        return $(this).data('fri');
    }).get();
    if(fri==4)
    {
        $('#friday').html("Friday, "+week[4]);
    }
    var sat = $(".days").map(function() {
        return $(this).data('sat');
    }).get();
    if(sat==5)
    {
        $('#saturday').html("Saturday, "+week[5]);
    }
    var sun = $(".days").map(function() {
        return $(this).data('sun');
    }).get();
    if(sun==6)
    {
        $('#sunday').html("Sunday, "+week[6]);
    }
     //set date for monday to table column
     var weekdayone=week[0];
    $('.mondaycolor').attr("data-color",weekdayone);

    //set date for tuesday to table column
    var tuesday=week[1];
    $('.tuesdaycolor').attr("data-color",tuesday);

    //set date for wed to table column
    var wednesday=week[2];
    $('.wed').attr("data-color",wednesday);
    
    //set date for thu to table column
    var thursday=week[3];
    $('.thu').attr("data-color",thursday);

    //set date for fri to table column
    var friday=week[4];
    $('.fri').attr("data-color",friday);

    //set date for sat to table column
    var saturday=week[5];
    $('.sat').attr("data-color",saturday);

    //set date for sun to table column
    var sunday=week[6];
    $('.sun').attr("data-color",sunday);

    //get resourceid value from table column
    var resourceid = $(".slots").map(function() {
    var resource_id= $(this).data('resourceid');
    var time = $(this).data('date');
    var endtime = $(this).data('endtime');
    var curweekdate = $(this).attr("data-color");
    var cdtid = curweekdate+time+resource_id;
    var cetid = curweekdate+endtime+resource_id;
    var curdatetimeid = cdtid.replace(/([:-])+/g, "");
    var curenddatetimeid = cetid.replace(/([:-])+/g, "");
    
    //set data-attribute for start to table column
        $(this).attr("data-id",curdatetimeid);
    }).get();

    colorBinding();
}

function colorBinding(){
    //get resourceid value from database
    var resource= $(".resource").map(function() {
        return $(this).val();         
    }).get();
    //get resourceid value from table column
    var resourceid = $(".slots").map(function() {
        var resource_id = $(this).data('resourceid');
        var time = $(this).data('date');
        var endtime = $(this).data('endtime');
        var date = $(this).data('color');
        var dtid = date + time + resource_id;
        var date_time = date + time;

        var datetimeid = dtid.replace(/([:-])+/g, "");
        date_time = date_time.replace(/([:-])+/g, "");

        $(this).attr("data-id",datetimeid);
        $(this).attr("data-datetime", date_time);
    }).get();

    var now = new Date();
    var current_date_time = moment(now).format('YYYYMMDDHHmm');

    $('.slots').each(function(slot)
    {
        var slot_data = $(this).data('id');
        var date_time = $(this).data('datetime');
        $.each(databasedatetime,function(i,v) //v - start date, val - end date
        { 
            val = databaseenddatetime[i];

            var dt_val = val.substring(0, 12);
            var res_val = val.substring(12);

            var dt_v = v.substring(0, 12);
            var res_v = v.substring(12);

            var dt_slot = slot_data.toString().substring(0, 12);
            var res_slot = slot_data.toString().substring(12);
            
            if(dt_v <= dt_slot && dt_val > dt_slot && res_v == res_slot && res_val == res_slot)
            {
                $('[data-id="'+slot_data+'"]').css('background-color', '');
                $('[data-id="'+slot_data+'"]').addClass('bg-success');
            }else{
                $('[data-id="'+slot_data+'"]').addClass('bg-default');
            }                        
        });
    });
}
</script>
<!-------------------------Add Color------------------------------------------------------------------------>
<script type="text/javascript">          

    var databasedatetime= $(".bookdate").map(function() {
        return $(this).val();         
    }).get();
    var databaseenddatetime=$(".endbookdate").map(function(){
        return $(this).val();
    }).get();
      
</script>
<!------------------------------------Accessories Grid------------------------------------------------------>
<script>
// var accessories = <?php echo json_encode($accessorie) ?>;
var accessories = [];
function getAccessoriesByResource(resource_id){
    $.ajax({
        "url" : "{{ url(config('laraadmin.adminRoute') . '/accessories_by_resourceid') }}",
        type: 'POST',
        data : {'_token': '{{ csrf_token() }}', 'resource_id' : resource_id},
        success: function(data)
        {
            console.log(data);
        }
    });
}
function GetAccessory(accessories_id, grid_count){
    console.log(accessories);
}
function isNumberdecimal(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode <= 45 || charCode > 57 || charCode == 47 )) {
        return false;
    }
    return true;
}
var grid1;
function insertRow()
{
    grid1 = $("#count1").val();
    grid1++;
    $("#count1").val(grid1);
    var new_entry1 = `<div class="row" id="accessories_grid_${grid1}">
            <div class="col-md-3">
                <div class="form-group">
                    <select class="form-control input-sm" data-placeholder="Select Accessories" rel="select2" id="accessories_${grid1}" name="accessories_${grid1}">
                        <option selected disabled>Choose Accessories</option>
                        @foreach($accessorie as $accessories)
                            <option value="{{ $accessories->id }}">{{ $accessories->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="requested_${grid1}" id="requested_${grid1}" onkeypress="return isNumberdecimal(this.event)" class="form-control input-sm" placeholder="Quantity Requested">
                </div>                       
            </div>
            <div class="col-md-3">
                <input type="text" name="available_${grid1}" onkeypress="return isNumberdecimal(this.event)" readonly="true" class="form-control input-sm" id="available_${grid1}" >
            </div>
            <div class="col-md-3 next">
                <div class="form-group">
                    <a class="btn btn-primary btn-sm" onclick="insertRow()"><i class="fa fa-plus"></i></a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(${grid1})"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>`;
    grid1--;                        
    $(".inc_row").append(new_entry1);
}

function deleteRow(grid_no){
    var count = $("#count1").val();
    if(count > 1)
    {
        $("#accessories_grid_"+grid_no).remove();   
    }
    else
    {
        alert('Rows cannot be removed');
    }
    count--;
    $("#count1").val(count);
}
</script>
@endpush





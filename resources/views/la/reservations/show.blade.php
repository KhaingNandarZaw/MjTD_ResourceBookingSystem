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
                            
                            if(isset($_GET['slotid']) && $_GET['slotid'] !== 'undefined')
                            {
                                $current_slot_id = $_GET['slotid'];
                                $for_same_day = DB::table('slot_zeros')
                                    ->select('*')
                                    ->where('schedule_id', $scheduleid)
                                    ->find($current_slot_id);
                            }
                            elseif(isset($_GET['slotid']) && $_GET['slotid'] == 'undefined')
                            {
                                $for_same_day = DB::table('slot_zeros')
                                    ->select('*')
                                    ->where('schedule_id', $scheduleid)
                                    ->orderBy('created_at', 'desc')
                                    ->first(); 
                            }
                            elseif(!isset($_GET['slodid']))
                            {
                                $for_same_day = DB::table('slot_zeros')
                                    ->select('*')
                                    ->where('schedule_id', $scheduleid)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                            }
                            elseif(isset($_GET['previous']))
                            {
                                $for_same_day = DB::table('slot_zeros')
                                    ->select('*')
                                    ->where('schedule_id', $scheduleid)
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                            }
                            elseif(isset($_GET['next']))
                            {
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
                                    case 2:
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
                                                    print_r($res['end_0'].'&nbsp;'.'&nbsp;');
                                                    }
                                                echo "</tr>";
                                                    print_r();
                                            }
                                        }
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
                            }elseif($module->row['start_on'] == 7 && $module->row['no_of_days_visible'] > 2){
                                switch($module->row['no_of_days_visible']){
                                    case 3:
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
                            }elseif($module->row['start_on'] == 6 && $module->row['no_of_days_visible'] > 3){
                                switch($module->row['no_of_days_visible']){
                                    case 4:
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
                            }elseif($module->row['start_on'] == 5 && $module->row['no_of_days_visible'] > 4){
                                switch($module->row['no_of_days_visible']){
                                    case 5:
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
                            }elseif($module->row['start_on'] == 4 && $module->row['no_of_days_visible'] > 5){
                                switch($module->row['no_of_days_visible']){
                                    case 6:
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
                            }elseif($module->row['start_on'] == 3 && $module->row['no_of_days_visible'] > 6){
                                switch($module->row['no_of_days_visible']){
                                    case 7:
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
                    <form action="{{route('admin.reservations.store')}}" method="post" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />    
                            <input type="hidden" value="{{ Auth::user()->id }}" name="owner_id">
                            <input type="hidden" id="selected_booking_id" name="schedule_id" value = "{{$scheduleid}}" class="form-control input-sm" >
                            <input type="hidden" name="week" value="{{json_encode($week)}}">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="control-label">Resource</label>                
                                    <select class="js-example-basic-multiple form-control" name="resource">
                                        @foreach($resource as $resources)
                                            <option value="{{$resources->id}}">
                                                {{$resources->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail4">Begin <span style="color: red;">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" id="begindate" name="begin_date" required class="form-control" value=""  onmouseout="getTheDays()"> 
                                        </div>
                                        <div class="col-md-6">
                                            <select name="begin_time" id="begintime" class="form-control"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4">End <span style="color: red;">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" id="enddate" name="end_date" class="form-control" value="" onmouseout="getTheEndDays()">
                                        </div>
                                        <div class="col-md-6">
                                            <select name="end_time" id="end_time" class="form-control"></select>
                                        </div>
                                    </div>                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Title <span style="color: red">*</span></label>
                                    <input type="text" required class="form-control" id="" name="title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Description</label>
                                    <textarea cols="30" rows="2" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="row">   
                                        <div class="col-md-12 mx-auto">
                                            <label class="control-label">Participant</label>                
                                            <select class="js-example-basic-multiple form-control" name="user_id[]" multiple="multiple">
                                                @foreach($user as $users)
                                                    <option value="{{$users->id}}">
                                                        {{$users->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-group col-md-6">
                                    <label>Invitees</label>
                                    <input type="email" class="form-control" name="invitees">
                                </div>
                            </div>

                            <!-- Main -->
                            <div class="form-group">
                                <div class="col">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cart">Accessories (<span class="total-count"></span>)</button>
                                    <a href="#" class="clear-cart btn btn-danger">Clear</a>
                                </div>
                            </div>

                            <div>
                                <table class="show-cart table table-hover table-bordered"></table>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Accessories</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-hover">
                                                    <tr>
                                                        <th>Accessory</th>
                                                        <th>Quantity Requested</th>
                                                        <th>Quantity Available</th>
                                                    </tr>
                                                @foreach($accessorie as $accessories)
                                                    <tr>
                                                        <td data-id="{{$accessories->id}}">{{$accessories->name}}</td>
                                                        <td><input type="number" data-id="{{$accessories->id}}" data-name="{{$accessories->name}}" class="add-to-cart  mt-3 cart-form"></td>
                                                        <td>{{$accessories->available_quantity}} <input type="hidden" data-aqid="{{$accessories->available_quantity}}" class="available_quantity" value="{{$accessories->available_quantity}}"></td>
                                                    </tr>
                                                @endforeach
                                            </table> 
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <button class="btn btn-success">Create</button>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
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
    function getTheDays() {
        var dategtc = new Date($('#begindate').val());
        var day=dategtc.getDay();

        $('#enddate').val($('#begindate').val());

        var scheduleidone =$('#selected_booking_id').val();
        var date = new Date(dategtc.getTime() - (dategtc.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
       
        $.ajax({
            type: "POST",
            data: {"_token": "{{ csrf_token() }}","day": day,"scheduleidone": scheduleidone},
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
        
    function getTheEndDays() {
        var enddate = new Date($('#enddate').val());
        var day = enddate.getDay();

        var scheduleidone =$('#selected_booking_id').val();
        var date = new Date(enddate.getTime() - (enddate.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
        
        $.ajax({
            type: "POST",
            data: {"_token": "{{ csrf_token() }}","day": day,"scheduleidone": scheduleidone},
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
<!--------------------------accessories added-------------------------------------------->
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.js-example-basic-multiples').select2();
        $('.acinput').hide();
        $('.acces').click(function(){
            $('.acinput').show();
        })    
        var quantity=[];
            $('.add').click(function (){
                quantity.push(document.getElementById('accquantity').value)
            }); 
            function displayAccessories(){
                for(i=0; i<quantity.length; i++){
                    quantity[i];
                }
            }
            function getInputValue(){
                    // Selecting the input element and get its value 
                    var inputVal = document.getElementById("myInput").value;
                }
    });
</script>

<script type="text/javascript">
    var shoppingCart = (function() {
    cart = [];
    function Item(name, id, count) {
        this.name = name;
        this.id = id;
        this.count = count;
    }
    // Save cart
    function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
    }
    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }

    var obj = {};
    // Add to cart
    obj.addItemToCart = function(name, id, count) {
        for(var item in cart) {
        if(cart[item].name === name) {
            cart[item].count ++;
            saveCart();
            return;
        }
        }
        var item = new Item(name, id, count);
        cart.push(item);
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(name) {
        for(var item in cart) {
        if(cart[item].name === name) {
            cart.splice(item, 1);
            break;
        }
        }
        saveCart();
        
    }
    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }
    // Count cart 
    obj.totalCount = function() {
        var totalCount = 0;
        for(var item in cart) {
        totalCount += cart[item].count;
        }
        return totalCount;
    }
    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for(var item in cart) {
        totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }
    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for(i in cart) {
        item = cart[i];
        itemCopy = {};
        for(p in item) {
            itemCopy[p] = item[p];

        }
        itemCopy.total = Number(item.price * item.count).toFixed(2);
        cartCopy.push(itemCopy)
        }
        return cartCopy;
    }
    return obj;
    })();
    // Add item
    
    $('.add-to-cart').click(function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    var id = Number($(this).data('id'));
    shoppingCart.addItemToCart(name, id, 1);
    displayCart();
    var value=$(this).val();
    var quantity=$(".available_quantity").val();
    
    // for(var v in quanity)
    // {
    //     alert(v);
    // }
    });
    // Clear items
    $('.clear-cart').click(function() {
    shoppingCart.clearCart();
    displayCart();
    $(".add-to-cart").val('');
    });
    function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "<tr><th>Accessory</th><th>Quantity Requested</th><th>Quantity Available</th></tr>";
    for(var i in cartArray) {
        output += "<tr>"
        + "<td>" + "<span>"+ cartArray[i].name +"</span><input type='hidden' name='accessories_id[]' class='item-count' data-name='" + cartArray[i].name + "' value='" + cartArray[i].id + "'>"+ "</td>" 
        
        + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>"
        + "<input type='number' name='quantity[]' class='item-count  mt-3 cart-form d-inline' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
        + "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>"
        + "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>"
        + " = " 
        +  "</tr>";
    }
    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
    }
    // Delete item button
    $('.show-cart').on("click", ".delete-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
    //$(".add-to-cart").val('');
    })
    // -1
    $('.show-cart').on("click", ".minus-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.removeItemFromCart(name);
    displayCart();
    })
    // +1
    $('.show-cart').on("click", ".plus-item", function(event) {
    var name = $(this).data('name')
    shoppingCart.addItemToCart(name);
    displayCart();
    })
    // Item count input
    $('.show-cart').on("change", ".item-count", function(event) {
    var name = $(this).data('name');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
    });
    displayCart();
</script>
<!----------------------------------------------------------------------------------------------------->
<script type="text/javascript">
  $(".add-to-cart").click(function(){
    $("show-cart").show();
  })
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

            if(current_date_time > date_time){
                $('[data-id="'+slot_data+'"]').css('background-color', '#CF9D9B');
            }
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
@endpush





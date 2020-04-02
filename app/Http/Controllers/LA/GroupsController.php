<?php
/**
 * Controller generated using LaraAdmin
 * Help: http://laraadmin.com
 * LaraAdmin is open-sourced software licensed under the MIT license.
 * Developed by: Dwij IT Solutions
 * Developer Website: http://dwijitsolutions.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Group;
use App\Models\User_Group;
use App\Models\User;

class GroupsController extends Controller
{
    public $show_action = true;
    
    /**
     * Display a listing of the Groups.
     *
     * @return mixed
     */
    public function index()
    {
        $module = Module::get('Groups');
        $user   = User::get();
        
        if(Module::hasAccess($module->id)) {
            return View('la.groups.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => Module::getListingColumns('Groups'),
                'module' => $module,
                'user' => $user
            ]);
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Show the form for creating a new group.
     *
     * @return mixed
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created group in database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if(Module::hasAccess("Groups", "create")) {
            
            $rules = Module::validateRules("Groups", $request);
            
            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $insert_id = Module::insert("Groups", $request);
            
            $user_id = $request->user_id; 
            
            foreach($user_id as $user)
            {
                $reservations_user=User_Group::create([
                    'user_id' => $user,
                    'group_id' =>$insert_id
                ]);
            }
            
            
            return redirect()->route(config('laraadmin.adminRoute') . '.groups.index');
            
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Display the specified group.
     *
     * @param int $id group ID
     * @return mixed
     */
    public function show($id)
    {
        $sql = "select users.name from users left join user_groups on user_groups.user_id = users.id
                left join groups on groups.id = user_groups.group_id
                where users.deleted_at is null and user_groups.deleted_at is null and groups.deleted_at is null and groups.id = $id";
            $query = DB::table(DB::raw("($sql) as catch"));
            $username = $query->get();
        
        if(Module::hasAccess("Groups", "view")) {
            
            $group = Group::find($id);
            if(isset($group->id)) {
                $module = Module::get('Groups');
                $module->row = $group;
                
                return view('la.groups.show', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                    'no_header' => true,
                    'no_padding' => "no-padding"
                ])->with('group', $group)
                  ->with('username', $username);
            } else {
                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("group"),
                ]);
            }
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Show the form for editing the specified group.
     *
     * @param int $id group ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $sql = "select users.* from users left join user_groups on user_groups.user_id = users.id
                left join groups on groups.id = user_groups.group_id
                where users.deleted_at is null and user_groups.deleted_at is null and groups.deleted_at is null and groups.id = $id";
        $query = DB::table(DB::raw("($sql) as catch"));
        $username = $query->get();
       
        $user_group=DB::table('user_groups')
                    ->select("id")
                    ->where("group_id",$id)
                    ->get();
        
        $user   = User::get();
        if(Module::hasAccess("Groups", "edit")) {
            $group = Group::find($id);
            if(isset($group->id)) {
                $module = Module::get('Groups');
                
                $module->row = $group;
                
                return view('la.groups.edit', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                ])->with('group', $group)
                ->with('user',$user)
                ->with('username',$username)
                ->with('user_group',$user_group);
            } else {
                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("group"),
                ]);
            }
            
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Update the specified group in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id group ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        
        dd($request);
        if(Module::hasAccess("Groups", "edit")) {
            
            $rules = Module::validateRules("Groups", $request, true);
            
            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();;
            }
            
            $insert_id = Module::updateRow("Groups", $request, $id);
            $user_id = $request->user_id;  
            
            foreach($user_id as $user)
            {
                $group = User_Group::find($id);
                $group->user_id = $user;
                $group->group_id = $insert_id;
                $group->save();
            }
            return redirect()->route(config('laraadmin.adminRoute') . '.groups.index');
            
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Remove the specified group from storage.
     *
     * @param int $id group ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(Module::hasAccess("Groups", "delete")) {
            Group::find($id)->delete();
            
            // Redirecting to index() method
            return redirect()->route(config('laraadmin.adminRoute') . '.groups.index');
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Server side Datatable fetch via Ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dtajax(Request $request)
    {
        $module = Module::get('Groups');
        $listing_cols = Module::getListingColumns('Groups');
        
        $values = DB::table('groups')->select($listing_cols)->whereNull('deleted_at');
        $out = Datatables::of($values)->make();
        $data = $out->getData();
        
        $fields_popup = ModuleFields::getModuleFields('Groups');
        
        for($i = 0; $i < count($data->data); $i++) {
            for($j = 0; $j < count($listing_cols); $j++) {
                $col = $listing_cols[$j];
                if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                    $data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
                }
                if($col == $module->view_col) {
                    $data->data[$i][$j] = '<a href="' . url(config('laraadmin.adminRoute') . '/groups/' . $data->data[$i][0]) . '">' . $data->data[$i][$j] . '</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            
            if($this->show_action) {
                $output = '';
                if(Module::hasAccess("Groups", "edit")) {
                    $output .= '<a href="' . url(config('laraadmin.adminRoute') . '/groups/' . $data->data[$i][0] . '/edit') . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                }
                
                if(Module::hasAccess("Groups", "delete")) {
                    $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.groups.destroy', $data->data[$i][0]], 'method' => 'delete', 'style' => 'display:inline']);
                    $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                    $output .= Form::close();
                }
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}

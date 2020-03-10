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

use App\Models\Accessory;

class AccessoriesController extends Controller
{
    public $show_action = true;
    
    /**
     * Display a listing of the Accessories.
     *
     * @return mixed
     */
    public function index()
    {
        $module = Module::get('Accessories');
        
        if(Module::hasAccess($module->id)) {
            return View('la.accessories.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => Module::getListingColumns('Accessories'),
                'module' => $module
            ]);
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Show the form for creating a new accessory.
     *
     * @return mixed
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created accessory in database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if(Module::hasAccess("Accessories", "create")) {
            
            $rules = Module::validateRules("Accessories", $request);
            
            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $insert_id = Module::insert("Accessories", $request);
            
            return redirect()->route(config('laraadmin.adminRoute') . '.accessories.index');
            
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Display the specified accessory.
     *
     * @param int $id accessory ID
     * @return mixed
     */
    public function show($id)
    {
        if(Module::hasAccess("Accessories", "view")) {
            
            $accessory = Accessory::find($id);
            if(isset($accessory->id)) {
                $module = Module::get('Accessories');
                $module->row = $accessory;
                
                return view('la.accessories.edit', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                    'no_header' => true,
                    'no_padding' => "no-padding"
                ])->with('accessory', $accessory);
            } else {
                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("accessory"),
                ]);
            }
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Show the form for editing the specified accessory.
     *
     * @param int $id accessory ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        if(Module::hasAccess("Accessories", "edit")) {
            $accessory = Accessory::find($id);
            if(isset($accessory->id)) {
                $module = Module::get('Accessories');
                
                $module->row = $accessory;
                
                return view('la.accessories.edit', [
                    'module' => $module,
                    'view_col' => $module->view_col,
                ])->with('accessory', $accessory);
            } else {
                return view('errors.404', [
                    'record_id' => $id,
                    'record_name' => ucfirst("accessory"),
                ]);
            }
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Update the specified accessory in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id accessory ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if(Module::hasAccess("Accessories", "edit")) {
            
            $rules = Module::validateRules("Accessories", $request, true);
            
            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();;
            }
            
            $insert_id = Module::updateRow("Accessories", $request, $id);
            
            return redirect()->route(config('laraadmin.adminRoute') . '.accessories.index');
            
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }
    
    /**
     * Remove the specified accessory from storage.
     *
     * @param int $id accessory ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(Module::hasAccess("Accessories", "delete")) {
            Accessory::find($id)->delete();
            
            // Redirecting to index() method
            return redirect()->route(config('laraadmin.adminRoute') . '.accessories.index');
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
        $module = Module::get('Accessories');
        $listing_cols = Module::getListingColumns('Accessories');
        
        $values = DB::table('accessories')->select($listing_cols)->whereNull('deleted_at');
        $out = Datatables::of($values)->make();
        $data = $out->getData();
        
        $fields_popup = ModuleFields::getModuleFields('Accessories');
        
        for($i = 0; $i < count($data->data); $i++) {
            for($j = 0; $j < count($listing_cols); $j++) {
                $col = $listing_cols[$j];
                if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
                    $data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
                }
                if($col == $module->view_col) {
                    $data->data[$i][$j] = '<a href="' . url(config('laraadmin.adminRoute') . '/accessories/' . $data->data[$i][0]) . '">' . $data->data[$i][$j] . '</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            
            if($this->show_action) {
                $output = '';
                if(Module::hasAccess("Accessories", "edit")) {
                    $output .= '<a href="' . url(config('laraadmin.adminRoute') . '/accessories/' . $data->data[$i][0] . '/edit') . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                }
                
                if(Module::hasAccess("Accessories", "delete")) {
                    $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.accessories.destroy', $data->data[$i][0]], 'method' => 'delete', 'style' => 'display:inline']);
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

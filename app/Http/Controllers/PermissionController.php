<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Permission;
use App\RoleHasPermission;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
       
        $permissionDetails = Permission::orderBy('id', 'DESC')->get();
        return view('admin.permission.index',compact('permissionDetails'));
    }

    public function create(Request $request)
    {
        $view =   view('admin.permission.create')->render();
        if(!empty($view)){
            return response()->json(['code' => 200, 'view' => $view]);
        }else{
            return response()->json(['code' => 100, 'view' => '']);
        }
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $permission = Permission::create($request->all());
        $permission_id = $permission->id;
        $superAdmin = Role::where('name', '=', "admin")->select('id')->first();
        $superAdmin = $superAdmin->id;
        $dataPer=array();
        $dataPer['permission_id']=$permission_id;
        $dataPer['role_id']=$superAdmin;
        $rolePerm = RoleHasPermission::create($dataPer);
        if(!empty($rolePerm)){
            return redirect()->route('permission.index');   
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }
    }

    public function edit(Request $request)
    {
        $inputData = $request->all();
        $id = $inputData['id'];
        $permissionDetails = Permission::where(['id' => $id])->first();
        $view = view('admin.permission.create',compact('permissionDetails'))->render();
        if(!empty($view)){
            return response()->json(['code' => 200, 'view' => $view]);
        }else{
            return response()->json(['code' => 100, 'view' => '']);
        }
    }

    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        if(empty($permission)){
            return redirect()->route('permission.index');   
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }
          
    }
    


}

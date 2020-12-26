<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\RoleHasPermission;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $roleDetails = Role::orderBy('id', 'DESC')->get();
        return view('admin.role.index',compact('roleDetails'));
    }

    public function create(Request $request)
    {
        $permissionDetails = Permission::orderBy('id', 'DESC')->get();
        return view('admin.role.create',compact('permissionDetails'));
    }

    public function store(Request $request)
    {   
        $input = $request->all();
        $role = Role::create($input);
        $roleId = $role->id;
        foreach ($input['mainPer'] as $value) {
           
            $dataPer=array();
            $dataPer['permission_id']=$value;
            $dataPer['role_id']=$roleId;
            $rolePerm = RoleHasPermission::create($dataPer);
        }
        if(!empty($rolePerm)){
            return redirect()->route('role.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }
        
    }

    public function edit($id)
    {
        $roleDetails = Role::where('id', '=' , $id)->first();
        $permissionDetails = Permission::get();
        //print_r($id);exit;
        $roleHasPermissions = RoleHasPermission::where('role_id', '=' , $id)->get();
        if(!empty($roleHasPermissions)){
            foreach($roleHasPermissions as $roleHasPermissionsVal){
                $data[] = $roleHasPermissionsVal['permission_id'];
            }
        }
        return view('admin.role.create',compact('roleDetails','permissionDetails','data'));
    }

    public function update(Request $request,$id)
    {
            $input = $request->all();
           // print_r($input); exit;
            $roles['name']= $input['name'];
            $role = Role::findOrFail($id);
            $role->update($roles);
            if(!empty($input['mainPer'])){
            $roleHasPermissions = RoleHasPermission::where('role_id','=',$id)->delete();
               $roleId = $id;
            foreach ($input['mainPer'] as $value) {
               
                $dataPer=array();
                $dataPer['permission_id']=$value;
                $dataPer['role_id']=$roleId;
                $rolePerm = RoleHasPermission::create($dataPer);
            }
            return redirect()->route('role.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\RoleHasPermission;
use DB;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $userDetails = User::leftjoin('model_has_roles','model_has_roles.model_id', '=', 'users.id')
        ->leftjoin('roles','roles.id', '=', 'model_has_roles.role_id')
        ->where(['status' => $type])
        ->orderBy('users.id','DESC')
        ->select('users.id','users.name','users.email','users.created_at','users.status','users.updated_at','roles.name as role',DB::raw('GROUP_CONCAT(roles.name) as role'))
        ->groupBy('users.email')->get();
        return view('admin.user.index',compact('userDetails','btnStatus'));
    }

    public function create(Request $request)
    {
        $roleDetails = Role::orderBy('id', 'DESC')->get();
        return view('admin.user.create',compact('roleDetails'));
    }

    public function store(Request $request)
    {   
        $inputData = $request->all();
        $data['name'] = $inputData['name'];
        $data['email'] = $inputData['email'];
        $data['status'] = $inputData['status'];
        $data['password'] = Hash::make($inputData['password']);
        $user = User::create($data);
        if(!empty($user)){
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $user->assignRole($roles);
            return redirect()->route('user.index');
        }else{
            return redirect()->back()->withErrors('Server Error Data not Updated');
        }
    }

    public function edit($id)
    {
        $userDetails = User::where(['id' => $id])->first();
        $roleDetails = Role::orderBy('id', 'DESC')->get();
        $roleHasPermissions = User::leftjoin('model_has_roles','model_has_roles.model_id', '=', 'users.id')->where('model_has_roles.model_id', '=' , $id)->get();
        if(!empty($roleHasPermissions)){
            foreach($roleHasPermissions as $roleHasPermissionsVal){
                $data[] = $roleHasPermissionsVal['role_id'];
            }
        }
        return view('admin.user.create',compact('userDetails','roleDetails','data'));
    }

    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        //print_r($inputData);exit;

           // unset($inputData['password']);
            $user = User::findOrFail($id);
            $user->update($inputData);
            if(!empty($user)){
                $roles = $request->input('roles') ? $request->input('roles') : [];
                $user->syncRoles($roles);
                return redirect()->route('user.index');    
            }else{
                return redirect()->back()->withErrors('Server Error Data not Updated');
            }

            

    }

}

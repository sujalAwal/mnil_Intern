<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    //
    public function dahboard(){
        return view('rolePermission.main');
    }

    public function getPermission(int $id){
      
        $role = Role::find($id);
        $relation = $role->permissions;
        
        
       $permission = Permission::all();
       return view('rolePermission.Role.permissionCheck',compact('permission','role','relation'));
    }
    public function setPermission(Request $request, int $id){
       
     
          $role = Role::findOrFail($id);
          foreach($request->permission as $item){
           $data[] =  $item;
            
          }
          $role->syncPermissions($data);
          return redirect()->back();
        //   return response()->json(['success'=>true,'message'=>'Permission Assigned Succesfully'],200);
    
    }



    //For User Section Controlling the roles for different users.

    public function getUserWithRole(){
        $user = User::get();
        $role = Role::all();

        return view('rolePermission.User.index',compact('user','role'));
    }

    public function showUserWithRole(int $id){
        $user = User::findOrFail($id);
        $role = Role::all();

        return view('rolePermission.User.show',compact('user','role'));
    }
   
    public function setUserWithRole(Request $request ,int $id){
       $user = User::findOrFail($id);
      
        $user->syncRoles($request->role);

        return redirect()->route('role.getUserWithRole');
    }

}

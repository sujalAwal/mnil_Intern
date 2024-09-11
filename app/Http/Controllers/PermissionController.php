<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware('permission:Read',['only'=>['index','show']]);
        $this->middleware('permission:Update',['only'=>['edit','update']]);
        $this->middleware('permission:Create',['only'=>['create','store']]);
        $this->middleware('permission:Delete',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = Permission::all();
       return view('rolePermission.Permission.index',compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    
    {
        return view('rolePermission.Permission.create');
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'=>'required|min:3'
        ]);
        $result= Permission::create(['name'=>$request->name]);

        return response()->json(['success'=>true,'message'=>'Permission Created Succesfully','permission'=>$result],200);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $permission = Permission::findOrFail($id);
        return view('rolePermission.Permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $permission = Permission::findOrFail($id);
            $permission->update([
                'name'=> $request->name,
            ]);
            return response()->json(['success'=>true,'message'=>'Permission Deleted Succesfully'],200);

        }
        catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try{
            Permission::findOrFail($id)->delete();
            return response()->json(['success'=>true,'message'=>'Permission Deleted Succesfully'],200);

        }
        catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],200);
        }
    }
}

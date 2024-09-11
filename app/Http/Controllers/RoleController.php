<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $role = Role::all();
        return view('rolePermission.Role.index',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rolePermission.Role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name'
        ]);
      $role=  Role::create([
            'name'=>$request->name
        ]);
        return response()->json(['success'=>true,'message'=>'Permission Created Succesfully','Role'=>$role],200);
    
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

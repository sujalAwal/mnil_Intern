<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    //
    public function dahboard(){
        return view('rolePermission.main');
    }
}

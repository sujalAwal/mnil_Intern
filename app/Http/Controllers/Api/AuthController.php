<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $res){
       try{

           $validateData = $res->validate([
               'name' => ['required', 'string', 'max:55'],
               'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
               'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $res = User::create($validateData);
         return response()->json(['success'=>true,'message'=>"user Register Succesfully",'user'=>$res],200);   
        }
        catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);   
        }
    }
    public function login(Request $res){
       try{

           $validateData = $res->validate([
               'email' => ['required', 'string', 'email', 'max:25',],
               'password' => ['required', 'string', 'min:8' ],
            ]);
            $res = User::where(['email'=>$res->email,'password'=>$res->password])->first();
            $token = $res->createToken('auth_token')->accessToken;
         return response()->json(['success'=>true,'message'=>"user Logined Succesfully",'user'=>$res,'token'=>$token],200);   
        }
        catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);   
        }
    }
    public function destroyToken(){
        $token = auth()->user()->token()->delete();
        return response()->json(['status'=>true,'token'=>$token],200);

    }
}

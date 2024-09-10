<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $res){
       try{

        $res->validate([
               'name' => ['required', 'string', 'max:55'],
               'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
               'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            
           $ps = Hash::make($res->password);
           $result= User::create([
                'name' => $res->name,
                'email' => $res->email,
                'password' => $ps,
            ]);
         return response()->json(['success'=>true,'message'=>"user Register Succesfully",'user'=>$result],200);   
        }
        catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);   
        }
    }
    public function login(Request $req){
       try{

          $data = $req->validate([
               'email' => ['required', 'string', 'email', 'max:25',],
               'password' => ['required', 'string', 'min:8' ],
            ]);
            
           
            if(Auth::attempt($data)){

                $user = User::where(['email'=>$req->email])->first();
                $token = $user->createToken('auth_token')->accessToken;
                return response()->json(['success'=>true,'message'=>"user Logined Succesfully",'user'=>$user,'token'=>$token],200);   
            }else{
                throw new Exception("Crediantials Doesnot Match",401);
            }
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

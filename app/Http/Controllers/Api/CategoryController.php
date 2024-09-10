<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    public function index(){
       try{

           $data = Category::select('id','name','status')->get();
           return response()->json([
               'success'=>true,
               'message'=>'Successfully Categories Fetched',
               'data'=>$data],200);
            }
            catch(Exception $e){
                return response()->json(['success'=>false,'message'=>$e->getMessage()],500);   
            }
    }

   

    public function store(Request $request){ 
       
          try{

              $request->validate([
                  'name'=> 'required|min:3',
                 'status'=>'required|between:0,1'
            ]);

            Category::create([
                'name'=>$request->name,
                'status'=>$request->status,
                
            ]);
            
            return response()->json(['success'=>true,'message'=>"Category successfully Added"],200);
        }
        catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);   
        }
        
       
        }

        
    
   

    public function show(int $id){
        try{

            $category = Category::findOrFail($id);
            return response()->json(['success'=>true,'message'=>"Category fetched successfully",'category'=>$category],200);
        }
        catch(Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);  
        }
    }

    public function update(Request $req , int $id){
        try{
            $req->validate([
            'name' => 'required|min:3|unique:categories,name,' . ($id ?? ''),
            'status'=>'required|between:0,1'
        ]);

        $category = Category::findOrFail($id);

         $category->update([
            'name'=>$req->name,
            'status'=>$req->status,

        ]);

        return response()->json(['success'=>true,'message'=>"Category updated successfully"],200);
    }
    catch(Exception $e){
        return response()->json(['success'=>false,'message'=>$e->getMessage()],500); 

    }
    }

    public function destroy(int $id){

        try{

            $item =Category::findOrFail($id);     
            $item->delete();
            return response()->json(['success'=>true,'message'=>"Category Has Deleted"],200);
        }catch(Exception $exception){
            return response()->json(['success'=>true,'message'=>$exception->getMessage()],500);
        }
    }

   
}

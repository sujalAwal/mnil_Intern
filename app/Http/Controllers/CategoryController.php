<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::select('id','name','status')->get();
        return response()->json($data,200);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){ 
       
          
        if(empty($request->postId)){
            $request->validate([
                'name'=> 'required|min:3',
                'status'=>'required|between:0,1'
            ]);

            Category::create([
                'name'=>$request->name,
                'status'=>$request->status,
    
            ]);
    
            return response()->json(['success'=>"Category successfully Added"],200);
        }else{
            $request->validate([
                'name' => 'required|min:3|unique:categories,name,' . ($request->postId ?? ''),
                'status'=>'required|between:0,1'
            ]);
    
            $category = Category::findOrFail($request->postId);
    
             $category->update([
                'name'=>$request->name,
                'status'=>$request->status,
    
            ]);
    
            return response()->json(['success'=>"Category successfully updated"],200);
        }
       
        }

        
    
   

    public function edit(int $id){
        $category = Category::findOrFail($id);
        // return view('category.edit',compact('category'));
        return response()->json($category,200);
    }

    public function update(Request $req , int $id){
        try{
            $req->validate([
            'name' => 'required|min:3|unique:categories,name,' . ($req->id ?? ''),
            'status'=>'required|between:0,1'
        ]);

        $category = Category::findOrFail($id);

         $category->update([
            'name'=>$req->name,
            'status'=>$req->status,

        ]);

        return redirect()->route('category.index')->with('success',"Category Details Updated");
    }
    catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
        // return redirect()->back()->with('error',['msg'=>$e->getMessage()]);
    }
    }

    public function destroy(int $id){

        try{
            $item =Category::findOrFail($id);     
            $item->delete();
            return response()->json(['success'=>"Category Has Deleted"],200);
        }catch(Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],500);
        }
    }

    public function changeStatus(int $id){
        $item = Category::findOrFail($id);
       
        $item->status = $item->status == "1" ? "0" : "1";
        $item->save();
        return response()->json(['message'=>"successfully updated"],200);
    }
}

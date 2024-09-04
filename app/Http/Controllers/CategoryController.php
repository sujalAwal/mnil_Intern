<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::select('id','name','status')->get();
        return view('category.index' ,compact('data'));
    }

    public function create(){
        return view('category.create');
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

        return redirect()->route('category.index')->with('success',"Category successfully Added");
    }
    catch(Exception $e){
        return redirect()->back()->with('error',$e->getMessage());
        
    }
    }

    public function edit(int $id){
        $category = Category::findOrFail($id);
        return view('category.edit',compact('category'));
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

    public function destroy(Request $request, int $id){

        try{

            $item =Category::findOrFail($id);     
            $item->delete();
            return redirect()->back()->with('success' ,"Category Has Deleted");
        }catch(Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function changeStatus(int $id){
        $item = Category::findOrFail($id);
        $sts = $item->status;
        if($sts == 1){
            $item->status = "0";
        }else{
            $item->status = "1";

        }
        $item->save();
        return redirect()->back();
    }
}

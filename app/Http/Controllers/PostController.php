<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('permission:Read',['only'=>['index','show']]);
        $this->middleware('permission:Update',['only'=>['edit','update','changeStatus']]);
        $this->middleware('permission:Create',['only'=>['create','store']]);
        $this->middleware('permission:Delete',['only'=>['destroy','destroyImages']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::where('user_id',auth()->id())->with(['category','images'])->get();
        return view('post.index',compact('post'));
    }
    public function loadPost()
    {
        $post = Post::where('user_id',auth()->id())->with(['category','images'])->get();
        return response()->json(['post'=>$post],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::where('status','1')->get();
        return response()->json($category,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(empty($request->postId)){

        
      
        try{
            $request->validate([
                'title'=>'required|unique:posts,title',
                'description'=>'required|min:10',
                'category_id'=>'required|max:3',
                'status'=>'required|min:5',
                'image[]'=>'nullable|mimes:png,jpg,jpeg,|max:3000',
            ]);
          
            DB::beginTransaction();
try{

   $storePost = Post::create([
        'title'=>$request->title  ,
        'description'=>$request->description ,
        'category_id'=>$request->category_id ,
        'user_id'=>auth()->id(),
        'status'=>$request->status,
    ]);
      if($request->hasFile('image')){
        foreach($request->image as $img){

            $result = $img->store('images','public');
            PostImage::create([
                'post_id'=>$storePost->id,
                'image'=>$result,
            ]);
        }
            }
    DB::commit();
}
catch(Exception $e){
    DB::rollBack();
    return response()->json(['error'=>$e->getMessage()],500);
}

            return response()->json(['success'=>"Post Created Successfully..",'redirect_url' => route('post.index')],200);



        }catch(Exception $e){
        
            return response()->json(['error'=>$e->getMessage()],500);
        }
        //Create Post Ended
    }else{

        //UPdate Post Started
        try{
            $request->validate([
                'title'=>'required|unique:posts,title,'.$request->postId,
                'description'=>'required|min:10',
                'category_id'=>'required|max:3',
                'status'=>'required|min:5',
                'image.*' => 'nullable|mimes:png,jpg,jpeg|max:3000',

            ]);
          
            DB::beginTransaction();
try{

    Post::findOrFail($request->postId)->update([
        'title'=>$request->title  ,
        'description'=>$request->description ,
        'category_id'=>$request->category_id ,
        'status'=>$request->status,
    ]);
      if($request->hasFile('image')){
          foreach($request->image as $img){
              
              $result = $img->store('images','public');
              if($result){
                PostImage::create([
                    'post_id'=>$request->postId,
                    'image'=>$result,
                ]);
            }
        }
            }
            
            
            DB::commit();
        }
catch(Exception $e){
    DB::rollBack();
    return response()->json(['error'=>$e->getMessage()],500);
}
    }catch(Exception $e){
        return response()->json(['error'=>$e->getMessage()],500);
        }

       
      
        return response()->json(['success'=>"Post Updated Successfully..",'redirect_url' => route('post.index')],200);
    }

    
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
    
       $postData = Post::where('id',$post->id)->with(['category','images','user'])->first();
   
       
        return view('post.show',['data'=>$postData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $pid)
    {
        try{

            $postData = Post::with('images')->where('user_id',auth()->id())->findOrFail($pid);
            $category = Category::where('status','1')->get();
            
            // Pass the post data to the view
            return response()->json(['post'=>$postData,'category'=>$category],200);
        }catch(Exception $e){
            return response()->json(['error',$e->getMessage()],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        
        //Multiple Images Capturing
    //     if(empty($request->existing_images)){
    //         $res =PostImage::where('post_id',$post->id)->get();
    //         foreach($res as $img){
    //             $img_Path = public_path("storage/").$img->image;
    //             @unlink($img_Path);

    //         }
    //         PostImage::where('post_id',$post->id)->delete();


    //     }
    //     else{
    //         $dbImages = PostImage::where('post_id', $post->id)->get();
    //         $existingImages = $request->existing_images;
        
    //         foreach ($dbImages as $dbimg) {
    //             if (!in_array($dbimg->image, $existingImages)) {
    //                 $imgPath = public_path("storage/") . $dbimg->image;
    //                 if (file_exists($imgPath)) {
    //                     unlink($imgPath);
                        
    //                 }
    //                 // Optionally delete the record from the database
    //                 PostImage::where('id', $dbimg->id)->delete();
    //     }

    // }}

        try{
            $request->validate([
                'title'=>'required|unique:posts,title,'.$post->id,
                'description'=>'required|min:10',
                'category_id'=>'required|max:3',
                'status'=>'required|min:5',
                'image.*' => 'nullable|mimes:png,jpg,jpeg|max:3000',

            ]);
          
            DB::beginTransaction();
try{

    Post::findOrFail($post->id)->update([
        'title'=>$request->title  ,
        'description'=>$request->description ,
        'category_id'=>$request->category_id ,
        'status'=>$request->status,
    ]);
      if($request->hasFile('image')){
          foreach($request->image as $img){
              
              $result = $img->store('images','public');
              if($result){
                PostImage::create([
                    'post_id'=>$post->id,
                    'image'=>$result,
                ]);
            }
        }
            }
            
            
            DB::commit();
        }
catch(Exception $e){
    DB::rollBack();
    return redirect()->back()->with('error',$e->getMessage());
}
    }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

       
       
      
        return redirect()->route('post.index')->with('success',"Post Updated Successfully..");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
      try{

          $data =  Post::where('id',$post->id)->with('images')->first();
          
    //   $data->deleteOrFail();
      foreach ($data->images as $key => $value) {
        $imgPath =public_path('storage/'). $value->image;
    
        if (file_exists($imgPath)) {
            @unlink($imgPath);
        }
    }
    $data->delete();
    
    return response()->json(['success'=>"Post Deleted !"],200);
    // dd($post->id);
}catch(Exception $e){
    return response()->json(['error'=>$e->getMessage()],500);
} 
    }

    public function destroyImages(int $id){
      try{

          $img = PostImage::where('id',$id)->first();
          $imgPath =public_path('storage/'). $img->image;
          if (file_exists($imgPath)) {
              @unlink($imgPath);
            }
            return response()->json(['success'=>"Post Deleted !"],200);
        }
        catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);

        }

    }
    
    public function changeStatus(int $id){
       try{

           $item = Post::findOrFail($id);
           $sts = $item->status;
           $item->status = ($sts == "published") ? "draft" : "published";

        $item->save();
        return response()->json(['success'=>'Post('.$item->title.') Status Updated'],200);
    }
    catch(Exception $e){
        return response()->json(['error'=>$e->getMessage()],500);
    } 
    }

    
}

@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row justify-content-center m-5">
        <div class="col-md-8  ">
            <div class="card my-3" style="background-color: rgb(5, 227, 239);font-family: cursive; color:rgb(252, 252, 252);font-size:20px;" >
              <div class=" position-relative mb-3 card-header text-black text-center text-monospace " style="height: 80px; ">
               <h2>  {{ __('Post Section') }}</h2>
                <div class="d-block mt-5 position-absolute bottom-0 start-0  " style="background-color:#108A00; color:white; border-radius:12px">Post / Create</div>
                    @session('error')
                       {{session('error')}}
                       
                    @endsession

                   
                </div>
                <form action="{{route('post.store')}}" method="POST" class="text-center mx-auto" style="width: 50%" enctype="multipart/form-data" 
                style="background-color: #108A00">
                    @csrf
                    
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" name="title" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image[]" id="img" accept=".png,.jpg,.jpeg" multiple>
                      </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="2" ></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="sls" class="form-label">Category</label>
                      <select class="form-select" id="sls" name="category_id" aria-label="Default select example">
                          <option  value="" hidden></option>
                      @foreach ($category as $item )
                      <option  value="{{$item->id}}">{{$item->name}}</option>
                          
                      @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="sts" class="form-label">Status</label>
                        <select class="form-select" id="sts" name="status" aria-label="Default select example">
                            <option  value="" hidden></option> 
                      <option value="published">Publish</option>
                      <option value="draft">Draft</option>
                        </select>
                      </div>
                   
                   
                    <button type="submit" class="btn btn-primary">Create</button>
                  </form>

               
            </div>
        </div>
    </div>
</div>

@endsection
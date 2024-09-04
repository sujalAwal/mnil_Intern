@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row justify-content-center m-5">
        <div class="col-md-8  ">
            <div class="card my-3" style="background-color: rgb(230, 208, 13); color:rgb(0, 92, 252);font-size:20px;  ">
              <div class=" position-relative mb-3 card-header text-success text-center text-monospace " style="height: 80px; ">
                {{ __('Category Section') }}
                <div class="d-block mt-5 position-absolute bottom-0 start-0  " style="background-color:#108A00; color:white; border-radius:12px">Category / Create</div>
                    @session('error')
                       {{session('error')}}
                       
                    @endsession

                   
                </div>
                <form action="{{route('category.store')}}" method="POST" class="text-center mx-auto" style="width: 50%">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      
                    <div class="mb-3">
                      <label for="sls" class="form-label">Status</label>
                      <select class="form-select" id="sls" name="status" aria-label="Default select example">
                        <option  value="" hidden></option>
                        <option  value="1">Active</option>
                        <option value="0">In-Active</option>
                      </select>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Create</button>
                  </form>

               
            </div>
        </div>
    </div>
</div>

@endsection
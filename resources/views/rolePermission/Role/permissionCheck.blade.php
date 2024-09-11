@extends('rolePermission.main')

@section('table')

<div class="container">
   
    <div class="row justify-content-center m-5">
        <div class="col-md-8 ">
            <div class="card " style="background-color: rgb(255, 229, 34); color:rgb(0, 92, 252);font-size:20px;  ">
                <div class=" position-relative card-header text-success text-center text-monospace" style="height: 100px;font-family:Georgia, 'Times New Roman', Times, serif; font-size:2rem">
                    {{ __('Role Section : ') }} <span class="text-danger" > {{$role->name}}</span>
                   

                    <span class="bg-success bg-opacity-70 border border-info border-start-0 rounded-start position-absolute bottom-0 end-0"><a href="{{route('role.create')}}" class=" text-white" style="text-decoration: none ; font-size:1rem">ADD NEW</a> </span>
                </div>

                <div class="card-body text-center">
<form action="{{route('role.setPermission',$role->id)}}" method="POST" class="text-center mx-auto" style="width: 50%">
    @csrf
    @foreach ($permission as $item)
   
      
    
        
    <div class="mb-3">
        <label for="{{$item->id}}" class="form-label">{{$item->name}}</label>
        
    
        <input type="checkbox" name="permission[]" id="{{$item->id}}" value="{{$item->name}}" 
        @foreach ($relation as $rel) 
        {{($rel->pivot->permission_id == $item->id) &&  ($rel->pivot->role_id == $role->id) ? "checked":"" }}
        
        @endforeach
        >
    </div>
        @endforeach
 
   
    <button type="submit" class="btn btn-primary mt-2">Assign Permission</button>
  </form>
                </div>
@endsection
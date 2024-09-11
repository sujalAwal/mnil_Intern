@extends('rolePermission.main')

@section('table')
<form action="{{route('permission.update',$permission->id)}}" method="POST" class="text-center mx-auto" style="width: 50%">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Permission Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$permission->name}}">
      
 
   
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection
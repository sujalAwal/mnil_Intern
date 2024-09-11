@extends('rolePermission.main')

@section('table')
<form action="{{route('role.store')}}" method="POST" class="text-center mx-auto" style="width: 50%">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Role Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      
 
   
    <button type="submit" class="btn btn-primary mt-2">Create</button>
  </form>
@endsection
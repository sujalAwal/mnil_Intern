@extends('rolePermission.main')
@section('table')
@session('success')
    
<div class="position-absolute  translate-middle start-50 alert alert-success alert-dismissible fade show w-75" role="alert">
    <strong> {{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

<div class="container">
   
    <div class="row justify-content-center m-5">
        <div class="col-md-8 ">
            <div class="card " style="background-color: rgb(230, 208, 13); color:rgb(0, 92, 252);font-size:20px;  ">
                <div class=" position-relative card-header text-success text-center text-monospace" style="height: 100px;font-family:Georgia, 'Times New Roman', Times, serif; font-size:2rem">
                    {{ __('Role Section') }}
                   

                    <span class="bg-success bg-opacity-70 border border-info border-start-0 rounded-start position-absolute bottom-0 end-0"><a href="{{route('role.create')}}" class=" text-white" style="text-decoration: none ; font-size:1rem">ADD NEW</a> </span>
                </div>

                <div class="card-body text-center">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Manage</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach ($role as $index => $item)
                            
                        
                            <tr>
                            <th scope="row">{{++$index}}</th>
                            <td>{{$item->name}}</td>
                           
                            <td>
                                <a href="{{ route('role.checkPermission',$item->id) }}" class="btn btn-info --bs-info">
                                    <i class="fas fa-edit"></i> Permission
                                </a>
                            </td>
                            </td>
                            <td>  <div class="row">
                                <div class="col">
                                    <!-- Edit Button -->
                                    <a href="{{ route('role.edit', $item->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                    
                                    <!-- Delete Button (with confirmation dialog) -->
                                    <form action="{{ route('role.destroy',  $item->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger deleteCategory">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                        
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </td>
                          </tr>
                        
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
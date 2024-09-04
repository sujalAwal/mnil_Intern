@extends('layouts.app')


@section('content')
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
                    {{ __('Category Section') }}
                   

                    <span class="bg-success bg-opacity-70 border border-info border-start-0 rounded-start position-absolute bottom-0 end-0"><a href="{{route('category.create')}}" class=" text-white" style="text-decoration: none ; font-size:1rem">ADD NEW</a> </span>
                </div>

                <div class="card-body text-center">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach ($data as $index => $item)
                            
                        
                            <tr>
                            <th scope="row">{{++$index}}</th>
                            <td>{{$item->name}}</td>
                            <td>
                                <form action="{{ route('category.changeStatus', ['id' => $item->id]) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to change status of this item?');">
                                    @csrf
                                    @method('PATCH')
                               @if ($item->status == 1)
                               
                                <button type="submit"style="background-color: rgb(50, 239, 17); border-radius : 18px ;padding :3px; border: 2px solid rgb(50,239,17)" >
                                    <span >  Active</span>
                            
                                </button>
                                
                                @else
                                <button type="submit"  style="background-color: rgb(233, 28, 17); border-radius : 18px ; padding: 3px; border: 2px solid rgb(233,28,17)" >
                                    
                                    <span >  Inactive</span>
                                </button>
                                
                                @endif
                            </form>
                            </td>
                            <td>  <div class="row">
                                <div class="col">
                                    <!-- Edit Button -->
                                    <a href="{{ route('category.edit', ['id' => $item->id]) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                    
                                    <!-- Delete Button (with confirmation dialog) -->
                                    <form action="{{ route('category.destroy', ['id' => $item->id]) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
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
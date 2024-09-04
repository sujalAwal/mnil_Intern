@extends('layouts.app')


@section('content')
@session('success')
<div class="position-absolute  translate-middle start-50 alert alert-success alert-dismissible fade show w-75" role="alert">
    <strong> {{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession
<div class=""" >
   
    <div class="row justify-content m-5">
        <div class="col-md-8 " style="width:100vw">
            <div class="card " style="background-color: rgb(230, 208, 13); color:rgb(0, 92, 252);font-size:20px;  ">
                <div class=" position-relative card-header text-success text-center text-monospace" style="height: 100px;font-family:Georgia, 'Times New Roman', Times, serif; font-size:2rem ; ">
                    {{ __('Post Section') }}
                   

                    <span class="bg-success bg-opacity-70 border border-info border-start-0 rounded-start position-absolute bottom-0 end-0"><a href="{{route('post.create')}}" class=" text-white" style="text-decoration: none ; font-size:1rem">ADD NEW</a> </span>
                </div>

                <div class="card-body text-center">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach ($post as $index => $item)
                            
                        
                            <tr>
                            <th scope="row">{{++$index}}</th>
                            <td><a href="{{route('post.show',$item)}}" style="text-decoration-line: none">{{$item->title}}</a></td>
                            @if ($item->images->isNotEmpty())
                           
                            <td> <img src="{{asset('storage/'.$item->images->first()->image)}}" alt=" No"  class="img-thumbnail rounded mx-auto" style="height: 60px"> </td>
                            @else
                            <td><img src="https://example.com/path/to/default-image.png" alt="Image "></td>
                            
                            
                                @endif
                                
                                
                            <td> {!! Str::limit($item->description, 25, '...') !!}</td>
                            <td>{{$item->category->name}}</td>
                            <td>
                                <form action="{{ route('post.changeStatus',$item->id)}}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('PATCH')
                               @if ($item->status == "published")
                               
                                <button type="submit"style="background-color: rgb(50, 239, 17); border-radius : 18px ;padding :3px; border: 2px solid rgb(50,239,17)" class="statusForm" >
                                    <span >  Published </span>
                            
                                </button>
                                
                                @else
                                <button type="submit"  style="background-color: rgb(233, 28, 17); border-radius : 18px ; padding: 3px; border: 2px solid rgb(233,28,17)" class="statusForm">
                                    
                                    <span >  Draft</span>
                                </button>
                                
                                @endif
                            </form>
                            </td>
                            <td>  <div class="row">
                                <div class="col">
                                    <!-- Edit Button -->
                                    <a href="{{ route('post.edit',$item) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                    
                                    <!-- Delete Button (with confirmation dialog) -->
                                    <form action="{{ route('post.destroy',$item)}}" method="POST" class="d-inline-block" >
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
@section('script')
$(function(){
    $(".statusForm").click(function(e){
        e.preventDefault();
        const form = $(this).closest("form");
        Swal.fire({
            title: 'Are you sure?',
            text: "Changing staus of the Post!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!',
            cancelButtonText: 'Cancel'
        }).then((result)=>{
            if(result.isConfirmed){
                form.submit();
            }
        })
    });
    $(".deleteCategory").click(function(e){
        e.preventDefault();
        const deleteForm = $(this).closest("form");
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete the Post!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'Cancel'
        }).then((result)=>{
            if(result.isConfirmed){
                deleteForm.submit();
            }
        })

    })
    
})
@endsection
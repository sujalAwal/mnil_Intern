@extends('rolePermission.main')
@section('table')


<div class="container">
   
    <div class="row justify-content-center m-5">
        <div class="col-md-8 ">
            <div class="card " style="background-color: rgb(230, 208, 13); color:rgb(0, 92, 252);font-size:20px;  ">
                <div class=" position-relative card-header text-success text-center text-monospace" style="height: 100px;font-family:Georgia, 'Times New Roman', Times, serif; font-size:2rem">
                    {{ __('Permission Section') }}
                   

                    <span class="bg-success bg-opacity-70 border border-info border-start-0 rounded-start position-absolute bottom-0 end-0"><a href="{{route('permission.create')}}" class=" text-white" style="text-decoration: none ; font-size:1rem">ADD NEW</a> </span>
                </div>

                <div class="card-body text-center">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @foreach ($permission as $index => $item)
                            
                        
                            <tr>
                            <th scope="row">{{++$index}}</th>
                            <td>{{$item->name}}</td>
                           
                           
                            </td>
                            <td>  <div class="row">
                                <div class="col">
                                    <!-- Edit Button -->
                                    <a href="{{ route('permission.edit', $item->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                    
                                    <!-- Delete Button (with confirmation dialog) -->
                                    <form action="{{ route('permission.destroy',$item->id)}}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ">
                                            <i class="fas fa-trash"> Delete</i>
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
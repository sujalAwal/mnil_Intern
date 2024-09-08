@extends('layouts.app')


@section('content')
@session('success')
<div class="position-absolute  translate-middle start-50 alert alert-success alert-dismissible fade show w-75" role="alert">
    <strong> {{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endsession
<div class="">
   
    <div class="row justify-content m-5">
        <div class="col-md-8 " style="width:100vw">
            <div class="card " style="background-color: rgb(230, 208, 13); color:rgb(0, 92, 252);font-size:20px;  ">
                <div class=" position-relative card-header text-success text-center text-monospace" style="height: 100px;font-family:Georgia, 'Times New Roman', Times, serif; font-size:2rem ; ">
                    {{ __('Post Section') }}
                  

                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalPost" class="postAdd border border-info border-start-0 rounded-start position-absolute bottom-0 end-0" style="background-color: rgb(50, 239, 17);" >ADD NEW </button>
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
                        {{-- @foreach ($post as $index => $item)
                            
                        
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
                                
                               @if ($item->status == "published")
                               
                                <button type="submit"style="background-color: rgb(50, 239, 17); border-radius : 18px ;padding :3px; border: 2px solid rgb(50,239,17)" class="statusForm"  data-bs-postId="{{$item->id}}">
                                    <span >  Published </span>
                            
                                </button>
                                
                                @else
                                <button type="submit"  style="background-color: rgb(233, 28, 17); border-radius : 18px ; padding: 3px; border: 2px solid rgb(233,28,17)" class="statusForm"  data-bs-postId="{{$item->id}}">
                                    
                                    <span >  Draft</span>
                                </button>
                                
                                @endif
                        
                            </td>
                            <td>  <div class="row">
                                <div class="col">
                                    <!-- Edit Button -->
                                    <button  data-bs-toggle="modal" class="btn btn-primary editCategory" data-bs-target="#modalPost" type="button" data-bs-editId="{{$item->id}}">
                                        <i class="fas fa-edit">Edit</i> 
                                    </button>
                    
                                    <!-- Delete Button (with confirmation dialog) -->
                                    
                                        <button type="button" class="btn btn-danger deleteCategory" data-bs-id="{{$item->id}}">
                                            <i class="fas fa-trash">Delete</i> 
                                        </button>
                                     
                                </div>
                            </div>
                            @endforeach  --}}
                        </td>
                          </tr>
                        
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Section Start -->
<div class="modal fade" id="modalPost" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    
      <div class="modal-content" style="border-radius:18px" >
        <div class="modal-header" style="background-color:#08d7ea; color:rgb(162, 0, 0); border-radius:5px">
          <h1 class="modal-title fs-5"  id="modelLabel" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif ; color :#07af20; font-size:28px">{{ __('Post Section') }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                        <div class="card my-3" style="background-color: rgb(6, 206, 216);font-family: cursive; color:rgb(14, 1, 1);font-size:20px;" >
                          <div class=" position-relative mb-3 card-header text-black text-center text-monospace " style="height: 80px; ">
                         
                            <div class="d-block mt-5 position-absolute bottom-0 start-0  postDr" style="background-color:#07af20; color:white; border-radius:12px"></div>
                               
                            </div>
                            <form class="text-center mx-auto" id="formPost" style="width: 50%" method="POST" >  
                                @csrf
                                <input type="text" name="postId" id="postId" hidden>
                                <div class="mb-3">
                                  <label for="name" class="form-label">Name</label>
                                  <input type="text" name="title" class="form-control" id="postName" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="img" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image[]" id="postImg" accept=".png,.jpg,.jpeg" multiple>
                                    <div class="image-preview">
                                      </div>
                                  </div>
                                <div class="mb-3">
                                  <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="postDescription" cols="17" rows="3" ></textarea>
                                </div>
                                <div class="mb-3">
                                  <label for="sls" class="form-label">Category</label>
                                  <select class="form-select" id="postSls" name="category_id" aria-label="Default select example">
                                
                                  </select>
                                </div>
                                <div class="mb-3">
                                    <label for="sts" class="form-label">Status</label>
                                    <select class="form-select" id="postSts" name="status" aria-label="Default select example">
                                        <option  value="" hidden></option> 
                                  <option value="published">Publish</option>
                                  <option value="draft">Draft</option>
                                    </select>
                                  </div>
                               
                               
                                <button type="submit" class="btn btn-primary btnSubmitCategory"></button>
                              </form>
            
                           
                        </div>
                    </div>
                </div>
            </div>
      </div>
      </div>

@endsection
@section('script')
<script>
    function loadPost(){
        $(".table-group-divider").empty();
        $.ajax({
            url:`{{route('post.loadPost')}}`,
            type:'GET',
            headers:{
                 'X-CSRF-TOKEN':'{{csrf_token()}}'

            },
            success:(res)=>{
                res.post.forEach((item,index)=>{
                    const status =()=>{

                        if(item.status === "draft"){
                            return `<button type="button"style="background-color: rgb(250, 39, 17); border-radius : 18px ;padding :3px; border: 2px solid rgb(250,29,17)" class="statusForm" data-bs-postId="${item.id}">
                                      Draft
                                </button> `
                        }
                        else{
                          return ` <button type="button" style="background-color: rgb(50, 239, 17); border-radius : 18px ;padding :3px; border: 2px solid rgb(50,239,17)" class="statusForm" data-bs-postId="${item.id}">
                                    <span >  Published </span>
                            
                                </button>`
                        }
                    }
                    $(".table-group-divider").append(
                  `  <tr id="${item.id}" >
                            <th scope="row">${index +1} </th>
                        <td><a href="{{route('post.show','')}}/${item.id}" style="text-decoration-line: none">${item.title}</a></td>
                         
                           
                            <td> <img src="{{asset('storage/${item.images[0].image}')}}" alt=" No"  class="img-thumbnail rounded mx-auto" style="height: 60px"> </td>
                            
                                
                                
                            <td> ${item.description}</td>
                            <td>${item.category.name}</td>
                            <td>
                              
                            ${status()}
                                
                            </td>
                            <td>  <div class="row">
                                <div class="col">
                                    <!-- Edit Button -->
                                    <button  data-bs-toggle="modal" class="btn btn-primary editCategory" data-bs-target="#modalPost" type="button" data-bs-editId="${item.id}">
                                        <i class="fas fa-edit">Edit</i> 
                                    </button>
                    
                                    <!-- Delete Button (with confirmation dialog) -->
                                    
                                        <button type="button" class="btn btn-danger deleteCategory" data-bs-deleteId="${item.id}">
                                            <i class="fas fa-trash">Delete</i> 
                                        </button>
                                     
                                </div>
                            </div>
                          
                        </td>
                          </tr>`);
                })
                

            }
        });
    }
   
   $(document).ready(function(){
    loadPost();
  

    $(document).on("click",".statusForm",function(e){

    
        e.preventDefault();
        const id = $(this).closest('tr').attr('id');
        
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
                $.ajax({
                    url:`{{route('post.changeStatus','')}}/${id}`,
                    type:'PATCH',
                    headers:{
                         'X-CSRF-TOKEN':' {{csrf_token()}}'

                    },
                    success:(res)=>{
                        Swal.fire({
            title: 'Successfull',
            position:'top-end',
            text: `${res.success}`,
            icon: 'success',
            timer: 1000,
            timerProgressBar: true,
        }).then((e)=>{
            loadPost();
        })

           },
                    error:(err)=>{
                        Swal.fire({
            title: 'Error',
            position:'top-end',
            text: `${err.error}`,
            icon: 'error',
            timer: 1000,
            timerProgressBar: true,
        })
                    }
                })
            }
        })
    });

    /////////////////////////////
    $(document).on("click",".deleteCategory",function(e){
   
        e.preventDefault();
        const deleteId = $(this).attr('data-bs-deleteId');
     
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
               $.ajax({
                url:`{{route('post.destroy','')}}/${deleteId}`,
                type:'DELETE',
                headers:{
                     'X-CSRF-TOKEN':' {{csrf_token()}}'

                },
                success:(res)=>{
                    Swal.fire({
            title: 'Successfull',
            position:'top-end',
            text: `${res.success}`,
            icon: 'success',
            timer: 1000,
            timerProgressBar: true,
        }).then((e)=>{
            loadPost();
        })
                   
                    
                },
                error:(err)=>{
                    Swal.fire({
            title: 'Error',
            position:'top-end',
            text: `${err.error}`,
            icon: 'error',
            timer: 1000,
            timerProgressBar: true,
        })
                    

                }
               })
                
            }
        })

    })
    
    /////////////////////////////
    $(document).on("click",".editCategory",function(e){
   
        e.preventDefault();
        document.querySelector("#formPost").reset();
        $(".image-preview").empty();
        
        let edit_id = $(this).attr('data-bs-editId');
         $(".btnSubmitCategory").text("Update");
         $(".postDr").text("Post / Update");
        $.ajax({
            url:`{{route('post.edit','pid')}}`.replace("pid",edit_id),
            type:"GET",
            headers:{
                     'X-CSRF-TOKEN':'{{csrf_token()}}'
            },
            success:(res)=>{
                $("#postId").val(res.post.id);
                $("#postName").val(res.post.title);
                $("#postDescription").val(res.post.description);
                $("#postSls").val(res.post.description);
                $("#postSts").val(res.post.status);
                
                res.post.images.forEach(ele =>{
                      $(".image-preview").append(
                
`<div id="${ele.id}" class="imgDiv">
<img src="{{ asset('storage/${ele.image}')}}" alt="Image" width="100" height="70" style="border: 4px solid pink ; border-radius:11px">  
<button type="button" class="remove-image removeImg" style="border-block-color: red" >Remove</button>
   </div>     `

                    )
                })


                res.category.forEach(element => {
                    if(res.post.category_id == element.id){
                        $("#postSls").append(
                            `<option value="${element.id}" selected>${element.name}</option>`
                            
                        );

                    }else{

                        $("#postSls").append(
                            `<option value="${element.id}">${element.name}</option>`
                            
                        );
                    }
                });
                
            },
            error:(err)=>{
                console.log(err.error);
                
            }
        })
        
        
    


 /////////////////////////////
 $(document).on("click",".removeImg",function(e){
    e.preventDefault();
    imgId = $(this).parent().attr('id');
    $.ajax({
        url:`{{route('post.destroy.img','')}}/${imgId}`,
        type:'DELETE',
         headers:{
                  'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
               
        success:function(res){
            Swal.fire({
            title: 'Successfull',
            position:'top-end',
            text: `${res.success}`,
            icon: 'success',
            timer: 1000,
            timerProgressBar: true,
        })
        $(`#${imgId}`).empty();
        loadPost();    
        },
        error:(err)=>{
            Swal.fire({
            title: 'Error',
            position:'top-end',
            text: `${err.responseJSON?.error || 'An unexpected error occurred'}`,
            icon: 'error',
            timerProgressBar: true,
        })
            
        }
       })


    
    
 });
  
    
}) 
})
$(document).on("submit","#formPost",(e)=>{
        e.preventDefault();
        let formData = new FormData(document.querySelector("#formPost"));
       $.ajax({
        url:`{{route('post.store')}}`,
        type:'POST',
         headers:{
                  'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                data:formData,
        contentType:false,
        processData:false,
        success:function(res){
            $("#modalPost").modal('hide');
            Swal.fire({
            title: 'Successfull',
            position:'top-end',
            text: `${res.success}`,
            icon: 'success',
            timer: 1000,
            timerProgressBar: true,
        }).then(() => {
            loadPost();
                // Reset the form data after successful submission
                document.querySelector("#formPost").reset();
              
            });
            
        },
        error:(err)=>{
            Swal.fire({
            title: 'Error',
            position:'top-end',
            text: `${err.responseJSON?.error || 'An unexpected error occurred'}`,
            icon: 'error',
            timerProgressBar: true,
        })
            
        }
       })
        
    })
    $(document).on("click", ".postAdd",function(e){

console.log(12345);

    e.preventDefault();
    document.querySelector("#formPost").reset();
    $('.image-preview').empty();
    $(".btnSubmitCategory").text("Create");
    $(".postDr").text("Post / Create");

   $.ajax({
    url:`{{route('post.create')}}`,
    type:'GET',
    headers:{
         'X-CSRF-TOKEN':'{{csrf_token()}}'

    },
    success:(res)=>{
      let  option = '<option value="" hidden >  </option>';
       option +=  res.map((e,i)=>{
            return `  <option value="${e.id}">${e.name}</option>`
        }).join('');
        $("#postSls").html(option);
        

    },
    error:function(err){
        Swal.fire({
        title: 'Error X',
        position:'top-end',
        text: `${err.error}`,
        icon: 'error',
        timer: 1000,
        timerProgressBar: true,
    })
    }
   })
})

</script>
@endsection


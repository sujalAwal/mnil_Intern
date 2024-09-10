<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-info bg-opacity-10  shadow-sm">
            
          
                <div class="container-fluid">
                  <a class="navbar-brand bg-info rounded-top" href="{{route('home')}}">Crud App </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link  font-monospace btn btn-outline-warning " id="catNav">Category</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link font-monospace p-2 btn btn-outline-warning ml-3" href="{{route('post.index')}}">Post</a>
                      </li>
                     
                      <li class="nav-item">
                        <a class="nav-link  font-monospace" href="{{route('dashboard')}}">About Us</a>
                      </li>
                    </ul>
                    <form class="d-flex" role="search">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                  </div>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
              </nav>
            
        </nav>

        <main class="py-4 mainDiv">
            @yield('content')
        </main>
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#22ea08; color:white; border-radius:5px">
        <h1 class="modal-title fs-5"  id="modelLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  style="background-color: rgb(230, 208, 13); color:rgb(0, 92, 252);font-size:20px;  ">
        <form method="POST" class="modalForm">
          @csrf
          <input type="text" hidden id="unqId" name="postId" >
          <div class="mb-3">
            <label for="postName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="postName" aria-describedby="name">
            
          <div class="mb-3">
            <label for="postStauts" class="form-label">Status</label>
            <select class="form-select" id="postStauts" name="status" aria-label="Default select status">
              <option  value="" hidden></option>
              <option  value="1">Active</option>
              <option value="0">In-Active</option>
            </select>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sendBtn"></button>
        </div>
      </form>
    </div>
  </div>
</div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@yield('script')
<script>
  function load(){
          $.ajax({
        url:" {{route('category.index')}} ",
        dataType:'json',
        success:function(success){
      let tableRow = success.map((data,i)=>{
          let statusButton = data.status == 1 ? `<button type="submit" class="statusBtn" style="background-color: rgb(50, 239, 17); border-radius: 18px; padding: 3px; border: 2px solid rgb(50,239,17)" id="${data.id}">
             <span>Active</span>
           </button>`
        : `<button type="submit" class="statusBtn" style="background-color: rgb(233, 28, 17); border-radius: 18px; padding: 3px; border: 2px solid rgb(233,28,17)" id="${data.id}">
             <span>Inactive</span>
           </button>`;
            return `  <tr>
                            <th scope="row">${i+1}</th>
                            <td>${data.name}</td>
                            <td>
                                
                              ${statusButton}
                           
                            </td>
                            <td>  <div class="row">
                                <div class="col">
                                    <!-- Edit Button -->
                                    <button data-bs-toggle="modal" data-bs-target="#modal" id="edit" data-bs-id="${data.id}"  href=" route('category.edit') " class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                    
                                    <!-- Delete Button (with confirmation dialog) -->
                                    
                                        <button type="button" class="btn btn-danger deleteCategory" id="${data.id}" >
                                            <i class="fas fa-trash">Delete</i> 
                                        </button>
                                        
                                    
                                </div>
                            </div>
                        </td>
                          </tr>`}).join('')
                         $(".mainDiv").html(` <div class="container">
        <div class="row justify-content-center m-5">
            <div class="col-md-8">
                <div class="card" style="background-color: rgb(230, 208, 13); color: rgb(0, 92, 252); font-size: 20px;">
                    <div class="position-relative card-header text-success text-center text-monospace" style="height: 100px; font-family: Georgia, 'Times New Roman', Times, serif; font-size: 2rem">
                        {{ __('Category Section') }}
                        <button data-bs-toggle="modal" id="addNew" data-bs-target="#modal" data-bs-whatever="@getbootstrap"  class="bg-success bg-opacity-70 border border-info border-start-0 rounded-start position-absolute bottom-0 end-0">
                            <h5 class="text-white" style="text-decoration: none; font-size: 1rem">ADD NEW</h5>
                        </button>
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
                                ${tableRow}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>`);
          
  
        
        }
      }
    );
  }
  $(function(){
    $("#catNav").click(function(){
     load();

    })
   
   
    //status Changing
    $(document).on('click', '.statusBtn', function(e) {
            e.preventDefault(); // Prevent default button action
           let id= $(this).attr('id');
            $.ajax({
              url:`{{ route('category.changeStatus', ':id') }}`.replace(':id', id),
              type:'PATCH',
              data:{
                _token:'{{csrf_token()}}'
              },
              success:function(response){
                Swal.fire({
                  position: "top-end",
                 icon: "success",
                title: response.message,
               showConfirmButton: false,
                timer: 1000
               } ).then(() => {
                load();
            
        });
              },
              error: function(xhr, status, error) {
            // Optional: Handle errors
            console.error('AJAX Error:', status, error);
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'An error occurred',
                text: error,
                showConfirmButton: true
            });
        }
            })
            
        });
    
  })
 
  const modal = document.getElementById('modal');

if (modal) {
  modal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget;
    const btnId = button.getAttribute('id');
    if(btnId === "edit"){
      
      $(function () {
        const id = button.getAttribute('data-bs-id');
        $(".modal-title").text("Edit Category");
        $(".sendBtn").text("Update Category");
        $(".sendBtn").addClass("btn-success");

        $.ajax({
          url:`{{route('category.edit','cngid')}}`.replace("cngid",id),
          type:'GET',
          headers:{
            'X-CSRF-TOKEN':' {{csrf_token()}}'

          },
          success:function(res){
       
            $("#postName").val(res.name);
            $("#postStauts").val(res.status);          
            $("#unqId").val(res.id);
          },
          error: function(xhr, status, error) {
            // Optional: Handle errors
            console.error('AJAX Error:', status, error);
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'An error occurred',
                text: error,
                showConfirmButton: true
            });
        }
        })
      })

    }
    else if(btnId === "addNew"){
      $(function () {
        $("#postName").val('');
        $("#postStauts").val('');
        $("#unqId").val('');
        $(".sendBtn").removeClass("btn-success");
        $(".sendBtn").addClass("btn-primary");
        $(".modal-title").text("Add New Category");
        $(".sendBtn").text("Create Category");
      
      })
    }
    
  
  });
}

$(document).on("submit",".modalForm",function(e){

  e.preventDefault();
  const formData = $(this).serialize();
  console.log(formData);
  
  $.ajax({
    url:"{{ route('category.store') }}",
    method:'POST',
      data:formData,
      contentType: 'application/x-www-form-urlencoded',
      success:(res)=>{
        Swal.fire({     
                   icon:"success",   
                   title: 'Successfull ',  
                    html: res.success    });
                   $("#modal").modal('hide');
                   load();
      
      },
      error: function(xhr) {  
          let errors = xhr.responseJSON.errors;    
          let errorMessage = '';  
            $.each(errors, function(key, value) {        errorMessage += value + '<br>';    });  
              Swal.fire({     
                   icon: 'error',   
                   title: 'Validation Error',  
                         html: errorMessage    });
                        }
      
    
        })
      
      })
      $(document).on("click",".deleteCategory",(e)=>{
      e.preventDefault();
      let deleteid= e.currentTarget.id;
     $.ajax({
      url:`{{route('category.destroy','id')}}`.replace("id",deleteid),
      type:"DELETE",
      headers:{
            'X-CSRF-TOKEN':' {{csrf_token()}}'

          },
          success:(res)=>{
            Swal.fire({
                  position: "top-end",
                 icon: "success",
                title: res.success,
               showConfirmButton: false,
                timer: 1000
               } ).then(() => {
                load();
            
        });
          }

     })
      
   
    });
        
      </script>
</html>

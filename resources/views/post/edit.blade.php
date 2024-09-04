@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row justify-content-center m-5">
        <div class="col-md-8  ">
            <div class="card my-3" style="background-color: rgb(5, 227, 239);font-family: cursive; color:rgb(252, 252, 252);font-size:20px;" >
              <div class=" position-relative mb-3 card-header text-black text-center text-monospace " style="height: 80px; ">
               <h2>  {{ __('Post Section') }}</h2>
                <div class="d-block mt-5 position-absolute bottom-0 start-0  " style="background-color:#108A00; color:white; border-radius:12px">Post / Update</div>
                    @session('error')
                       {{session('error')}}
                       
                    @endsession

                   
                </div>
                <form action="{{route('post.update',$postData)}}" method="POST" class="text-center mx-auto" style="width: 50%" enctype="multipart/form-data" 
                style="background-color: #108A00">
                    @csrf
                    @method("PUT")
                    
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" name="title" class="form-control" id="name" aria-describedby="emailHelp" value="{{$postData->title}}">
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image[]" id="img" accept=".png,.jpg,.jpeg" multiple>
                      </div>


                     
                     
                      <div class="existing-images">
                          @foreach($postData->images as $key => $img)
                          <div class="modal fade" id="exampleModalToggle{{$key}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: rgb(146, 126, 126) ; ">
                                  <h5 class="modal-title"  id="exampleModalToggleLabel">Image </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body " style="background-color: rgb(230, 204, 204) ; border-radius:10px ">
                                  <img src="{{ asset('storage/' . $img->image) }}" alt="Image" width="450" style="border-radius: 12px" >
                                </div>
                                
                              </div>
                            </div>
                          </div>
                       
                            <div class="image-preview">
                              <a class="btn" data-bs-toggle="modal" href="#exampleModalToggle{{$key}}" role="button"><img src="{{ asset('storage/' . $img->image) }}" alt="Image" width="100" height="70" style="border: 4px solid pink ; border-radius:11px">   </a> 
                                <input type="hidden" name="existing_images[{{$key}}]" value="{{ $img->image }}" multiple>
                                <button type="button" class="remove-image removeImg" style="border-block-color: red">Remove</button>
                            </div>
                        
                        @endforeach
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="2" >{{$postData->description}}</textarea>
                    </div>
                    <div class="mb-3">
                      <label for="sls" class="form-label">Category</label>
                      <select class="form-select" id="sls" name="category_id" aria-label="Default select example">
                          <option  value="" hidden></option>
                      @foreach ($category as $item )
                      @if ($item->id == $postData->category_id)
                          
                      <option  value="{{$item->id}}" selected >{{$item->name}}</option>
                      @else
                      <option  value="{{$item->id}}">{{$item->name}}</option>
                          
                      @endif
                          
                      @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                        <label for="sts" class="form-label">Status</label>
                        <select class="form-select" id="sts" name="status" aria-label="Default select example">
                            <option  value="" hidden></option> 
                      <option value="published" {{$postData->status == 'published'?'selected':''}}>Publish</option>
                      <option value="draft" {{$postData->status == 'draft'?'selected':''}}>Draft</option>
                        </select>
                      </div>
                   
                   
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>

               
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function() {
    $('.removeImg').click(function(e) {
        e.preventDefault();
        console.log($(this).data('image'));
        $(this).closest('.image-preview').remove();
    });
});

</script>
@endsection
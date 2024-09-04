@extends('home')

@section('content')
<div class="row justify-content m-5">
<div id="carouselExample" class="carousel slide" >
  
  <div class="carousel-inner">
    @foreach ($data->images as $img)
    <div class="carousel-item active" >
      <img src="{{asset('storage/'.$img->image)}}" class=" " style="height:399px" alt="NOt ">
    </div>
    @endforeach
    
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
<div class="card text-center">
    <div class="card-header" style="background-color: rgb(7, 253, 7)">
      <ul class="nav nav-tabs card-header-tabs" >
        <li class="nav-item">
          <a class="nav-link active" aria-current="true" href="#">{{$data->user->name}} </a>
        </li>

      </ul>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{$data->title}}</h5>
      <p class="card-text">{{$data->description}}</p>
      <a href="#" class="btn btn-primary">{{$data->status}} </a>
    </div>
  </div>
</div>
  @endsection
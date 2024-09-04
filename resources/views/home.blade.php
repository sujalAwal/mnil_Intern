@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row justify-content-center m-5">
        <div class="col-md-8 ">
            <div class="card" style="background-color: rgb(213, 109, 213); color:#20f804;font-size:22px;font-family:Verdana, Geneva, Tahoma, sans-serif  ">
                <div class="card-header">{{ __('Dashboard----' )  }} {{Auth::user()->name}} </div>

                <div class="card-body text-center">
                    @yield('content')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <header class="hero-section text-center text-white">
                        <div class="container">
                            <h1 class="display-4 text-black">Welcome to PostWebApp</h1>
                            <p class="lead">Share your thoughts, ideas, and stories with the world.</p>
                            <a href="/post/create" class="btn btn-warning text-black btn-lg">Submit Your Post</a>
                        </div>
                    </header>

                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer mt-auto bg-black text-white fixed-bottom" style=" ">
    <div class="container text-center">
        <p>&copy; 2024 PostWebApp. All rights reserved.</p>
        <ul class="list-unstyled">
            <li><a href="#" class="text-white">Privacy Policy</a></li>
            <li><a href="#" class="text-white">Terms of Service</a></li>
            <li><a href="#" class="text-white">Help</a></li>
        </ul>
    </div>
</footer>

@endsection

@extends('layouts.app')

@section('content')

<div class=" m-5 w-50">
    {{-- <a  href="{{route('')}}" class="btn btn-outline-primary">Primary</a>
<a  href="{{route('')}}" class="btn btn-outline-secondary">Secondary</a>
<a  href="{{route('')}}" class="btn btn-outline-success">Success</a> --}}
    <a  href="" class="btn btn-outline-primary m-2">Role</a>
    <a  href="" class="btn btn-outline-secondary mx-2">Permissin</a>
    <a  href="" class="btn btn-outline-success mx-2">User</a>
</div>
@yield('table')
@endsection
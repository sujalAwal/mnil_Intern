@extends('layouts.app')

@section('content')

<div class=" m-5 w-50">
    {{-- <a  href="{{route('')}}" class="btn btn-outline-primary">Primary</a>
<a  class="btn btn-outline-secondary">Secondary</a>
<a  class="btn btn-outline-success">Success</a> --}}
    <a   href="{{route('role.index')}}" class="btn btn-outline-primary m-2">Role</a>
    <a  href="{{route('permission.index')}}" class="btn btn-outline-secondary mx-2">Permission</a>
    @role('superAdmin')
    <a  href="{{route('role.getUserWithRole')}}" class="btn btn-outline-success mx-2">User</a>
    @endrole
</div>
@yield('table')
@endsection
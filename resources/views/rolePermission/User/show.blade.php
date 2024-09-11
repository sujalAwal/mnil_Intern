@extends('rolePermission.main')

@section('table')
    <div class="">

        <div class="row justify-content-center m-5">
            <div class="col-md-8 ">
                <div class="card " style="background-color: rgb(255, 229, 34); color:rgb(0, 92, 252);font-size:20px;  ">
                    <div class=" position-relative card-header text-success text-center text-monospace"
                        style="height: 100px;font-family:Georgia, 'Times New Roman', Times, serif; font-size:2rem">
                        {{ __('Role Section : ') }} <span class="text-danger"> {{ $user->name }}</span>



                    </div>

                    <div class="text-center">
                        <form action="{{route('role.setUserWithRole',$user->id)}}" method="POST"
                            class="text-center mx-auto" style="width: 50%">
                            @csrf
                            <div class="mb-3">
                                <label for="Roles" class="form-label">Select Roles :</label>
                                <div >
                                    <select name="role[]" id="Roles" multiple>
                                        @foreach ($role as $item)
                                      
                                           
                                       <option value="{{ $item->name }}"
                                        @foreach ($user->getRoleNames() as $assignRole)
                                        {{$assignRole == $item->name ? "selected":""}} 
                                        @endforeach
                                        >{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            

                            <button type="submit" class="btn btn-primary mt-2">Assign Role</button>
                        </form>
                    </div>
                    
                @endsection

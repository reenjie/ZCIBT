@extends('layouts.app', ['activePage' => 'users', 'title' => 'Add User', 'navName' => 'Trips', 'activeButton' => 'laravel'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'users')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                            <h4 class="card-title mt-3">Add Users</h4>
                           <br>
                           @if(session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{session()->get('error')}}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                            </div>
                           @endif
                        </div>
                        <div class="card-body ">
                        <div class="container">
                    <form action="{{ route('createnewuser') }}" method="post">
                        @csrf

                        <div class="container mt-5" style="">

                                                     <div class=" row">
                                                     <div class="col-md-12">
                                                        <div class="form-group">
                                                <h6 class="text-secondary">User Role</h6>
                                               <select name="user_type" class="form-control" id="" required autofocus>
                                                <option value="">Select User Role</option>
                                                <option value="0">Administrator</option>
                                                <option value="1">Operator</option>
                                               </select>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                <h6 class="text-secondary">First Name</h6>
                                                <input type="text" name="firstname"  class="form-control"  value="{{ old('firstname') }}" required autofocus>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                <h6 class="text-secondary">Middle Name</h6>
                                                <input type="text" name="middlename"  class="form-control"  value="{{ old('middlename') }}" required autofocus>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                <h6 class="text-secondary">Last Name</h6>
                                                <input type="text" name="lastname"  class="form-control"  value="{{ old('lastname') }}" required autofocus>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                <h6 class="text-secondary">Birthdate</h6>
                                                <input type="date" name="birthdate"  class="form-control"  value="{{ old('birthdate') }}" required autofocus>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                <h6 class="text-secondary">Contact #</h6>
                                                <input type="text" name="contactno"  class="form-control"  value="{{ old('contactno') }}" required autofocus>
                                                        </div>
                                                        </div>
                                                    
                                                        
                                                        <div class="col-md-12">
                                                        <div class="form-group">
                                                <h6 class="text-secondary">Address</h6>
                                              <textarea name="address" id="" class="form-control mb-2" style="height:80px">{{ old('address') }}</textarea>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <div class="form-group">   {{-- is-invalid make border red --}}
                                            <h6 class="text-secondary">Email</h6>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                            </div>
                                            @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" >
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                                        {{ $error }}
                                    </div>
                                @endforeach

                                            <div class="form-group">
                                            <h6 class="text-secondary">Password</h6>
                                                <input type="password" name="password" class="form-control" required >
                                            </div>
                                          
                                            <div class="form-group">
                                            <h6 class="text-secondary">Confirm Password</h6>
                                                <input type="password" name="password_confirmation"  class="form-control" required autofocus>
                                            </div>
                                          
                                                        </div>
                                                    </div>
                                      

                                            <div class="footer text-center">
                                                <button type="submit" class="btn btn-fill border-secondary btn-neutral btn-wd">{{ __('Create') }}</button>
                                            </div>
                                        </div>
                    </form>


                        </div>

        
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


@endsection
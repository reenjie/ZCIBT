@extends('layouts.app', ['activePage' => 'register', 'title' => 'ZCIBT'])

@section('content')
    <div class="full-page register-page section-image" data-color="red" data-image="{{ asset('light-bootstrap/img/bgreg.jpg') }}">
        <div class="content">
            <div class="container">
                <div class="card card-register card-plain ">
                    <div class="card-body ">
                        <div class="row">
                            
                            <div class="col-md-7 mr-auto">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="card " >
                                            <div class="card-body">
                                                
                                            <div class="container mt-5" style="">
                                                     <div class=" row">
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
                                              <textarea name="address" id="" class="form-control mb-2" style="height:80px"></textarea>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <div class="form-group">   {{-- is-invalid make border red --}}
                                            <h6 class="text-secondary">Email</h6>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                            <h6 class="text-secondary">Password</h6>
                                                <input type="password" name="password" class="form-control" required >
                                            </div>
                                            <div class="form-group">
                                            <h6 class="text-secondary">Confirm Password</h6>
                                                <input type="password" name="password_confirmation"  class="form-control" required autofocus>
                                            </div>
                                            <div class="form-group d-flex justify-content-center">
                                                <div class="form-check rounded col-md-10 text-left bg-secondary">
                                                    <label class="form-check-label text-light   w-100 d-flex align-items-center">
                                                        <input class="form-check-input " checked name="agree" type="checkbox" required >
                                                        <span class="form-check-sign"></span>
                                                        <b>{{ __('Agree with terms and conditions') }}</b>
                                                    </label>
                                                </div>
                                            </div>
                                                        </div>
                                                    </div>
                                      

                                            <div class="footer text-center">
                                                <button type="submit" class="btn btn-fill border-secondary btn-neutral btn-wd">{{ __('Create Free Account') }}</button>
                                            </div>
                                        </div>
                                            </div>
                                         
                                     
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5 ml-auto text-center">
                                  

                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100 " style="border-radius:10px" src="https://aboutcagayandeoro.com/wp-content/uploads/2019/01/13.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100 " style="border-radius:10px" src="https://aboutcagayandeoro.com/wp-content/uploads/2019/01/3-3.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100 " style="border-radius:10px" src="https://aboutcagayandeoro.com/wp-content/uploads/2019/01/2-4.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                                      
                                        <h2 style="text-align:center" class="text-white">
                                            Safe Travel Tours
                                            <br>
                                          
                                        </h2>
                                        <h6  class="text-white">  <span style="font-size:12px">Zamboanga City Integrated Bus Terminal 
                                            <br>
                                            Ticket Reservation System
                                        </span></h6>
                            </div>
                            <div class="col">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning alert-dismissible fade show" >
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times;</a>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush
@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'ZCIBT', 'activeButton' => 'laravel','navName' => 'Tickets'])

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="full-page section-image" data-color="red" data-image="{{asset('light-bootstrap/img/bghome.jpg')}}">
        <div class="content">
       
            <div class="container">
                <div class="row ">
                 <div class="col-md-1"></div>
                 <div class="col-md-10">
                 @if($auth==0)
                 <button class="btn btn-warning btn-sm" onclick="window.location.href='/' ">Home</button>
                 @endif
                    <div class="card">
                        <div class="card-body">
                            <h5 style="font-weight:bold">Please provide your personal information:</h5>
                            @if(!auth()->check())
                            <a href="{{route('login')}}" style="font-size:14px;font-weight:bold">I already have an Account</a>
                            @endif
                            <form action="{{route('reserveticket')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

<!--  -->

@if($auth==0)
    <div class="col-md-6">
    <div class=" row">
                            <div class="col-md-12">
                            <div class="form-group">
                    <h6 class="text-secondary">First Name</h6>
                    <input type="text" name="firstname"  class="form-control"  value="{{ old('firstname') }}" required autofocus>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                    <h6 class="text-secondary">Middle Name</h6>
                    <input type="text" name="middlename"  class="form-control"  value="{{ old('middlename') }}" required autofocus>
                            </div>
                            </div>

                            <div class="col-md-12">
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
          
    </div>
    @endif

   
        @isset($selected)
        <div class="col-md-6">
            <div class="container">
             <div class="card border-danger">
                <div class="card-body">
                    @foreach ($busdetails as $bu)
                    {{$bu->bustype}}
                    <br>
                    Bus #: {{$bu->Bus_No}}
 
                    @endforeach
                    <br>
                  @foreach ($scheddetails as $sched)
                  <span style="font-size:13px">
                    <span style="font-weight:bold"> {{date('F j, Y',strtotime($sched->schedule))}}</span> 
                    <br>
                    Departure:
                    <br>
                    <span style="font-weight:bold"> {{date('h:ia',strtotime($sched->departure))}} </span>
                    <br>
                    Estimated Arrival
                    <br>
                    <span style="font-weight:bold"> {{date('h:ia',strtotime($sched->est_arrival))}} </span>
        
                    <br>
                    Estimated Travel time
                    <br>
                    <span style="font-weight:bold"> 
                      {{$sched->est_traveltime}}
                    </span>
                 </span>
                      
                  @endforeach
                    
                </div>
             </div>
                <ul class="list-group">
                 
                    @foreach ($selected as $sit)
                  
                    @php
                        $outsit = DB::select('select * from column_seats where id = '.$sit.' ');
    
                       
                    @endphp
    
                    @foreach ($outsit as $s)
                     
                    <li class="list-group-item">
                       <span style="font-size:12px"> Seat Number :</span> {{$s->seatnumber}}
    
                    </li>
                        
                    @endforeach
    
                @endforeach
                </ul>
    
              
            </div>
    
        </div>
        @endisset
    
 

    <div class="@if($auth == 1) col-md-12 @else col-md-6 @endif container">
    <h2 style="">
    <span style="font-size:14px">Request Discount</span>
    <select name="discount"  class="form-control" id="selectdiscount">
        <option value="">Select Discount</option>
        @php
        $discounts = DB::select('SELECT * FROM `fare_discounts`');
        @endphp
        @foreach($discounts as $amt )
            <option value="{{$amt->id}}">{{$amt->title}} | {{$amt->discount}} %</option>
        @endforeach
    </select>

    <span style="font-size:14px">Provide a Valid ID for Approval
    <br>
    <span style="font-size:12px">Preferably Government Issued ID .</span>
    <span style="font-size:12px">
    <ul class="">
  <li class="">SSS ID</li>
  <li class="">Senior Citizen ID</li>
  <li class="">Drivers License</li>
  <li class="">Passport</li>
  <li class="">BirthCertificate</li>
  <li class="">Student ID</li>
 
</ul>

    </span>
</span>
    <input type="file" name="idfile" accept="image/*" id="idfile" class="form-control">
    <br>
    <div class="alert alert-warning d-none text-dark" id="alerto">
        You will be charged a full amount as of now. When your discount request approved. present the discounted ticket to the operators.
    </div>

    <br>
<span style="font-size:14px;font-weight:normal">Total Amount Payable :
    
    </span>    <br>

    @isset($selected)
   
   
    @foreach ($fare as $f)
    <span style="font-size:15px;font-weight:normal">    Fare :  &#8369;  {{$f->fare}} x {{count($selected)}}</span>
    <br>
    &#8369; 
    {{$f->fare * count($selected)}}
@endforeach
    
    @else
    &#8369; 
    @foreach ($fare as $f)
        {{$f->fare}}
    @endforeach
    @endisset

</h2>

<div class="card">
    <div class="card-body">
        <h5>Select Payment Method</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <label for="atm" style="font-weight: bold">
                            <input type="radio" id="atm" style="width: 20px; heigth:20px" class="pd" name="paymentmethod" value="atm"> Credit Card
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <label for="gcash" style="font-weight: bold">
                            <input type="radio" class="pd" id="gcash" name="paymentmethod" value="gcash"> Gcash
                        </label>
                    </div>
                </div>
            </div>
          <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <label for="overthecounter" style="font-weight: bold">
                            <input type="radio" class="pd" id="overthecounter" name="paymentmethod" value="overthecounter"> Over the Counter
                        </label>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

    <div class="card  shadow d-none" id="pmethod">
        <div class="card-body">
            <div id="atm_" class="d-none">
                @include('payment.atm')
            </div>
            <div id="gcash_"  class="d-none">
                @include('payment.gcash')
            </div>
            <div id="overthecounter_"  class="d-none">
                @include('payment.overthecounter')
            </div>
        </div>
    </div>

   


    </div>
</div>
                            </form>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-1"></div>
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
            
            $('.pd').click(function(){
                var selected = $(this).val();
                
                $('#pmethod').removeClass('d-none');
                if(selected == 'atm'){
                    $('#atm_').removeClass('d-none');
                    $('#gcash_').addClass('d-none');
                    $('#overthecounter_').addClass('d-none');
                    $('.atmattr').addAttr('required');
                    $('.gcashattr').removeAttr('required');
                    $('#otc').val('');
                }else if (selected == 'gcash'){
                    $('#gcash_').removeClass('d-none');
                    $('#atm_').addClass('d-none');
                    $('#overthecounter_').addClass('d-none');
                    $('.atmattr').removeAttr('required');
                    $('.gcashattr').attr('required',true);
                    $('#otc').val('');
                }else if (selected == 'overthecounter'){
                    $('#overthecounter_').removeClass('d-none');
                    $('#atm_').addClass('d-none');
                    $('#gcash_').addClass('d-none');
                    $('.atmattr').removeAttr('required');
                    $('.gcashattr').removeAttr('required');
                    $('#otc').val('1');
                }
              
            })

            $('#selectdiscount').change(function(){
                var discount = $(this).val();
                if(discount == ''){
                    $('#idfile').removeAttr('required');   
                    $('#alerto').addClass('d-none');
                    $('#idfile').val('');
                }else {
                    $('#idfile').attr('required',true);
                    $('#alerto').removeClass('d-none');
                }
                

            })

            $('#paynow').on('submit',function(){
                swal({
                title: "Success!",
                text: "No account information has been saved or money involved. this is for development purpose only.",
                icon: "success",
                buttons: true,
                dangerMode: false,
                })
                .then((willDelete) => {
                if (willDelete) {
                    // swal("Your ticket has been reserved successfully!", {
                    // icon: "success",
                    // }).then(()=>{
                    // window.location.href='{{route('reserve')}}';
                    // });
                }
                });
            })
            
        });
    </script>
@endpush
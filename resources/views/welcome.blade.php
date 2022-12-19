@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'ZCIBT'])

@section('content')
    <div class="full-page section-image" data-color="red" data-image="{{asset('light-bootstrap/img/bghome.jpg')}}">
        <div class="content">
       
            <div class="container">
                <div class="row ">
                    <div class="col-md-6">
                      <h3 class="text-light">Zamboanga City Integrated Bus Terminal</h3>
                      <h6 class="text-light" style="font-weight:normal">Ticket Reservation System</h6>
                      <br>
                      <h4 class="text-light">
                        <button class="btn btn-warning" onclick="window.location.href='{{route('reserve')}}'">Reserve now</button>
                        <button class="btn btn-info">About Us</button>

                      </h4>

                      <br>

                      <img src="{{asset('light-bootstrap/img/maps.svg')}}" class="w-100 mt-4" alt="">
                      <h4 class="text-light">Contact us</h4>
                      <ul class="list-group list-group-flush  text-light" style="font-size:13px">
                                        <li class="list-group-item bg-transparent">PLDT Landline | 062-975-2220</li>
                                        <li class="list-group-item bg-transparent">Globe Telecom | 0927-492-5002</li>
                                        <li class="list-group-item bg-transparent">Smart         | 0969-135-6410</li>
                                       
                                        </ul>

                    </div>
                    <div class="col-md-6 mt-4">
                    <h3 class="text-light">Travels</h3>
                      <div class="card card-hidden bg-transparent mb-2">
                        <div class="card-body">
                         
                        <h4 class="text-light">Routes</h4>
                        <table class="table table-striped text-light">
                    <thead class="">
                        <tr class="table-danger" >
                        <th scope="col" class="text-dark">From</th>
                        <th scope="col" class="text-dark">To</th>
                        <th scope="col" class="text-dark">Fare</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $data = DB::select('SELECT * FROM `routes`');
                      @endphp
                  
                        
                        @if(count($data)>=1)
                        @foreach($data as $item)
                        <tr>
                            <td style="font-weight:bold">{{$item->from}}</td>
                            <td style="font-weight:bold">{{$item->to}}</td>
                            <td>&#8369; {{$item->fare}}</td>
                        
                    
                        {{--   --}}
                       
                      </tr>
                        @endforeach
                        @endif
                      
                    </tbody>
                    </table>
                        </div>
                      </div>

                      <div class="card card-hidden bg-transparent  mb-2">
                        <div class="card-body">
                        <h4 class="text-light">Schedules</h4>
                        <table class="table table-striped text-light">
                    <thead class="">
                        <tr class="table-danger" >
                        <th scope="col" class="text-dark">Departure</th>
                        <th scope="col" class="text-dark">Estimate Arrival</th>
                        <th scope="col" class="text-dark">Schedule</th>
                        <th scope="col" class="text-dark">Status</th>
                        <th scope="col" class="text-dark">Created</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $data = DB::select('SELECT * FROM `travel_schedules` where status = 1');
                      @endphp
                  
                        
                        @if(count($data)>=1)
                        @foreach($data as $item)
                        <tr>
                        <td style="font-weight:bold">{{date('h:ia',strtotime($item->departure))}} </td>
                         <td style="font-weight:bold">{{date('h:ia',strtotime($item->est_arrival))}}</td>
                        <td >{{date('m/d/Y | F j,Y',strtotime($item->schedule))}}</td>
                      
                        <td >
                            @if($item->status == 0)
                            <span class="badge bg-danger">Inactive</span>
                            @else 
                            <span class="badge bg-success">Active</span>
                            @endif
                       
                        </td>
                        <td>{{date('F j,Y',strtotime($item->created_at))}}</td>
                    
                       
                       
                      </tr>
                        @endforeach
                        @endif
                      
                    </tbody>
                    </table>
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
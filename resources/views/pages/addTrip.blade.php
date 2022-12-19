@extends('layouts.app', ['activePage' => 'trips', 'title' => 'Add Trips', 'navName' => 'Trips', 'activeButton' => 'laravel'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'trips')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                            <h4 class="card-title mt-3">Add Trips</h4>
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
            <form action="{{route('Addtrips')}}" method="post">
                                @csrf
                            
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Select Bus</h6>
                           @php
                                $bus = DB::select('SELECT * FROM `buses`');

                                @endphp 
                             
                                <select name="bus" class="form-control" required>
                                    <option value="">Select Bus</option>
                                    @foreach($bus as $value)
                                    <option value="{{$value->id}}">{{$value->Bus_No}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4">
                                <h6>Select Routes</h6>
                                @php
                                $routes = DB::select('SELECT * FROM `routes`');

                                @endphp 


                                <select name="route" class="form-control" required>
                                <option value="">Select Route</option>
                                    @foreach($routes as $value)
                                    <option value="{{$value->id}}">{{$value->from.' to '.$value->to}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4">
                                <h6>Select Schedule</h6>
                                @php
                                $ts = DB::select('SELECT * FROM `travel_schedules`');

                                @endphp 

                                <select name="schedule" class="form-control" required>
                                <option value="">Select Travel Schedule</option>
                                    @foreach($ts as $value)
                                    <option value="{{$value->id}}">{{date('F j, Y',strtotime($value->schedule))}} | Departure : {{date('h:ia',strtotime($value->departure))}} | Arrival : {{date('h:ia',strtotime($value->est_arrival))}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-12 mt-5">
            <button class="btn btn-primary " type="submit" style="float:right">Save</button>
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
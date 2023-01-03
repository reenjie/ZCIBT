@extends('layouts/app', ['activePage' => 'reserve', 'title' => 'ZCIBT'])

@section('content')
    <div class="full-page section-image" data-color="red" data-image="{{asset('light-bootstrap/img/bghome.jpg')}}">
        <div class="content">
       
            <div class="container">
                <div class="row ">

                <div class="col-md-1"></div>

                <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 style="font-weight:bold">Bus-Trips</h5>
                        <h3>Reserve Your Ticket Now!</h3>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">

                      <table class="table table-striped">
                <thead class="">
                    <tr class="table-danger" >
                    <th scope="col" class="text-dark">Bus</th>
                    <th scope="col" class="text-dark">Availability</th>
                    <th scope="col" class="text-dark">Routes</th>
                    <th scope="col" class="text-dark">Schedule</th>
                    <th scope="col" class="text-dark">Fare</th>
                   
                    <th scope="col" class="text-dark">Action</th>
                    </tr>
                </thead>
  <tbody>
 
   @php
   $datenow = date('Y-m-d');
      $data = DB::select('select 
b.Bus_No,b.seating_capacity,b.company,b.color,
s.departure,s.est_arrival,s.schedule,s.status,s.est_traveltime,
r.from,r.to,r.aircon_fare,r.non_aircon_fare,
t.created_at as tripcreated,t.bus_id,t.routes_id,t.TS_id,t.id

from buses b 
INNER join trips t on b.id = t.bus_id 
INNER join travel_schedules s on t.TS_id = s.id
inner join routes r on t.routes_id = r.id and s.schedule >= "'.$datenow.'" ');
    @endphp

   
      @if(count($data)>=1)
      @foreach($data as $item)
      <tr>
      <td>    
            <h6 style="font-weight:bold">
            Bus no# : {{$item->Bus_No}} <br>
            {{$item->company}}
            <br>
          {{$item->color}}
        </h6>

        </td>
        <td>
            <span style="font-size:12px">Seating Capacity:
            <br>
           <span style="font-weight:bold">{{$item->seating_capacity}}</span>
            <br>
            Vacant Seats:
            <br>
            <span style="font-weight:bold">51</span>
        </span>
        </td>
        <td>
           <span style="font-size:14px">
         {{$item->from}} - {{$item->to}}
        </span>
        </td>
        <td>
        <span style="font-size:13px">
        @if($item->status == 0)
        <span class="badge bg-danger">Inactive</span>
        @else 
        <span class="badge bg-success">Active</span>
        @endif
       
        <br>
           <span style="font-weight:bold"> {{date('F j, Y',strtotime($item->schedule))}}</span> 
            <br>
            Departure:
            <br>
            <span style="font-weight:bold"> {{date('h:ia',strtotime($item->departure))}} </span>
            <br>
            Estimated Arrival
            <br>
            <span style="font-weight:bold"> {{date('h:ia',strtotime($item->est_arrival))}} </span>

            <br>
            Estimated Travel time
            <br>
            <span style="font-weight:bold"> 
              {{$item->est_traveltime}}
            </span>


        </span>

        </td>
        <td>
            <span style="font-weight: bold;font-size:13px"> Air Condition :</span>
            &#8369; {{$item->aircon_fare}}
            <br>
            <span style="font-weight: bold;font-size:13px"> Non -Air Condition :</span>
            &#8369; {{$item->non_aircon_fare}}
        </td>
       
        
      <td>
       
        @if(date('Y-m-d') > $item->schedule)

        @else
    <button  class="btn btn-primary btn-sm" onclick="window.location.href='{{route('viewbus',['trip_id'=>$item->id,'reserve'=>true,'id'=>$item->bus_id])}}' ">Reserve <i class="fas fa-ticket"></i></button>
        @endif
      </td>
    </tr>
      @endforeach
      @endif
 
  </tbody>
</table>

@if(count($data)==0)
  <h6 style="text-align:center">
      <img src="{{asset('light-bootstrap/img/notfound.svg')}}" style="width: 300px" alt="">

    <br> <br>
    
    No Data Found..</h6>

    <br> <br>
@endif


                      </div>
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
        });
    </script>
@endpush
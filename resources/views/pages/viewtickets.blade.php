@extends('layouts.app', ['activePage' => 'tickets', 'title' => 'ZCIBT', 'navName' => 'Tickets', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'tickets')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                <br>
                <h5 class="mt-3" style="font-weight:bold">{{$user}}
                
            </h5>
                @php
 $tickets = DB::select('SELECT t.id,t.column_seat_id ,u.firstname,u.middlename,u.lastname , 
ts.departure,ts.est_arrival,ts.schedule,ts.status as schedulestatus, 
r.from , r.to,r.fare,
b.Bus_No,b.seating_capacity,b.company,b.weight,b.color,b.per_column,b.per_row 
from users u inner join tickets t on t.user_id = u.id 
INNER join travel_schedules ts on ts.id = t.ts_id 
inner join routes r on r.id = t.routes_id
INNER JOIN buses b on b.id = t.bus_id where u.id = '.$userid.' ');
            @endphp
            <ul class="list-group list-group-flush">
                @foreach($tickets as $val)

                <li class="list-group-item bg-light mb-2 shadow-lg" style="font-size:12px;border-left:5px solid #66cbdf;border-radius:5px">
  <div style="float:right;font-size:12px;font-weight:normal">
    Bus No: {{$val->Bus_No}}
    <br>
    Seat No: {{$val->column_seat_id}}
    <br>
    {{$val->per_column}} x {{$val->per_row}}
    <br>
    Seating Capacity : {{$val->seating_capacity}}
    <br>
    {{$val->company}}
</div>
    <h6>Reference Code</h6>
    
    <br>
    From : {{$val->from}}
    <br>
    To   : {{$val->to}}
    <br>
    Schedule : {{date('F j ,Y',strtotime($val->schedule))}}
    <br>

   
  
    Departure : {{date('h:ia',strtotime($val->departure))}}
    <br>
    Estimated Arrival : {{date('h:ia',strtotime($val->est_arrival))}}
    <br>
    Fare : &#8369; {{$val->fare}}
    <br>
  
    </li>
                @endforeach

  
</ul>
                 
                </div>
              
            </div>
        </div>
    </div>
@endsection
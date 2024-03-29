@extends('layouts.app', ['activePage' => 'tickets', 'title' => 'ZCIBT', 'navName' => 'Tickets', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            @if(Auth::user()->user_type !=3)
                            <h4 class="card-title"> All Sold Tickets</h4>
                            <p class="card-category">Tickets Informations</p>
                            @else 
                            <h4 class="card-title"> My Tickets</h4>
                            <p class="card-category">Tickets Informations</p>
                            @endif
                           
                        </div>
                        <div class="card-body ">
                        @if(Auth::user()->user_type !=3)
                        <div class="table-responsive">
                        <table class="table table-striped">
                    <thead class="">
                        <tr class="table-danger" >
                      
                        <th scope="col" class="text-dark">Name</th>
                        <th scope="col" class="text-dark">Tickets</th>
                        <th scope="col" class="text-dark">Payment Status</th>
                       


                       
                       
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $data = DB::select('SELECT * FROM `users` where id in (select user_id from tickets)');
                        $datenow = date('Y-m-d');
                      @endphp


                      @if(count($data)>=1)
                        @foreach($data as $item)
                        <tr>
                      
                        <td style="font-weight:bold">
                        {{$item->firstname.' '.$item->lastname}}
                        <br>
                       <span style="font-size:12px;font-weight:normal">{{$item->email}}</span>
                
                    
                    </td>
                       
                        <td >
   @php
 $tickets = DB::select('SELECT t.id,t.column_seat_id,t.discount,t.status,t.idfile ,t.reason ,
u.firstname,u.middlename,u.lastname , 
ts.departure,ts.est_arrival,ts.schedule,ts.status as schedulestatus, 
r.from , r.to,r.aircon_fare,r.non_aircon_fare,
b.Bus_No,b.seating_capacity,b.company,b.weight,b.color,b.per_column,b.per_row 
, d.title,d.discount
from users u inner join tickets t on t.user_id = u.id 
INNER join travel_schedules ts on ts.id = t.ts_id 
inner join routes r on r.id = t.routes_id
INNER JOIN buses b on b.id = t.bus_id
LEFT JOIN fare_discounts d on d.id = t.discount where u.id = '.$item->id.' ');

    $user = $item->firstname.' '.$item->lastname;
            @endphp
                        <button type="button"  class="btn btn-primary btn-sm" onclick="window.location.href='{{route('viewusertickets',['id'=>$item->id,'user'=>$user])}}' ">
                        Tickets <span class="badge badge-danger">{{count($tickets)}}</span>
                        <span class="sr-only"></span>
                        </button>


                        </td>
                        <td>
                            <span class="badge bg-success">Paid</span>
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

                        @else 

                        @php
 $tickets = DB::select('SELECT t.id,t.column_seat_id,t.discount,t.status,t.idfile,t.reason ,t.receiptfile,t.pstatus,
u.firstname,u.middlename,u.lastname , 
ts.departure,ts.est_arrival,ts.schedule,ts.status as schedulestatus, 
r.from , r.to,r.aircon_fare,r.non_aircon_fare,
b.Bus_No,b.seating_capacity,b.company,b.weight,b.color,b.per_column,b.per_row 
, d.title,d.discount
from users u inner join tickets t on t.user_id = u.id 
INNER join travel_schedules ts on ts.id = t.ts_id 
inner join routes r on r.id = t.routes_id
INNER JOIN buses b on b.id = t.bus_id
LEFT JOIN fare_discounts d on d.id = t.discount where u.id = '.Auth::user()->id.' order by ts.schedule desc ');

$datenow = date('Y-m-d');
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
<h6>Reference Code : {{$val->id.date('FYmd',strtotime($val->schedule))}}</h6>
<span style="font-size:11px">Present this Reference code in the bus you have selected</span>
<br>
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
    Fare : 
    <br>
    Aircon : &#8369; {{$val->aircon_fare}}
    <br>
    Non-Aircon : &#8369; {{$val->non_aircon_fare}}
   
    <br>

    @if($val->pstatus == 0)
    <span class="badge bg-danger">Unpaid</span>
    @endif

    @if($val->receiptfile)

        @if(file_exists(public_path().'/attachments/'.$val->receiptfile))
        <a target="_blank" class="btn btn-primary btn-sm mt-2" href="{{asset('attachments').'/'.$val->receiptfile}}">View Receipt</a>
        @else 

             <a target="_blank" class="btn btn-primary btn-sm mt-2" href="{{asset('attachments').'/'.$val->receiptfile}}">View Receipt</a>
        @endif


    @endif
   
    <br>

    @if($val->discount > 0)
       
            <div class="card">
                <div class="card-body">
                    <h6>Discount Request</h6>
                    @if($val->status == 0)
                <span class="badge badge-warning">For Approval</span>
                @elseif($val->status == 1) 
                <span class="badge badge-success">Approved</span>
                @elseif($val->status == 3)
                <span class="badge badge-success">Approved</span>
                @else 
                <span class="badge badge-danger">Disapproved</span>
                 @endif
                <br>
                Title : {{$val->title}}
                <br>
                Discount : &#8369; {{$val->discount}}
     <br>
     @if($val->status == 1 || $val->status == 2)
     @if($val->reason)
   Reason : <span class="text-danger">{{$val->reason}}</span>
    @endif
    @else 
    Your Discount Request is waiting for admin Approval.
     @endif
     
                </div>
            </div>
       
    @endif
    
    <br>
    
    @if($datenow > $val->schedule)
    <div class="card">
        <div class="card-body">
            <span class="badge badge-danger">Expired</span>
     <br>
        If you have used this ticket Ignore this message. <br> If you have`nt used this ticket. Contact Administration for a Refund or Another Reservation.

        </div>
    </div>
    @endif

    </li>
                @endforeach

  
</ul>
                        @endif
                      
                        
                       
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
@endsection
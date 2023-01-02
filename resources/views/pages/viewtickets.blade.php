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
LEFT JOIN fare_discounts d on d.id = t.discount where u.id = '.$userid.' ');

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
    @if($val->reason)
   Reason : <span class="text-danger">{{$val->reason}}</span>
    @endif
<br>
    @if($val->status == 0)
<button class="btn btn-primary btn-sm mt-2" data-id="{{$val->id}}" id="confirm">CONFIRM</button>
<button class="btn btn-danger btn-sm mt-2 ml-2" data-id="{{$val->id}}" id="decline">DECLINE</button>
    @endif
           </div>
       </div>
  
@endif



    
    @if($datenow > $val->schedule)
    <div class="card">
        <div class="card-body">
            <span class="badge badge-danger">Expired</span>
     <br>

     @if(Auth::user()->user_type != 1 && Auth::user()->user_type != 0)
        If you have used this ticket Ignore this message. <br> If you have`nt used this ticket. Contact Administration for a Refund or Another Reservation.
    @endif
        </div>
    </div>
    @endif

  
    </li>
                @endforeach

  
</ul>

                 
                </div>
              
            </div>
        </div>
    </div>
<script>
       $('#confirm').click(function(){
        var id = $(this).data('id');
        swal({
  title: "Are you sure?",
  text: "Once Marked. you will not be able to redo it.",
  icon: "warning",
  buttons: true,
  dangerMode: false,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
        method: "get",
        url: "{{route('actiondiscountrequest')}}",
        data: { id: id,  type:'approve' }
        })
        .done(function( msg ) {
            swal({
            title: "Request Approved!",
            text: "Request approved successfully!",
            icon: "success",
            }).then(()=>{
                window.location.reload();
            });
        });


  } 
});
    })
    $('#decline').click(function(){
        var id = $(this).data('id');
        swal({
  title: "Are you sure?",
  text: "Once Marked. you will not be able to redo it.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Declining Request","Please Provide a Reason:", {
  content: "input",
})
.then((value) => {
    if(value == ''){
        swal({
  title: "Reason Required!",
  text: "Please Provide a reason for declining request",
  icon: "error",
});
    }else {
        
        $.ajax({
        method: "get",
        url: "{{route('actiondiscountrequest')}}",
        data: { id: id, reason: value , type:'decline' }
        })
        .done(function( msg ) {
            swal({
            title: "Request Declined!",
            text: "Request declined successfully!",
            icon: "success",
            }).then(()=>{
                window.location.reload();
            });
        });


    }
});

  } 
});
    })
</script>
@endsection
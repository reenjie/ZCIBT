@extends('layouts.app', ['activePage' => 'confirmedpassengers', 'title' => 'ZCIBT', 'navName' => 'Confirm Passenger', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                        <h4 class="card-title"> Confirmed Passenger Tickets <i class="fas fa-check-circle text-success"></i></h4>
                        <p class="card-category">Tickets Confirmation</p>
                        </div>
                        <div class="card-body ">
                        <button class="btn btn-dark btn-sm" onclick="window.location.href='{{route('page.index', 'passengers')}}'">Back</button>
                     

                        @php
                        
$datenow = date('Y-m-d');
 $tickets = DB::select('SELECT t.id,t.status,t.bus_id,t.column_seat_id,t.discount,t.status,t.idfile,t.reason ,
u.firstname,u.middlename,u.lastname , 
ts.departure,ts.est_arrival,ts.schedule,ts.status as schedulestatus, 
r.from , r.to,r.fare,
b.Bus_No,b.seating_capacity,b.company,b.weight,b.color,b.per_column,b.per_row 
, d.title,d.discount
from users u inner join tickets t on t.user_id = u.id 
INNER join travel_schedules ts on ts.id = t.ts_id 
inner join routes r on r.id = t.routes_id
INNER JOIN buses b on b.id = t.bus_id
LEFT JOIN fare_discounts d on d.id = t.discount where t.bus_id = '.Auth::user()->bus_id.' and t.status =3   order by ts.schedule desc');

            @endphp

           
            <ul class="list-group list-group-flush">
                @foreach($tickets as $val)

              

                <li class="list-group-item bg-light mb-2 shadow-lg" id="exp{{$val->id}}" style="font-size:12px;border-left:5px solid #66cbdf;border-radius:5px">
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
    <span style="font-size:15px;text-transform:uppercase;font-weight:Bold">{{$val->firstname.' '.$val->lastname}}</span>
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
    
    @if($val->status == 1 || $val->status == 0)
    <button class="btn btn-success btn-sm confirm" data-id="{{$val->id}}">Confirm <i class="fas fa-check-circle"></i></button>
     @endif
    <br>
    
    @if($datenow > $val->schedule)
        
    <div class="card">
        <div class="card-body">
            <span class="badge badge-danger">Expired</span>
     <br>
        @if(Auth::user()->user_type != 1  )
        If you have used this ticket Ignore this message. <br> If you have`nt used this ticket. Contact Administration for a Refund or Another Reservation.
        @else 

        <script>
            $('#exp{{$val->id}}').addClass('d-none');
        </script>
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
        </div>
    </div>

    <script>
        $('.confirm').click(function(){
            var id = $(this).data('id');

            swal({
            title: "Are you sure?",
            text: "Please make sure passenger is onboard before confirming..",
            icon: "info",
            buttons: true,
            dangerMode: false,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location.href="{{route('confirm')}}?id="+id;
            } 
            });
        })
    </script>
@endsection
@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'ZCIBT', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            @php
                $revenue = DB::select('select r.aircon_fare, sum(r.aircon_fare) as total from tickets t INNER JOIN routes r on r.id = t.routes_id group by aircon_fare');    

                $sold = DB::select('select * from tickets');

                $users = DB::select('select * from users');

                $request = DB::select('select * from tickets where idfile !="" and status !=0 and discount !=0 ');
            @endphp
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="border-left:5px solid #279ec8">
                    <div class="card-body">
                            <div style="float:right;text-align:center">
                            <i style="font-size:45px" class="fas fa-money text-secondary"></i>
                            </div>
                        <div style="font-weight:bold" class="text-info">Revenue</div>
                        <span style="font-size:20px">&#8369; 
                        @foreach ($revenue as $total)
                                {{$total->total}}
                        @endforeach
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card" style="border-left:5px solid #f9d48e">
                    <div class="card-body">
                            <div style="float:right;text-align:center">
                            <i style="font-size:45px" class="fas fa-ticket text-secondary"></i>
                            </div>
                        <div style="font-weight:bold;color:#db8142" class="">Ticket Sold</div>
                        <span style="font-size:20px">{{count( $sold )}}</span>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card" style="border-left:5px solid #36a3c4">
                    <div class="card-body">
                            <div style="float:right;text-align:center">
                            <i style="font-size:45px" class="fas fa-users text-secondary"></i>
                            </div>
                        <div style="font-weight:bold;color:#063d76" class="">Users</div>
                        <span style="font-size:20px">{{count($users)}}</span>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card" style="border-left:5px solid #f76579">
                    <div class="card-body">
                            <div style="float:right;text-align:center">
                            <i style="font-size:45px" class="fas fa-bell text-secondary"></i>
                            </div>
                        <div style="font-weight:bold;color:#c43d4f" class="">Request</div>
                        <span style="font-size:20px">{{count($request)}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3">
                <button class="btn btn-info " data-toggle="modal" data-target="#gcashpmethod">
                   Manage Gcash Payment QR-Code <i class="fas fa-cogs"></i>
                  </button>

            </div>
        </div>
     
  
  <!-- Modal -->
  <div class="modal fade" id="gcashpmethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gcash Qr-Code</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('saveqr')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            @php
                $qrcode = DB::select('SELECT * FROM `qrcodes` where bus_id = 0 ');
            @endphp

                <div class="container">
                 
                        @foreach ($qrcode as $item)
                        <img src="{{asset('qrcode').'/'.$item->file}}" alt="" style="width:100%" >
    
                        <input type="hidden" name="id" value="{{$item->id}}">
                        @endforeach
                    
                </div>

            <span style="font-size:13px" class="text-danger">
                Upload a file to Update QR-Code.
            </span>
            <input type="file" name="qrfile" required class="form-control">
            
           
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
        <br>
        @if(Auth::user()->user_type == 0 || Auth::user()->user_type == 1)
            @php
                $tickets = DB::Select('SELECT t.id,t.idfile,t.column_seat_id,t.discount,t.status,t.idfile ,t.reason ,
u.firstname,u.middlename,u.lastname , 
ts.departure,ts.est_arrival,ts.schedule,ts.status as schedulestatus, 
r.from , r.to,r.aircon_fare,r.non_aircon_fare,
b.Bus_No,b.seating_capacity,b.company,b.weight,b.color,b.per_column,b.per_row 
, d.title,d.discount
from users u inner join tickets t on t.user_id = u.id 
INNER join travel_schedules ts on ts.id = t.ts_id 
inner join routes r on r.id = t.routes_id
INNER JOIN buses b on b.id = t.bus_id
LEFT JOIN fare_discounts d on d.id = t.discount where t.status = 0 and t.discount > 0 ');
            @endphp

            @if(count($tickets)>=1)
            <div class="card" mt-2 mb-2>
                <div class="card-boby p-4">
                    <h5 style="font-weight:bold">Discount Request</h5>
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
<br>
<span style="font-size:15px">User : {{$val->firstname.' '.$val->middlename.' '.$val->lastname}}</span>

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
  
    <br>

    @if($val->discount > 0)
       
       <div class="card">
           <div class="card-body">
               <h6>Discount Request</h6>
               @if($val->status == 0)
           <span class="badge badge-warning">For Approval</span>
           @elseif($val->status == 1) 
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
    <a href="{{asset('attachments').'/'.$val->idfile}}" target="_blank">{{$val->idfile}} <i class="fas fa-file"></i></a>
    <br><br>
<button class="btn btn-primary btn-sm mt-2" data-id="{{$val->id}}" id="confirm">CONFIRM</button>
<button class="btn btn-danger btn-sm mt-2 ml-2" data-id="{{$val->id}}" id="decline">DECLINE</button>


    @endif
           </div>
       </div>
  
@endif
  
    </li>
                @endforeach

  
</ul>

                </div>
             </div>
            @endif
            
        @endif
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        
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
    <script>

window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Daily Ticket Sales"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y} tickets</strong>",
		indexLabel: "{name} - {y} tickets",
		dataPoints: [
            @php
        $graphdata = DB::select('select count(id) as tickets, date(created_at) as created_at from tickets group by created_at');

    @endphp
    @foreach($graphdata as $dd)
    { y: {{$dd->tickets}}, name: "{{$dd->created_at}}" },
    @endforeach
			
		]
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>
@endsection


@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

          //  demo.showNotification();

        });
    </script>
@endpush
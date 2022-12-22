@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'ZCIBT', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">

        <div class="row">
            <div class="col-md-3">
                <div class="card" style="border-left:5px solid #279ec8">
                    <div class="card-body">
                            <div style="float:right;text-align:center">
                            <i style="font-size:45px" class="fas fa-money text-secondary"></i>
                            </div>
                        <div style="font-weight:bold" class="text-info">Revenue</div>
                        <span style="font-size:20px">&#8369; 500</span>
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
                        <span style="font-size:20px">1500</span>
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
                        <span style="font-size:20px">1500</span>
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
                        <span style="font-size:20px">1</span>
                    </div>
                </div>
            </div>
        </div>

        <br>
        @if(Auth::user()->user_type == 0)
            @php
                $tickets = DB::Select('SELECT t.id,t.column_seat_id,t.discount,t.status,t.idfile ,t.reason ,
u.firstname,u.middlename,u.lastname , 
ts.departure,ts.est_arrival,ts.schedule,ts.status as schedulestatus, 
r.from , r.to,r.fare,
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
  
    </li>
                @endforeach

  
</ul>
                </div>
             </div>
            @endif
            
        @endif
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
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
window.onload = function() {

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Daily Sales Data"
	},
	axisY: {
		title: "Units",
		titleFontSize: 24,
		includeZero: true
	},
	data: [{
		type: "column",
		yValueFormatString: "#,### Units",
		dataPoints: dataPoints
	}]
});

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			x: new Date(data[i].date),
			y: data[i].units
		});
	}
	chart.render();

}

$.getJSON("https://canvasjs.com/data/gallery/javascript/daily-sales-data.json", addData);

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
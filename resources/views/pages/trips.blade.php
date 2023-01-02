@extends('layouts.app', ['activePage' => 'trips', 'title' => 'ZCIBT', 'navName' => 'Trips', 'activeButton' => 'laravel'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">All Trips</h4>
                            <p class="card-category">Manage Trips Informations</p>
                        </div>
                        <div class="card-body ">
                          
                     
                       @if(Auth::user()->user_type != 3)
      <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index','addTrip')}}' "  >Add <i class="fas fa-plus-circle"></i></button>
                       
    @endif 
                       @if(session()->has('success'))
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session()->get('success')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      @endif

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

   if(Auth::user()->user_type == 1){
    $data = DB::select('select 
b.Bus_No,b.seating_capacity,b.company,b.color,
s.departure,s.est_arrival,s.schedule,s.status,
r.from,r.to,r.aircon_fare,r.non_aircon_fare,r.est_traveltime,
t.created_at as tripcreated,t.bus_id,t.routes_id,t.TS_id,t.id
from buses b 
INNER join trips t on b.id = t.bus_id 
INNER join travel_schedules s on t.TS_id = s.id
inner join routes r on t.routes_id = r.id where b.id='.Auth::user()->bus_id.' order by s.schedule desc ');
   }else {
    $data = DB::select('select 
b.Bus_No,b.seating_capacity,b.company,b.color,
s.departure,s.est_arrival,s.schedule,s.status,s.est_traveltime,
r.from,r.to,r.aircon_fare,r.non_aircon_fare,
t.created_at as tripcreated,t.bus_id,t.routes_id,t.TS_id,t.id
from buses b 
INNER join trips t on b.id = t.bus_id 
INNER join travel_schedules s on t.TS_id = s.id
inner join routes r on t.routes_id = r.id order by s.schedule desc;');
   }
    


$datenow = date('Y-m-d');
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
            @php
            $vacant = DB::select('select * from tickets where bus_id = '.$item->bus_id.' and routes_id = '.$item->routes_id.' and ts_id ='.$item->TS_id.' ')
            @endphp
            <span style="font-weight:bold">{{$item->seating_capacity - count($vacant)}}</span>
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
        @if($datenow > $item->schedule)
        <span class="badge bg-danger">Inactive</span>
          @else 
          <span class="badge bg-success">Active</span>
          @endif

       
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

      @if(Auth::user()->user_type == 3)
          @if($datenow > $item->schedule)
          <span class="badge bg-danger">Sold Trips</span>
          @else 
          <button  class="btn btn-primary btn-sm" onclick="window.location.href='{{route('viewbus',['trip_id'=>$item->id,'reserve'=>true,'id'=>$item->bus_id,'authenticathed'=>true])}}' ">Reserve <i class="fas fa-ticket"></i></button>
          @endif

    
        @else 
  <button class="btn btn-link text-secondary btn-sm" onclick="window.location.href='{{route('viewbus',['id'=>$item->bus_id,'trip_id'=>$item->id,'viewingticket'=>true,'authenticathed'=>true])}}' "><i class="fas fa-eye"></i></button>
 
        <button data-id="{{$item->id}}" class="btn btn-link text-danger ml-2  btn-sm delete"><i class="fas fa-trash-can"></i></button>
        
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
              
            </div>
        </div>
    </div>
  
    <script>
      $('.delete').click(function(){
        var id = $(this).data('id');
        swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be recover it and all data connected to this bus will be deleted!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      window.location.href='{{route("delete",["type"=>"trip"])}}'+'&id='+id;
  }
});
      })
    </script>


@endsection
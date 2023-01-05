@extends('layouts.app', ['activePage' => 'busses', 'title' => 'ZCIBT', 'navName' => 'Bus Seats', 'activeButton' => 'laravel'])

@section('content')
    
            <div class="content bg-light p-5 " >
            <div class="container-fluid">
               
                @isset($viewingticket)
                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index', 'trips')}}' ">Back</button>
                @else 
              

                    @isset($reserve)
                        @isset($authenticathed)
                        <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index', 'trips')}}' ">Back</button>
                        @else 
                        <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('reserve')}}' ">Back</button>
                        @endisset
                 
                        @else 
                        <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index', 'busses')}}' ">Back</button>
                    @endisset
                @endisset

                <br>
                
                <h5 class="mt-2" style="font-weight:bold">
                <span style="font-weight:normal;font-size:14px">Bus No#:</span>
               
                @foreach($bus as $bal)
                    {{$bal->Bus_No}}
                @endforeach
                </h5>

                @isset($reserve)
                <h3>Reserve your seat.</h3>
                @endisset
               <br>
               @if(session()->has('success'))
                <div class="alert alert-warning alert-dismissible fade show">
                    {{session()->get('success')}}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                 </button>
                </div>
               @endif

            <h6 style="text-align:center">FRONT OF THE BUS</h6>
        <div class="container p-5">
        <div class="table-responsive" >
            {{-- <style>
                table, tr, td, thead, tbody {display: block!important;}
tr {float: left!important; width: 50%!important;}
            </style> --}}
        <table class="table table-bordered table-light">
  <thead>
    <tr>
     @php
        $header = DB::select('SELECT DISTINCT `column` FROM `column_seats` WHERE bus_id = '.$busid.' ;');
     @endphp
    @foreach($header as $row)
   
  @endforeach
  </tr>
  </thead>
  <!-- busid  -->
  <tbody>
  <tr>
    <td colspan="100%">
        <div style="display: flex;">
            <div class="" style="width:100%;border-right:1px solid gray">
                <div class="card-body" style="text-align: center;font-weight:bold;font-size:14px">
                    <i class="fas fa-steering-wheel"></i> DRIVER
                </div>
              </div>
              
              <div class=""  style="width:100%">
                <div class="card-body"  style="text-align: center;font-weight:bold;font-size:14px">
                    ENTRANCE
                </div>
              </div>
        </div>
    </td>
   
  </tr>
  @foreach($rows as $row)
 
                    <tr >
                       
                        @foreach($columns as $col)
                        @if($col->rowseat_id == $row->id)
                        <td>
                            {{$col->seatnumber}}
                        </td>
                          {{--   <td >
                                <span style="font-size:11px">Seat# {{$row->row}}</span>
                                <br>
                                @isset($viewingticket)
                                
                                @php
                                    $reserved = DB::select('SELECT * FROM `tickets` where bus_id = '.$busid.' and column_seat_id ='.$col->id.' and row_seat_id = '.$col->rowseat_id.' and ts_id ='.$ts_id.'  ');
                                    @endphp

                                    @if(count($reserved)>=1)
                                        @foreach($reserved as $val)
                                        @if($val->user_id == Auth::user()->id)
                                        <span class="badge bg-success mb-3">Selected</span>
                                      <br>
                                    <h6 style="text-align:center">
                                    <button data-ticket = "{{$val->id}}" data-busid ="{{$busid}}" class="changeseat btn btn-link text-danger btn-sm px-2">Change seat <i class="fas fa-exclamation-triangle"></i></button>
                                </h6>
                                        @else 

                                        <span class="badge bg-danger">Occupied</span>
                                        @endif
                                        @endforeach
                                  
                                    @else 
                                  
                                    <span class="badge bg-success">Vacant</span>
                                 
                                    @endif
                               
                                @endisset

                                @isset($reserve)
                                <!--  -->
                                    @php
                                    $reserved = DB::select('SELECT * FROM `tickets` where bus_id = '.$busid.' and column_seat_id ='.$col->id.' and row_seat_id = '.$col->rowseat_id.' and ts_id ='.$ts_id.' ');
                                    @endphp

                                    @if(count($reserved)>=1)
                                        @foreach($reserved as $val)
                                        @if(auth()->check())
                                        @if($val->user_id == Auth::user()->id)
                                        <span class="badge bg-success mb-3">Selected</span>
                                      <br>
                                    <h6 style="text-align:center">
                                    <button data-ticket = "{{$val->id}}" data-busid ="{{$busid}}" class="changeseat btn btn-link text-danger btn-sm px-2">Change seat <i class="fas fa-exclamation-triangle"></i></button>
                                </h6>
                                        @else 

                                        <span class="badge bg-danger">Occupied</span>
                                        @endif
                                        @else 
                                        <span class="badge bg-danger">Occupied</span>
                                        @endif
                                      
                                        @endforeach
                                  
                                    @else 
                                  
                                   
                                    <button data-colid = "{{$col->id}}" data-auth ="@isset($authenticathed) 1 @else 0 @endisset"  data-tripid="{{$tripid}}" data-rowid ="{{$col->rowseat_id}}" class="select btn btn-dark btn-sm px-3">Select</button>

                                      
                                 
                                    @endif
                              
                                @endisset
                           
                            </td> --}}
                            @endif
                        @endforeach
                    </tr>

  @endforeach
  </tbody>
</table>
        </div>
        </div>
<h6 style="text-align:center">BACK OF THE BUS</h6>
   
            </div>
            </div>
       
<script>
    $('.changeseat').click(function(){
        var id = $(this).data('ticket');
        var busid = $(this).data('busid');
        
        swal({
  title: "Are you sure?",
  text: "Your selected seat will be availble for others. and you may not be able to select it again.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Seat Number:", {
                content: "input",
                })
                .then((value) => {
              if(value == ''){
                swal({
                    title: "No inputs",
                    text: "Please input a seat number",
                    icon: "error",
                    button: "OK",
                    });
              }else {
                if(isNaN(value)){
                    swal({
                    title: "Invalid Seat number",
                    text: "Please input a valid seat number",
                    icon: "error",
                    button: "OK",
                    });
                }else {
                  
                    $.ajax({
                    method: "get",
                    url: "{{route('changeseat')}}",
                    data: { id:value,updateid:id,busid:busid }
                    })
                    .done(function( msg ) {
                        
                        if(msg == 'invalidid'){
                            swal({
                    title: "Changing Seat Failed!",
                    text: "The selected seat number is either not valid or occupied ",
                    icon: "error",
                    button: "OK",
                    });
                        }else {
                            swal({
                    title: "Changed Successfully!",
                    text: "You have changed your seat successfully!",
                    icon: "success",
                    button: "OK",
                    }).then(()=>{
                        window.location.reload();
                    });
                        }
                    });
                }
       }
                });
  } 
});

    })
    $('.select').click(function(){
        var colid = $(this).data('colid');
        var rowid = $(this).data('rowid');
        var tripid= $(this).data('tripid');
        var auth  = $(this).data('auth');
      

        swal({
  title: "Are you sure?",
  text: "Secure ticket payment first before proceeding to your reservation.You will be asked to pay via Credit cards.",
  icon: "warning",
  buttons: true,
  dangerMode: false,
})
.then((willDelete) => {
  if (willDelete) {
    window.location.href= '{{route('payticketregister')}}'+'?colid='+colid+'&rowid='+rowid+'&tripid='+tripid+'&auth='+auth;
  } 
});
    })
</script>
@endsection
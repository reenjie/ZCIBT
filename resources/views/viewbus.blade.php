@extends('layouts.app', ['activePage' => 'busses', 'title' => 'ZCIBT', 'navName' => 'Bus Seats', 'activeButton' => 'laravel'])

@section('content')
    
            <div class="content bg-light p-5 " >
            <div class="container-fluid">
                @isset($viewingticket)
                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index', 'trips')}}' ">Back</button>
                @else 
              

                    @isset($reserve)
                    <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('reserve')}}' ">Back</button>
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

            <h6 style="text-align:center">FRONT OF THE BUS</h6>
        <div class="container p-5">
        <div class="table-responsive" >
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
  <tbody>
  @foreach($rows as $row)
                    <tr >
                        @foreach($columns as $col)
                        @if($col->rowseat_id == $row->id)
                            <td >
                                <span style="font-size:11px">Seat# {{$col->id}}</span>
                                <br>
                                @isset($reserve)
                                <!-- <span class="badge bg-danger">Occupied</span> -->
                            
                                <button data-colid = "{{$col->id}}" data-rowid ="{{$col->rowseat_id}}" class="select btn btn-dark btn-sm px-3">Select</button>
                                @endisset
                           
                            </td>
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
    $('.select').click(function(){
        var colid = $(this).data('colid');
        var rowid = $(this).data('rowid');

        swal({
  title: "Are you sure?",
  text: "Secure ticket payment first before proceeding to your reservation.You will be asked to pay via Credit cards.",
  icon: "warning",
  buttons: true,
  dangerMode: false,
})
.then((willDelete) => {
  if (willDelete) {
    window.location.href= '{{route('payticketregister')}}'+'?colid='+colid+'&rowid='+rowid;
  } 
});
    })
</script>
@endsection
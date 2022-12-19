@extends('layouts.app', ['activePage' => 'busses', 'title' => 'ZCIBT', 'navName' => 'Bus Seats', 'activeButton' => 'laravel'])

@section('content')
    
            <div class="content">
            <div class="container-fluid">
                @isset($viewingticket)
                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index', 'trips')}}' ">Back</button>
                @else 
                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index', 'busses')}}' ">Back</button>
                @endisset

                <br>
                
                <h5 class="mt-2" style="font-weight:bold">
                <span style="font-weight:normal;font-size:14px">Bus No#:</span>
               
                @foreach($bus as $bal)
                    {{$bal->Bus_No}}
                @endforeach
                </h5>
               <br>

            <h6 style="text-align:center">FRONT</h6>
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
                           
                            </td>
                            @endif
                        @endforeach
                    </tr>

  @endforeach
  </tbody>
</table>
        </div>
<h6 style="text-align:center">BACK</h6>
   
            </div>
            </div>
       

@endsection
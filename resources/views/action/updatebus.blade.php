@extends('layouts.app', ['activePage' => 'busses', 'title' => 'Update Bus', 'navName' => 'Busses', 'activeButton' => 'laravel'])

@section('content')
   
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'routes')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                            <h4 class="card-title mt-3">Update Bus</h4>
                           
                        </div>
                        <div class="card-body ">
                        <div class="container">
            <form action="{{route('update',['type'=>'bus','id'=>$UpdateData['id']])}}" method="post">
                   @csrf
                            
                        <div class="row">
          <div class="col-md-12">
            <h6 style="font-size:13px">Bus Number:</h6>
            <input type="text" class="form-control mb-2" name="busnumber" value="{{$UpdateData['Bus_No']}}" placeholder="Bus Number" autofocus required>
          </div>
          <div class="col-md-4">
          <h6 style="font-size:13px">Seating Capacity</h6>
          <input type="number" readonly value="{{$UpdateData['seating_capacity']}}" class="form-control mb-2" required name="seatcapacity">
          </div>

          <div class="col-md-4">
          <h6 style="font-size:13px">Per Row</h6>
          <input type="number" readonly value="{{$UpdateData['per_row']}}" class="form-control mb-2" required name="perrow">
          </div>
          <div class="col-md-4">
          <h6 style="font-size:13px">Per Column</h6>
          <input type="number" value="{{$UpdateData['per_column']}}" readonly class="form-control mb-2" required name="percolumn">
          </div>

          <div class="col-md-12">
          <h6 style="font-size:13px">Color</h6>
          <input type="text" class="form-control mb-2" name="color" value="@isset($UpdateData['color']) $UpdateData['color'] @endisset">
          </div>

          <div class="col-md-12">
          <h6 style="font-size:13px">Company</h6>
         <textarea  class="form-control mb-2" id="" style="height:120px" name="company">@isset($UpdateData['company']){{$UpdateData['company']}}@endisset</textarea>
          </div>

        
        <div class="col-md-12">
            <button class="btn btn-primary " type="submit" style="float:right">Save</button>
        </div>
        </div>

        </form>

     

                        </div>

        
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>




@endsection
@extends('layouts.app', ['activePage' => 'routes', 'title' => 'Update Bus Routes', 'navName' => 'Routes', 'activeButton' => 'laravel'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'routes')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                            <h4 class="card-title mt-3">Update Bus Routes</h4>
                           
                        </div>
                        <div class="card-body ">
                        <div class="container">
            <form action="{{route('update',['type'=>'routes','id'=>$UpdateData['id']])}}" method="post">
                                @csrf
                            
                        <div class="row">
          <div class="col-md-6">
            <h6 style="font-size:13px">From</h6>
            <input type="text" class="form-control mb-2" name="from" value="{{$UpdateData['from']}}" placeholder="From" autofocus required>
          </div>
          <div class="col-md-6">
          <h6 style="font-size:13px">To</h6>
          <input type="text" value="{{$UpdateData['to']}}" class="form-control mb-2" required name="to">
          </div>

        
          <div class="col-md-6 container p-2">
            
            <h6 style="font-size:13px">Air Condition Fare</h6>
            <input type="number" value="{{$UpdateData['aircon_fare']}}" class="form-control mb-2" required name="airconfare">
            </div>
  
            <div class="col-md-6 container p-2">
              
              <h6 style="font-size:13px">Non-AirCondition Fare</h6>
              <input type="number" value="{{$UpdateData['non_aircon_fare']}}" class="form-control mb-2" required name="nonairconfare">
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
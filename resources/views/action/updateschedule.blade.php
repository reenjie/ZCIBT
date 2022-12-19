@extends('layouts.app', ['activePage' => 'schedule', 'title' => 'Update Schedule', 'navName' => 'Schedule', 'activeButton' => 'laravel'])

@section('content')
   
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'schedules')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                            <h4 class="card-title mt-3">Update Schedule</h4>
                           
                        </div>
                        <div class="card-body ">
                        <div class="container">
            <form action="{{route('update',['type'=>'schedule','id'=>$UpdateData['id']])}}" method="post">
                   @csrf
                            
            <div class="row">
                        <div class="col-md-6">
            <h6 style="font-size:13px">Set Schedule:</h6>
            <input type="date" class="form-control mb-2" value="{{$UpdateData['schedule']}}" name="schedule" placeholder="Bus Number" autofocus required>
          </div>
          <div class="col-md-6">
          <h6 style="font-size:13px">Set Status</h6>
        <select name="status" class="form-control" id="" required  value="{{$UpdateData['status']}}">
            @if($UpdateData['status'] == 0)
            <option value="0">Inactive</option>
            @else 

            <option value="1">Active</option>
            @endif
               
                <option value="0">Inactive</option>
                <option value="1">Active</option>
        </select>
          </div>

          <div class="col-md-6">
          <h6 style="font-size:13px">Departure</h6>
          <input type="time" class="form-control mb-2" required name="departure" required value="{{$UpdateData['departure']}}">
          </div>
          <div class="col-md-6">
          <h6 style="font-size:13px">Estimated Arrival</h6>
          <input type="time" class="form-control mb-2" required name="arrival" required value="{{$UpdateData['est_arrival']}}">
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
@extends('layouts.app', ['activePage' => 'schedules', 'title' => 'Add Schedule', 'navName' => 'Add Schedule', 'activeButton' => 'laravel'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'schedules')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                            <h4 class="card-title mt-3">Add Schedule</h4>
                           
                        </div>
                        <div class="card-body ">
                        <div class="container">
            <form action="{{route('Addschedule')}}" method="post">
                                @csrf
                            
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <select name="bustype" class="form-control" id="" required>

                                    <option value="">Select Bus Types</option>
                                    <option value="Rural Tours">Rural Tours</option>
                                    <option value="Ceres Tours">Ceres Tours</option>
                                    <option value="Lizamay">Lizamay</option>
                                </select>

                            </div>
          <div class="col-md-6">
            <h6 style="font-size:13px">Set Schedule:</h6>
            <input type="date" class="form-control mb-2" name="schedule" placeholder="Bus Number" autofocus required>
          </div>
          <div class="col-md-6">
          <h6 style="font-size:13px">Set Status</h6>
        <select name="status" class="form-control" id="" required>
                 <option value="">Select Status</option>
                <option value="0">Inactive</option>
                <option value="1">Active</option>
                <option value="2">Full</option>
        </select>
          </div>

          <div class="col-md-6">
          <h6 style="font-size:13px">Departure</h6>
          <input type="time" class="form-control mb-2" required name="departure" required>
          </div>
          <div class="col-md-6">
          <h6 style="font-size:13px">Estimated Arrival</h6>
          <input type="time" class="form-control mb-2" required name="arrival" required>
          </div>

          <div class="col-md-6">
            <h6 style="font-size:13px">Estimated Travel Time</h6>
            <input type="text" placeholder="Number of Hours or Minutes " class="form-control mb-2" name="esttraveltime" required name="arrival" required>
            </div>

            <div class="col-md-6">
                <h6 style="font-size:13px">Remarks</h6>
               <textarea name="remarks" class="form-control" placeholder="Put remarks here .." id="" style="height: 200px"></textarea>
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
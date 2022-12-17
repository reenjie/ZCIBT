@extends('layouts.app', ['activePage' => 'routes', 'title' => 'Add Bus Routes', 'navName' => 'Routes', 'activeButton' => 'laravel'])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-warning btn-sm " onclick="window.location.href='{{route('page.index', 'routes')}}' "><i class="fas fa-arrow-left"></i> Back</button>
                            <h4 class="card-title mt-3">Add Bus Routes</h4>
                           
                        </div>
                        <div class="card-body ">
                        <div class="container">
            <form action="{{route('AddRoutes')}}" method="post">
                                @csrf
                            
                        <div class="row">
          <div class="col-md-6">
            <h6 style="font-size:13px">From</h6>
            <input type="text" class="form-control mb-2" name="from" placeholder="From" autofocus required>
          </div>
          <div class="col-md-6">
          <h6 style="font-size:13px">To</h6>
          <input type="text" class="form-control mb-2" required name="to">
          </div>

          <div class="col-md-12 container p-2">
            
          <h6 style="font-size:13px">Fare</h6>
          <input type="number" class="form-control mb-2" required name="fare">
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
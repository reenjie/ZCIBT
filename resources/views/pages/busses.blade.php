@extends('layouts.app', ['activePage' => 'busses', 'title' => 'ZCIBT', 'navName' => 'Busses', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">All Busses</h4>
                            <p class="card-category">Manage Busses Informations</p>
                        </div>
                        <div class="card-body ">
                            <button class="btn btn-warning btn-sm">Add <i class="fas fa-plus-circle"></i></button>
                      <div class="table-responsive">
                      <table class="table table-striped">
  <thead class="">
    <tr class="table-danger" >
      <th scope="col" class="text-dark">Bus No</th>
      <th scope="col" class="text-dark">Seating Capacity</th>
      <th scope="col" class="text-dark">Company</th>
      <th scope="col" class="text-dark">Color</th>
      <th scope="col" class="text-dark">Seats</th>
      <th scope="col" class="text-dark">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="font-weight:bold">230h1</td>
      <td>35</td>
      <td>KingLong</td>
      <td>Red</td>
      <td>5 x 12</td>
      <td>
        
        <button class="btn btn-link text-success btn-sm"><i class="fas fa-edit"></i></button>
        <button class="btn btn-link text-danger ml-2  btn-sm"><i class="fas fa-trash-can"></i></button>
        
       
      </td>
    </tr>
 
  </tbody>
</table>
                      </div>

                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
@endsection
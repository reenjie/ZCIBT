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
                          
                       <button class="btn btn-warning btn-sm" onclick="window.location.href='{{route('page.index','addbus')}}' "  >Add <i class="fas fa-plus-circle"></i></button>
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
      <th scope="col" class="text-dark">Bus No</th>
      <th scope="col" class="text-dark">Seating Capacity</th>
      <th scope="col" class="text-dark">Company</th>
      <th scope="col" class="text-dark">Color</th>
      <th scope="col" class="text-dark">Seats</th>
      <th scope="col" class="text-dark">Action</th>
    </tr>
  </thead>
  <tbody>
    @php
      $data = DB::select('SELECT * FROM `buses`');
    @endphp

      @foreach($data as $item)
      <tr>
      <td style="font-weight:bold">{{$item->Bus_No}}</td>
      <td>{{$item->seating_capacity}}</td>
      <td>{{$item->company}}</td>
      <td>{{$item->color}}</td>
      <td>{{$item->per_column}} x {{$item->per_row}}</td>
      <td>
      <button class="btn btn-link text-secondary btn-sm" onclick="window.location.href='{{route('viewbus',['id'=>$item->id])}}' "><i class="fas fa-eye"></i></button>
        <button class="btn btn-link text-success btn-sm"><i class="fas fa-edit"></i></button>
        <button class="btn btn-link text-danger ml-2  btn-sm"><i class="fas fa-trash-can"></i></button>
        
       
      </td>
    </tr>
      @endforeach
 
 
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
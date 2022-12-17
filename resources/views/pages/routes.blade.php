@extends('layouts.app', ['activePage' => 'routes', 'title' => 'ZCIBT', 'navName' => 'Routes', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">All Routes</h4>
                            <p class="card-category">Manage Routes Informations</p>
                        </div>
                        <div class="card-body ">
                            @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{session()->get('success')}}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                           @endif

                        <button onclick="window.location.href='{{route('page.index','addroutes')}}' " class="btn btn-warning btn-sm">Add <i class="fas fa-plus-circle"></i></button>
                        <button class="btn btn-primary btn-sm">Fare Discounts <i class="fas fa-cogs"></i></button>
                        <div class="table-responsive">
                        <table class="table table-striped">
                    <thead class="">
                        <tr class="table-danger" >
                        <th scope="col" class="text-dark">From</th>
                        <th scope="col" class="text-dark">To</th>
                        <th scope="col" class="text-dark">Fare</th>
                        <th scope="col" class="text-dark">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $data = DB::select('SELECT * FROM `routes`');
                      @endphp
                  
                        
                        @if(count($data)>=1)
                        @foreach($data as $item)
                        <tr>
                            <td style="font-weight:bold">{{$item->from}}</td>
                            <td style="font-weight:bold">{{$item->to}}</td>
                            <td>&#8369; {{$item->fare}}</td>
                        
                    
                        {{--   --}}
                        <td>
                          <button onclick="window.location.href='{{route('edit',['type'=>'routes','id'=>$item->id,'data'=>$data ])}}' " class="btn btn-link text-success btn-sm"><i class="fas fa-edit"></i></button>
                          <button data-id="{{$item->id}}" class="btn btn-link text-danger ml-2  btn-sm delete"><i class="fas fa-trash-can"></i></button>
                          
                         
                        </td>
                      </tr>
                        @endforeach
                        @endif
                      
                    </tbody>
                    </table>

 @if(count($data)==0)
  <h6 style="text-align:center">
      <img src="{{asset('light-bootstrap/img/notfound.svg')}}" style="width: 300px" alt="">

    <br> <br>
    
    No Data Found..</h6>

    <br> <br>
@endif
                        </div>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>

    <script>
        $('.delete').click(function(){
          var id = $(this).data('id');
          swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able recover it and all data connected to this bus routes will be deleted!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
        window.location.href='{{route("delete",["type"=>"routes"])}}'+'&id='+id;
    }
  });
        })
      </script>
  
@endsection
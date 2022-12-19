@extends('layouts.app', ['activePage' => 'schedules', 'title' => 'ZCIBT', 'navName' => 'Schedules', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">All Schedules</h4>
                            <p class="card-category">Manage Travelling Schedules Informations</p>
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

                        <button onclick="window.location.href='{{route('page.index','addschedule')}}' " class="btn btn-warning btn-sm">Add <i class="fas fa-plus-circle"></i></button>

                        <div class="table-responsive">
                        <table class="table table-striped">
                    <thead class="">
                        <tr class="table-danger" >
                        <th scope="col" class="text-dark">Departure</th>
                        <th scope="col" class="text-dark">Estimate Arrival</th>
                        <th scope="col" class="text-dark">Schedule</th>
                        <th scope="col" class="text-dark">Status</th>
                        <th scope="col" class="text-dark">Created</th>
                        <th scope="col" class="text-dark">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $data = DB::select('SELECT * FROM `travel_schedules`');
                      @endphp
                  
                        
                        @if(count($data)>=1)
                        @foreach($data as $item)
                        <tr>
                        <td style="font-weight:bold">{{date('h:ia',strtotime($item->departure))}} </td>
                         <td style="font-weight:bold">{{date('h:ia',strtotime($item->est_arrival))}}</td>
                        <td >{{date('m/d/Y | F j,Y',strtotime($item->schedule))}}</td>
                      
                        <td >
                            @if($item->status == 0)
                            <span class="badge bg-danger">Inactive</span>
                            @else 
                            <span class="badge bg-success">Active</span>
                            @endif
                       
                        </td>
                        <td>{{date('F j,Y',strtotime($item->created_at))}}</td>
                    
                       
                        <td>
                          <button onclick="window.location.href='{{route('edit',['type'=>'schedule','id'=>$item->id,'data'=>$data ])}}' " class="btn btn-link text-success btn-sm"><i class="fas fa-edit"></i></button>
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
  text: "Once deleted, you will not be recover it and all data connected to this bus will be deleted!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      window.location.href='{{route("delete",["type"=>"schedule"])}}'+'&id='+id;
  }
});
      })
    </script>

@endsection
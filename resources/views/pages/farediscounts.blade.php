@extends('layouts.app', ['activePage' => 'farediscounts', 'title' => 'ZCIBT', 'navName' => 'Fare Discounts', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <button class="btn btn-secondary btn-sm" onclick="window.location.href='{{route('page.index', 'travelroutes')}}' ">back</button>
                            <h4 class="card-title">All Fare Discounts</h4>
                            <p class="card-category">Manage Discount Amounts</p>
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

                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">Add <i class="fas fa-plus-circle"></i></button>

      

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Fare Discounts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('addfarediscount')}}" method="post"> 
        @csrf
      <div class="modal-body">
        <h6>Title:</h6>
        <input type="text" class="form-control mb-2" name="title">

        <h6>Fare Discounts:</h6>
        <input type="number" class="form-control" name="fare">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
                    
                        <div class="table-responsive">
                        <table class="table table-striped">
                    <thead class="">
                        <tr class="table-danger" >
                        <th scope="col" class="text-dark">Title</th>
                        <th scope="col" class="text-dark">Discount</th>
                        <th scope="col" class="text-dark">Created</th>
                        <th scope="col" class="text-dark">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $data = DB::select('SELECT * FROM `fare_discounts`');
                      @endphp
                  
                        
                        @if(count($data)>=1)
                        @foreach($data as $item)
                        <tr>
                            <td style="font-weight:bold">{{$item->title}}</td>
                        
                            <td>{{$item->discount}} %</td>
                            <td>{{date('@h:ia F j,Y',strtotime($item->created_at))}}</td>
                    
                        {{--   --}}
                        <td>
                          <button class="btn btn-link text-success btn-sm" data-toggle="modal" data-target="#editModal{{$item->id}}"><i class="fas fa-edit"></i></button>
                        <!-- Modal -->
<div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Fare Discounts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('update',['type'=>'farediscount','id'=>$item->id])}}" method="post"> 
        @csrf
      <div class="modal-body">
        <h6>Title:</h6>
        <input type="text" class="form-control mb-2" name="title" value="{{$item->title}}">

        <h6>Fare Discounts:</h6>
        <input type="number" class="form-control" name="fare" value="{{$item->discount}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


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
        window.location.href='{{route("delete",["type"=>"farediscount"])}}'+'&id='+id;
    }
  });
        })
      </script>
  
@endsection
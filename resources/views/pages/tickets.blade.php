@extends('layouts.app', ['activePage' => 'tickets', 'title' => 'ZCIBT', 'navName' => 'Tickets', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <h4 class="card-title">All Sold Tickets</h4>
                            <p class="card-category">Tickets Informations</p>
                        </div>
                        <div class="card-body ">
                        <button class="btn btn-warning btn-sm">Add <i class="fas fa-plus-circle"></i></button>
                        <div class="table-responsive">
                        <table class="table table-striped">
                    <thead class="">
                        <tr class="table-danger" >
                        <th scope="col" class="text-dark">Ticket#</th>
                        <th scope="col" class="text-dark">Name</th>
                        <th scope="col" class="text-dark">From</th>
                        <th scope="col" class="text-dark">To</th>
                        <th scope="col" class="text-dark">Travel Schedule</th>
                        <th scope="col" class="text-dark">Bus No</th>
                        <th scope="col" class="text-dark">Seat</th>
                        <th scope="col" class="text-dark">Payment Status</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td style="font-weight:bold">23451</td>
                        <td style="font-weight:bold">Reenjay Caimor</td>
                        <td >Zamboanga City</td>
                        <td >Pagadian City</td>
                        <td >{{date('Fj,Y')}}</td>
                        <td >20122</td>
                        <td >
                        <button class="btn btn-link text-success btn-sm">VIEW </button>
                        </td>
                        <td>
                            <span class="badge bg-success">Paid</span>
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
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
                        <button class="btn btn-warning btn-sm">Add <i class="fas fa-plus-circle"></i></button>
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
                        <tr>
                         <td style="font-weight:bold">06:00 am</td>
                         <td style="font-weight:bold">03:00 pm</td>
                        <td >01/01/2022 | January 1,2022</td>
                      
                        <td >
                        <span class="badge bg-success">Active</span>
                        </td>
                        <td>{{date('Fj,Y')}}</td>
                       
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
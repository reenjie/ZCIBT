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
                        <button class="btn btn-warning btn-sm">Add <i class="fas fa-plus-circle"></i></button>
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
                        <tr>
                        <td style="font-weight:bold">Zamboanga City</td>
                        <td style="font-weight:bold">Pagadian City</td>
                        <td>&#8369; 570</td>
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
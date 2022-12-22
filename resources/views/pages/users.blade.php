@extends('layouts.app', ['activePage' => 'users', 'title' => 'ZCIBT', 'navName' => 'User Management', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Users</h6>
                        </div>
                        <div class="card-body">
                        <table class="table table-sm text-dark" style="font-size:14px">
                        <thead>
                            <tr class="table-danger ">
                            <th scope="col">Name</th>
                            <th scope="col">Contact Information</th>
                            <th scope="col">Address</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Status</th>
                            <th scope="col">Register Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $users = DB::select('select * from users');
                            @endphp

                            @foreach($users as $row)
                            @if($row->id == Auth::user()->id)

                            @else 
                            <tr>
                                <td>{{$row->firstname.' '.$row->middlename.' '.$row->lastname}}</td>
                                <td>
                                    <h6 style="font-size:11px">
                                        Email : {{$row->email}}
                                        <br>
                                        Contact # : {{$row->contact_no}}
                                    </h6>
                                </td>
                                <td>
                                    {{$row->address}}
                                </td>
                                <td>
                                    {{date('F j,Y',strtotime($row->birthdate))}}
                                </td>
                                <td>
                                 @if($row->vrfy == 0)
                                 <span class="badge badge-warning">Unverified</span>
                                 @else 
                                 <span class="badge badge-success">Verified</span>
                                 @endif
                               
                                </td>
                                <td>
                                    {{date('h:ia F j,Y',strtotime($row->created_at))}}
                                </td>
                            </tr>
                            @endif                
                            @endforeach
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
@endsection
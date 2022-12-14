@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'ZCIBT'])

@section('content')
    <div class="full-page section-image" data-color="red" data-image="{{asset('light-bootstrap/img/bghome.jpg')}}">
        <div class="content">
       
            <div class="container">
                <div class="row ">
                    <div class="col-md-6">
                      <h3 class="text-light">Zamboanga City Integrated Bus Terminal</h3>
                      <h6 class="text-light" style="font-weight:normal">Ticket Reservation System</h6>
                      <br>
                      <h4 class="text-light">
                        <button class="btn btn-warning" onclick="">Reserve now</button>
                        <button class="btn btn-info">About Us</button>

                      </h4>

                      <br>

                      <img src="{{asset('light-bootstrap/img/maps.svg')}}" class="w-100 mt-4" alt="">
                      <h4 class="text-light">Contact us</h4>
                      <ul class="list-group list-group-flush  text-light" style="font-size:13px">
                                        <li class="list-group-item bg-transparent">PLDT Landline | 062-975-2220</li>
                                        <li class="list-group-item bg-transparent">Globe Telecom | 0927-492-5002</li>
                                        <li class="list-group-item bg-transparent">Smart         | 0969-135-6410</li>
                                       
                                        </ul>

                    </div>
                    <div class="col-md-6 mt-4">
                    <h3 class="text-light">Travels</h3>
                      <div class="card card-hidden bg-transparent mb-2">
                        <div class="card-body">
                         
                        <h4 class="text-light">Routes</h4>
                    <table class="table text-light ">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            </tr>
                        </tbody>
                        </table>
                        </div>
                      </div>

                      <div class="card card-hidden bg-transparent  mb-2">
                        <div class="card-body">
                        <h4 class="text-light">Schedules</h4>
                    <table class="table text-light">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
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

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush
@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'ZCIBT'])

@section('content')
    <div class="full-page section-image" data-color="red" data-image="{{asset('light-bootstrap/img/bghome.jpg')}}">
        <div class="content">
       
            <div class="container">
                <div class="row ">
                 <div class="col-md-2"></div>
                 <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            asd
                        </div>
                    </div>
                 </div>
                 <div class="col-md-2"></div>
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
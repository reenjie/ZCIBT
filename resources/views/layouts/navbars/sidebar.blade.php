<div class="sidebar"  data-color="red" data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxbvyHGKChKOXdnjT1c9VI9bjRGJP1RivcwQ&usqp=CAU">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                {{ __("ZCIBT") }}
                <br>
                <span style="font-size:11px;">Zamboanga City Integrated Bus Terminal</span>
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>{{ __("Dashboard") }}</p>
                </a>
            </li>
           
       <!--      <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#laravelExamples" @if($activeButton =='laravel') aria-expanded="true" @endif>
                    <i>
                        <img src="{{ asset('light-bootstrap/img/laravel.svg') }}" style="width:25px">
                    </i>
                    <p>
                        {{ __('Laravel example') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if($activeButton =='laravel') show @endif" id="laravelExamples">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'user') active @endif">
                            <a class="nav-link" href="{{route('profile.edit')}}">
                                <i class="nc-icon nc-single-02"></i>
                                <p>{{ __("User Profile") }}</p>
                            </a>
                        </li>
                        <li class="nav-item @if($activePage == 'user-management') active @endif">
                            <a class="nav-link" href="{{route('user.index')}}">
                                <i class="nc-icon nc-circle-09"></i>
                                <p>{{ __("User Management") }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->

            <li class="nav-item @if($activePage == 'busses') active @endif">
                <a class="nav-link" href="{{route('page.index', 'busses')}}">
                    <i class="nc-icon nc-bus-front-12"></i>
                    <p>{{ __("Busses") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'routes') active @endif">
                <a class="nav-link" href="{{route('page.index', 'routes')}}">
                    <i class="nc-icon nc-square-pin"></i>
                    <p>{{ __("Routes") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'schedules') active @endif">
                <a class="nav-link" href="{{route('page.index', 'schedules')}}">
                    <i class="nc-icon nc-watch-time"></i>
                    <p>{{ __("Schedules") }}</p>
                </a>
            </li>

            <li class="nav-item @if($activePage == 'trips') active @endif">
                <a class="nav-link" href="{{route('page.index', 'trips')}}">
                    <i class="nc-icon nc-compass-05"></i>
                    <p>{{ __("Trips") }}</p>
                </a>
            </li>


            <li class="nav-item @if($activePage == 'tickets') active @endif">
                <a class="nav-link" href="{{route('page.index', 'tickets')}}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>{{ __("Tickets") }}</p>
                </a>
            </li>
           
            @if(Auth::user()->user_type !=3 && Auth::user()->user_type !=1)
            <li class="nav-item @if($activePage == 'users') active @endif">
                <a class="nav-link" href="{{route('page.index', 'users')}}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>{{ __("Users") }}</p>
                </a>
            </li>

            @endif
        
        </ul>
    </div>
</div>

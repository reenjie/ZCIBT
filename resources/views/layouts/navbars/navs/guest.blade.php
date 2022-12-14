<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="/">{{ __('ZCIBT') }}

           |
            <span style="font-size:11px">Zamboanga City Integrated Bus Terminal</span>

            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav" style="font-size:13px">
               
                <li class="nav-item @if($activePage == 'register') active @endif">
                    <a href="{{ route('register') }}" class="nav-link">
                        {{ __('Register') }}
                    </a>
                </li>
                <li  class="nav-item @if($activePage == 'login') active @endif">
                    <a href="{{ route('login') }}" class="nav-link">
                       {{ __('Login') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
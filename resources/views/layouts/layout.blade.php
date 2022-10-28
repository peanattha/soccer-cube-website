<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Soccer Cube</title>
    <link rel="icon" type="image/jpg" href="../img/Soccer_Cube_Logo.jpg" />
    <link type="text/css" rel="stylesheet" href="../css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</head>

<body>
    @section('header')
        @if (Route::has('login'))
            @auth
                @if (Auth::user()->is_admin == 1)
                    <header class="d-flex justify-content-center py-2 bg-light">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link @yield('home')"
                                    aria-current="page">Home</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('adminDashboard') }}"
                                    class="nav-link @yield('adminDashboard')">Dashboard</a></li>
                            <li class="nav-item"><a href="{{ route('stadiumsAdmin') }}"
                                    class="nav-link @yield('stadiumsAdmin')">Stadiums</a></li>
                            <li class="nav-item">
                                <a href="{{ route('cancelReserveAdmin') }}" class="nav-link @yield('cancelReserveAdmin')">Cancel
                                    Reservation</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reserveAdmin') }}" class="nav-link @yield('reserveAdmin')">Confirm
                                    Reserve</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.show') }}" class="nav-link @yield('profile')">Profile</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="nav-link"
                                        onclick="event.preventDefault();                                                                                     this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </header>
                @else
                    <header class="d-flex justify-content-center py-2 bg-light">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link @yield('home')"
                                    aria-current="page">Home</a>
                            </li>
                            <li class="nav-item"><a href="{{ route('reserved') }}"
                                    class="nav-link @yield('reserved')">Reserved</a></li>
                            <li class="nav-item"><a href="{{ route('stadiums') }}"
                                    class="nav-link @yield('stadiums')">Stadiums</a></li>
                            <li class="nav-item">
                                <a href="{{ route('profile.show') }}" class="nav-link @yield('profile')">Profile</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="nav-link"
                                        onclick="event.preventDefault();                                                                                     this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </header>
                @endif
            @else
                <header class="d-flex justify-content-center py-2 bg-light">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="/" class="nav-link  @yield('home')" aria-current="page">Home</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link  @yield('login')">Login</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('register') }}"
                                class="nav-link  @yield('register')">Register</a>
                        </li>
                    </ul>
                </header>
            @endauth
        @endif
    @show
    @section('content')
    @show
</body>

</html>

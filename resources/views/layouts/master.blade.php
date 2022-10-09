<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Soccer Cube</title>
    <link rel="icon" type="image/jpg" href="../img/Soccer_Cube_Logo.jpg" />
    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
</head>

<body>
    @section('header')
        @if (Route::has('login'))
            <div>
                @auth
                    @if (Auth::user()->is_admin == 1)
                        <header class="header">
                            <div class="subHeader">
                                <div>
                                    <a href="{{ route('home') }}">Soccer Cube</a>
                                </div>
                                <div class="menu">
                                    <a href="{{ route('home') }}">Home</a>
                                    <a href="{{ route('adminDashboard') }}">Dashboard</a>
                                    <a href="{{ route('stadiumsAdmin') }}">Stadiums</a>
                                    <button id="dropdownButton" data-dropdown-toggle="dropdown"
                                        class="text-white font-medium rounded-lg text-base px-4 py-2.5 text-center inline-flex items-center"
                                        type="button">Reserve<svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg></button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown"
                                        class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                        <ul class="py-1" aria-labelledby="dropdownButton">
                                            <li class="text-drop">
                                                <a href="{{ route('cancelReserveAdmin') }}"
                                                    class="block py-2 px-4 text-sm dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Cancel
                                                    Reservation</a>
                                            </li>
                                            <li class="text-drop">
                                                <a href="{{ route('reserveAdmin') }}"
                                                    class="block py-2 px-4 text-sm dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Confirm
                                                    Reserve</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <button id="dropdownButton" data-dropdown-toggle="dropdown1"
                                        class="text-white font-medium rounded-lg text-base px-4 py-2.5 text-center inline-flex items-center"
                                        type="button">{{ Auth::user()->firstname }}<svg class="ml-2 w-4 h-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg></button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown1"
                                        class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                        <ul class="py-1" aria-labelledby="dropdownButton">
                                            <li class="text-drop">
                                                <a href="{{ route('profile.show') }}"
                                                    class="block py-2 px-4 text-sm dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
                                            </li>
                                            <li class="text-drop">
                                                <form method="POST" action="{{ route('logout') }}" class="block text-sm">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                        class="block py-2 px-4 text-sm dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                        onclick="event.preventDefault();                                                                                     this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </header>
                    @else
                        <header class="header">
                            <div class="subHeader">
                                <div>
                                    <a href="{{ route('home') }}">Soccer Cube</a>
                                </div>
                                <div class="menu">
                                    <a href="{{ route('home') }}">Home</a>
                                    <a href="{{ route('stadiums') }}">Stadiums</a>
                                    <a href="{{ route('reserved') }}">Reserved</a>
                                    <button id="dropdownButton" data-dropdown-toggle="dropdown"
                                        class="text-white font-medium rounded-lg text-base px-4 py-2.5 text-center inline-flex items-center"
                                        type="button">{{ Auth::user()->firstname }}<svg class="ml-2 w-4 h-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg></button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown"
                                        class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:text-white dark:bg-gray-800 dark:border-gray-700">
                                        <ul class="py-1" aria-labelledby="dropdownButton">
                                            <li class="text-drop">
                                                <a href="{{ route('profile.show') }}"
                                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
                                            </li>
                                            <li class="text-drop">
                                                <form method="POST" action="{{ route('logout') }}" class="block text-sm">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                    class="block py-2 px-4 text-sm dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                        onclick="event.preventDefault();                                                                                     this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </header>
                    @endif
                @else
                    <header class="header">
                        <div class="subHeader">
                            <div>
                                <a href="/" class="logo">Soccer Cube</a>
                            </div>
                            <div class="menu">
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}">Register</a>
                            </div>
                        </div>
                    </header>
                @endauth
            </div>
        @endif
    @show

    @section('wallpaper')
        <section class="section">
            <div class="wallpaper-home">
                <img src="@yield('srcImg')" alt="Soccer Cube" id="imgHome" class="imgHome">
            @section('content-home')

            @show
        </div>
        @section('content')

        @show
    </section>
@show
@section('contentner')
@show
</body>

</html>

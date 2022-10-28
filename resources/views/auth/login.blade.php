@extends('layouts.layout')

@section('title', 'Login')

@section('login', 'active')

<link type="text/css" rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/login.css">
<link href="/css/app.css" rel="stylesheet">

@section('srcImg', './img/Soccer_Cube_1.png')

@section('content')
    <div class="text-login">
        <h3>Scooer Cube Login</h3>
        <div class="">
            <x-guest-layout>
                <x-jet-validation-errors class="mb-4" />
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="emailUsername">Email</label>
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" placeholder="Email" required autofocus />
                    </div>

                    <div class="mt-4">
                        <label for="password">Password </label>
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" placeholder="Password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4 remAndSubm">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button class="subm">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </x-guest-layout>
        </div>
    </div>
@endsection

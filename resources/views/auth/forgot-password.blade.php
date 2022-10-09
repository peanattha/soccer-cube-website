@extends('layouts.master')

@section('title', 'Forgot your password')
<link type="text/css" rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/forgotPass.css">

@section('srcImg', './img/Soccer_Cube_1.png')

@section('content')
    <div class="text-login">
        <h3>Scooer Cube <br> Forgot your password </h3>
        <div class="container">
            <x-guest-layout>
                <x-jet-authentication-card>
                    <div class="mb-4 text-sm text-white">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="block">
                            <x-jet-label for="email" value="{{ __('Email') }}" class="text-white" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button class="subm">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </x-jet-authentication-card>
            </x-guest-layout>
        </div>
    </div>
@endsection

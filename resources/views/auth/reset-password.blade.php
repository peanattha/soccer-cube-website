@extends('layouts.master')

@section('title', 'Forgot your password')
<link type="text/css" rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/login.css">

@section('srcImg', '../img/Soccer_Cube_1.png')

@section('content')
    <div class="text-login">
        <h3>Scooer Cube <br> Reset Password </h3>
        <div class="container ">
            <x-guest-layout>
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="block">
                        <x-jet-label for="email" value="{{ __('Email') }}" class="text-white" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $request->email)" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" class="text-white" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"
                            class="text-white" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button class="subm">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </x-guest-layout>

        </div>
    </div>
@endsection

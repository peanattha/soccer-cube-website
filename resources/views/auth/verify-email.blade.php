@extends('layouts.master')

@section('title', 'Verify Your Email')
<link type="text/css" rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/verify.css">

@section('srcImg', '../img/Soccer_Cube_1.png')

@section('content')
    <div class="text-login">
        <h3>Scooer Cube <br> Verify Your Email </h3>
        <div class="container ">
            <x-guest-layout class="conten-layout">
                <div class="mb-4 text-sm text-white">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 flex  ">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button class="subm" type="submit">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="subm1" type="submit" class="underline text-sm text-white">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </x-guest-layout>
        </div>
    </div>
@endsection

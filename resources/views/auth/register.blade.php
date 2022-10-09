@extends('layouts.master')

@section('title', 'Register')
<link type="text/css" rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/login.css">
<link href="/css/app.css" rel="stylesheet">

@section('srcImg', './img/Soccer_Cube_1.png')

@section('content')
    <div class="text-login">
        <h3>Scooer Cube Register </h3>
        <div class="container">
            <x-guest-layout>
                <x-jet-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mt-4">
                        <label for="">Firstname</label>
                        <x-jet-input id="firstname" class="block mt-1 w-full" type="text" name="firstname"
                            :value="old('firstname')" required placeholder="Name" autofocus autocomplete="firstname" />
                    </div>

                    <div class="mt-4">
                        <label for="">Lastname</label>
                        <x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname"
                            :value="old('lastname')" required placeholder="Lastname" autofocus autocomplete="lastname" />
                    </div>

                    <div class="mt-4">
                        <label for="">Email</label>
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            placeholder="Email" required />
                    </div>

                    <div class="mt-4">
                        <label for="">Password</label>
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            placeholder="Password" autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <label for="">Confirm Password</label>
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" placeholder="Confirm Password" required
                            autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms" />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4 remAndSubm">
                        <a href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button class="subm">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </x-guest-layout>

        </div>
    </div>
@endsection
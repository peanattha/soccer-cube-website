@extends('layouts.layout')

@section('title', 'Profile')

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/profile.css">
<script src="../js/nav.js"></script>
<link href="/css/app.css" rel="stylesheet">

@section('content')
    <div class="detailProfile">
        <div class="container">
            <x-guest-layout>
                <x-app-layout>
                    @if ($isAdmin == 1)
                        <x-jet-action-section>
                            <x-slot name="title">
                                {{ __('Add Admin') }}
                            </x-slot>

                            <x-slot name="description">
                                {{ __('Add Admin Soccer Cube.') }}
                            </x-slot>

                            <x-slot name="content">
                                <div class="max-w-xl text-sm text-gray-600">
                                    {{ __('Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, est. Dolor deleniti possimus, dicta itaque distinctio tenetur necessitatibus totam repudiandae, numquam rerum fugit perferendis explicabo reprehenderit corrupti consequatur. Magni, ea.') }}
                                </div>
                                <div class="mt-5">
                                    <div class="flex flex-col">
                                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                                                <div class="overflow-hidden shadow-md sm:rounded-lg">
                                                    <table class="w-full">
                                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-black uppercase ">
                                                                    Name
                                                                </th>
                                                                <th scope="col"
                                                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-black uppercase ">
                                                                    Email
                                                                </th>
                                                                <th scope="col"
                                                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-black uppercase ">
                                                                    Delete Admin
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($admins as $admin)
                                                                <tr
                                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                    <td
                                                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                        {{ $admin->firstname }} {{ $admin->lastname }}
                                                                    </td>
                                                                    <td
                                                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                        {{ $admin->email }}
                                                                    </td>
                                                                    <td
                                                                        class="py-4 px-6 text-sm font-medium text-center whitespace-nowrap">
                                                                        <a href="{{ route('deleteAdmin', ['id' => $admin->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to delete admin {{ $admin->firstname }} {{ $admin->lastname }} ?')"
                                                                            class="text-red-600 dark:text-red-600 hover:underline">Delete
                                                                            Admin</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <form action="{{ route('addAdmin') }}" method="POST">
                                        @csrf
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" name="email" type="text" class="mt-1 block w-full"
                                            autocomplete="email" />
                                        <br>
                                        <x-jet-button>
                                            {{ __('Add Admin') }}
                                        </x-jet-button>
                                    </form>
                                </div>
                            </x-slot>
                        </x-jet-action-section>

                        <x-jet-section-border />
                    @endif


                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')

                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.update-password-form')
                        </div>

                        <x-jet-section-border />
                    @endif

                    @if (Auth::user()->is_admin == 1)
                        <x-jet-action-section>
                            <x-slot name="title">
                                {{ __('Book Bank') }}
                            </x-slot>

                            <x-slot name="description">
                                {{ __('Book Bank Detail.') }}
                            </x-slot>

                            <x-slot name="content">
                                <div class="max-w-xl text-sm text-gray-600">
                                    {{ __('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo iste in, reprehenderit beatae maiores nobis quo numquam adipisci asperiores? Vero maiores, rem illo tempora temporibus necessitatibus facilis optio ipsam soluta?.') }}
                                </div>
                                <div class="mt-5">
                                    @if ($banks->count() == 0)
                                        <form action="{{ route('bank') }}" method="POST">
                                            @csrf
                                            <x-jet-label for="bankid" value="{{ __('Bank ID') }}" />
                                            <x-jet-input id="bankid" name="bankid" type="text"
                                                class="mt-1 block w-full" autocomplete="bankid" />

                                            <x-jet-label for="firstname" value="{{ __('Firstname') }}" />
                                            <x-jet-input id="firstname" name="firstname" type="text"
                                                class="mt-1 block w-full" autocomplete="firstname" />

                                            <x-jet-label for="lastname" value="{{ __('Lastname') }}" />
                                            <x-jet-input id="lastname" name="lastname" type="text"
                                                class="mt-1 block w-full" autocomplete="lastname" />

                                            <x-jet-label for="bankname" value="{{ __('Bank Name') }}" />
                                            <select id="bankname" name="bankname"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                <option selected disabled hidden>Please select Bank</option>
                                                @foreach ($bank_details as $bank_detail)
                                                    <option value="{{ $bank_detail->id }}">
                                                        {{ $bank_detail->bank_name }}</option>
                                                @endforeach
                                            </select>
                                            <br>

                                            <x-jet-button>
                                                {{ __('Save') }}
                                            </x-jet-button>
                                        </form>
                                    @else
                                        @foreach ($banks as $bank)
                                            <form action="{{ route('update_bank', ['id' => $bank->id]) }}" method="POST">
                                                @csrf
                                                <x-jet-label for="bankid" value="{{ __('Bank ID') }}" />
                                                <x-jet-input id="bankid" name="bankid" type="text"
                                                    class="mt-1 block w-full" autocomplete="bankid"
                                                    value="{{ $bank->account_number }}" />

                                                <x-jet-label for="firstname" value="{{ __('Firstname') }}" />
                                                <x-jet-input id="firstname" name="firstname" type="text"
                                                    class="mt-1 block w-full" autocomplete="firstname"
                                                    value="{{ $bank->firstname }}" />

                                                <x-jet-label for="lastname" value="{{ __('Lastname') }}" />
                                                <x-jet-input id="lastname" name="lastname" type="text"
                                                    class="mt-1 block w-full" autocomplete="lastname"
                                                    value="{{ $bank->lastname }}" />

                                                <x-jet-label for="bankname" value="{{ __('Bank Name') }}" />
                                                <select id="bankname" name="bankname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                                    <option value="{{ $bank->bank_detail->id }}" selected hidden>
                                                        {{ $bank->bank_detail->bank_name }}</option>
                                                    @foreach ($bank_details as $bank_detail)
                                                        @if ($bank->bank_detail_id != $bank_detail->id)
                                                            <option value="{{ $bank_detail->id }}">
                                                                {{ $bank_detail->bank_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <br>
                                                <x-jet-button>
                                                    {{ __('Save') }}
                                                </x-jet-button>
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-jet-action-section>
                        <x-jet-section-border />
                    @endif




                    <x-jet-action-section>
                        <x-slot name="title">
                            {{ __('Point') }}
                        </x-slot>

                        <x-slot name="description">
                            {{ __('Your Point.') }}
                        </x-slot>

                        <x-slot name="content">
                            <div class="max-w-xl text-sm text-gray-600">
                                {{ __('Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo iste in, reprehenderit beatae maiores nobis quo numquam adipisci asperiores? Vero maiores, rem illo tempora temporibus necessitatibus facilis optio ipsam soluta?') }}
                            </div>
                            <div class="mt-5">
                                @if ($point == null)
                                    <span class="mb-2 text-xl tracking-tight text-green-600">0</span> Point
                                @else
                                    <span class="mb-2 text-xl tracking-tight text-green-600">{{ $point }}</span>
                                    Point
                                @endif
                            </div>
                        </x-slot>

                    </x-jet-action-section>

                    <x-jet-section-border />

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.two-factor-authentication-form')
                        </div>

                        <x-jet-section-border />
                    @endif

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <x-jet-section-border />

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif
                </x-app-layout>
            </x-guest-layout>
        </div>
    </div>
@endsection

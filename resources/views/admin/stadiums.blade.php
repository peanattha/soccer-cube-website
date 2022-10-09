@extends('layouts.master')

@section('title', 'Stadium')
<link rel="stylesheet" href="./css/style.css">
<link type="text/css" rel="stylesheet" href="../css/stadium.css">
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />
<link href="/css/app.css" rel="stylesheet">

@section('srcImg', './img/Soccer_Cube_1.png')

@section('content')
    <div class="stadiums">
        <div class="text-center">
            <a href="{{ route('showInsertStadium') }}"
                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:bg-green-800">
                Insert Stadium
                <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <div class="stadiumsAdmin">
            @foreach ($stadiums as $stadium)
                <div
                    class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-t-lg"
                        src="data:image/png;base64,{{ chunk_split(base64_encode($stadium->stadium_img)) }}" alt="">
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $stadium->stadium_name }}</h5>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">ราคา
                            {{ $stadium->stadium_price }} บาท/ชม.</h5>
                        <p class="mb-3 text-gray-700 dark:text-gray-400">{{ $stadium->stadium_detail }}</p>
                        <a href="{{ route('showEditStadium', ['id' => $stadium->id]) }}"
                            class="inline-flex items-center py-2 px-3 text-sm text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 ">
                            Edit Stadium
                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="{{ route('deleteStadium', ['id' => $stadium->id]) }}"
                            onclick="return confirm('Are you sure you want to delete stadium {{ $stadium->stadium_name }} ?')"
                            class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:bg-red-800">
                            Delete Stadium
                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    @endsection

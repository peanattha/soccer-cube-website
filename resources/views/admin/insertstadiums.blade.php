@extends('layouts.master')

@section('title', 'Stadium')

<link rel="stylesheet" href="./css/style.css">
<link type="text/css" rel="stylesheet" href="../css/stadium.css">
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />
<link href="/css/app.css" rel="stylesheet">

@section('srcImg', './img/Soccer_Cube_1.png')

@section('content')
    <div class="stadiums">
        <form action="{{ route('insertStadium') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="base-input" class="block mb-2 text-sm font-medium text-white ">Name Stadium</label>
                <input type="text" id="base-input" name="name" required
                    class="bg-gray-50 border border-gray-300 text-sm rounded-lg  block w-full p-2.5">
            </div>
            <div class="mb-6">
                <label for="base-input" class="block mb-2 text-sm font-medium text-white ">Price</label>
                <input type="text" id="base-input" name="price" pattern="[0-9]{1,}" required
                    class="bg-gray-50 border border-gray-300 text-sm rounded-lg  block w-full p-2.5">
            </div>
            <div class="mb-6">
                <label for="message" class="block mb-2 text-sm font-medium text-white ">Stadium Details</label>
                <textarea id="message" rows="4" name="detail" required
                    class="bg-gray-50 border border-gray-300 text-sm rounded-lg  block w-full p-2.5"
                    placeholder="Stadium Detail..."></textarea>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-white" for="user_avatar">Upload
                    Image</label>
                <input required
                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help" id="user_avatar" name="img" type="file">
            </div>
            <div class="mb-6">
                <input type="submit" value="Insert Stadium"
                    class="inline-flex justify-center items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:bg-green-800">
            </div>
        </form>
    </div>
@endsection

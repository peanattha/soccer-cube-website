@extends('layouts.layout')

@section('title', 'Home')

@section('home', 'active')

<link type="text/css" rel="stylesheet" href="../css/stadium.css">
<link type="text/css" rel="stylesheet" href="../css/app.css">

@section('content')
    <div class="container">
        <section class="py-2 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Soccer Cube</h1>
                    <p class="lead text-muted">สนามฟุตบอลหญ้าเทียมให้เช่า ในร่ม และกลางแจ้ง หลังวัดป่าอดุลยาราม
                        ใกล้มหาวิทยาลัยขอนแก่น.</p>
                    <p>
                        <a href="{{ route('stadiums') }}" class="btn btn-primary my-2">Reserve Now</a>
                    </p>
                </div>
            </div>
        </section>
        <div class="stadiumsUser">
            @foreach ($stadiums as $stadium)
                <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md ">
                    <img class="rounded-t-lg" src="data:image/png;base64,{{ chunk_split(base64_encode($stadium->stadium_img)) }}"
                        alt="">
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                            {{ $stadium->stadium_name }}</h5>
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">ราคา
                            {{ $stadium->stadium_price }} บาท/ชม.</h5>
                        <p class="mb-3 text-gray-700 ">{{ $stadium->stadium_detail }}</p>

                        <form action="{{ route('stadiumDetail') }}" method="GET" class="btn-form">
                            <button type="submit" value="{{ $stadium->id }}" name="idStadium"
                                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 ">
                                View Stadium {{ $stadium->id }}
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

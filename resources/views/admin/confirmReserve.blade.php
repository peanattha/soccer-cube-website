@extends('layouts.layout')

@section('title', 'Reserve Admin')

<link rel="stylesheet" href="./css/style.css">
<link type="text/css" rel="stylesheet" href="../css/reserved.css">
<script src="../js/nav.js"></script>
<link href="/css/app.css" rel="stylesheet">

@section('content')
    <div class="reserved">
        @if ($reserves->count() == 0)
            <p class="txton">ไม่มีรายการการจอง</p>
        @else
            @foreach ($reserves as $reserve)
                <div class="flex flex-row bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $reserve->stadium->stadium_name }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">ชื่อลูกค้า :
                            {{ $reserve->user->firstname }} {{ $reserve->user->lastname }}</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">ราคา :
                            {{ $reserve->total_price_discount }}
                            บาท
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">วันที่จอง :
                            {{ $reserve->reserve_date }}
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">เวลา :
                            {{ $reserve->time_start }}น. -
                            {{ $reserve->time_end }}น.</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">สถานะการจ่ายเงิน :
                            {{ $reserve->payment->payment_status }}</p>
                        <a href="{{ route('confirmReserve', ['id' => $reserve->id]) }}" onclick="return confirm('Are you sure you want to confirmed reserve ?')"
                            class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:bg-green-800">
                            Confirmed Reserve
                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="{{ route('confirmedCancelAdmin', ['id' => $reserve->id]) }}"
                            onclick="return confirm('Are you sure you want to confirmed cancel ?')"
                            class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg">
                            Confirmed Cancle
                            <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <img class="rounded-lg m-0" style="height: 300px"
                            src="data:image/png;base64,{{ chunk_split(base64_encode($reserve->slip_img)) }}" alt="">
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

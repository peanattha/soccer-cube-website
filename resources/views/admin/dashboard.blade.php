@extends('layouts.master')

@section('title', 'Stadium')

<link rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/dashboardAdmin.css">
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />
<link href="/css/app.css" rel="stylesheet">

@section('srcImg', '../img/Soccer_Cube_1.png')

@section('content')
    <div class="dashboard">
        <div class="flex justify-center">
            <form action="{{ route('dashboardFilter') }}" method="GET" class="filter">
                <select name="filter" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:text-white dark:bg-gray-800 dark:border-gray-700">
                    <option value="" selected hidden>เลือกตัวกรอง</option>
                    <option value="1">Week</option>
                    <option value="2">Month</option>
                    <option value="3">Cancle</option>
                    <option value="4">reserve complete</option>
                    <option value="5">All</option>
                </select>
            </form>
            <div
                class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">จำนวนการยกเลิก</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $count_cancel }} ครั้ง</p>
            </div>
            <div
                class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">จำนวนจองทั้งหมด</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $count_reserve }} ครั้ง</p>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="flex flex-col h-1/2">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full overflow-x-auto">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            ชื่อลูกค้า
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            สนามที่จอง
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            วันที่ที่จอง
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            เริ่มเวลา
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            หมดเวลา
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            ราคา
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reserves as $reserve)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $reserve->user->firstname }} {{ $reserve->user->lastname }}
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->stadium->stadium_name }}</p>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->reserve_date }}</p>
                                            </td>

                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->time_start }}</p>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->time_end }}</p>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->total_price_discount }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-das">
                <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายได้รวม</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $price }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายได้ต่อวัน</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $price_day }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายได้ต่อสัปดาห์</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $price_week }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายได้ต่อเดือน</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $price_month }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายได้ต่อปี</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $price_year }} บาท</p>
                </div>
            </div>
        </div>
    </div>
@endsection

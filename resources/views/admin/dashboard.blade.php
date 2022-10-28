@extends('layouts.layout')

@section('title', 'Stadium')

<link rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/dashboardAdmin.css">
<link type="text/css" rel="stylesheet" href="../css/app.css">
<link href="/css/app.css" rel="stylesheet">

@section('content')
    <div class="dashboard">
        <div class="flex justify-center">
            <form action="{{ route('dashboardFilter') }}" method="GET" class="filter">
                <select name="filter" onchange="this.form.submit()"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5  0">
                    <option value="" selected hidden>เลือกตัวกรอง</option>
                    <option value="1">Week</option>
                    <option value="2">Month</option>
                    <option value="3">Cancle</option>
                    <option value="4">reserve complete</option>
                    <option value="5">All</option>
                </select>
            </form>
            <div
                class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md ">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">จำนวนการยกเลิก</h5>
                <p class="mb-3 font-normal text-gray-700 ">{{ $count_cancel }} ครั้ง</p>
            </div>
            <div
                class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">จำนวนจองทั้งหมด</h5>
                <p class="mb-3 font-normal text-gray-700 ">{{ $count_reserve }} ครั้ง</p>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="flex flex-col h-1/2">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full overflow-x-auto">
                                <thead class="bg-gray-100 ">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase 0">
                                            ชื่อลูกค้า
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase 0">
                                            สนามที่จอง
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase 0">
                                            วันที่ที่จอง
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase 0">
                                            เริ่มเวลา
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase 0">
                                            หมดเวลา
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase 0">
                                            ราคา
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reserves as $reserve)
                                        <tr class="bg-white border-b">
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                                {{ $reserve->user->firstname }} {{ $reserve->user->lastname }}
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap 0">
                                                {{ $reserve->stadium->stadium_name }}</p>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap 0">
                                                {{ $reserve->reserve_date }}</p>
                                            </td>

                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap 0">
                                                {{ $reserve->time_start }}</p>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap 0">
                                                {{ $reserve->time_end }}</p>
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap 0">
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
                <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md 0">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">รายได้รวม</h5>
                    <p class="mb-3 font-normal text-gray-700 0">{{ $price }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md 0">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">รายได้ต่อวัน</h5>
                    <p class="mb-3 font-normal text-gray-700 0">{{ $price_day }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md 0">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">รายได้ต่อสัปดาห์</h5>
                    <p class="mb-3 font-normal text-gray-700 0">{{ $price_week }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md 0">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">รายได้ต่อเดือน</h5>
                    <p class="mb-3 font-normal text-gray-700 0">{{ $price_month }} บาท</p>
                </div>
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md 0">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">รายได้ต่อปี</h5>
                    <p class="mb-3 font-normal text-gray-700 0">{{ $price_year }} บาท</p>
                </div>
            </div>
        </div>
    </div>
@endsection

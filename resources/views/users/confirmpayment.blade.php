@extends('layouts.master')

@section('title', 'Payment')

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />
<script src="https://unpkg.com/flowbite@1.3.4/dist/datepicker.js"></script>
<link rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/payment.css">
<script src="../js/nav.js"></script>

@section('srcImg', '../img/Soccer_Cube_1.png')

@section('content')

    <div class="confirm_payment">
        <form action="{{ route('confirmPayment', ['id' => $reserves->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="payment-d container flex-auto w-screen mx-2">
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                        จำนวนเงินที่ต้องจ่าย</h5>
                    <p class="font-thin text-2xl dark:text-white">{{ $reserves->total_price_discount }} บาท</p>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                        รายละเอียดการชำระเงิน</h5>
                    <p class="font-thin text-2xl dark:text-white">Order No: {{$reserves->id}}</p>
                    <p class="font-thin text-sm dark:text-white">ต้องโอนภายใน {{ $reserves->reserve_date }}</p>
                    <p class="font-thin text-sm dark:text-white">หากเลยเวลากรุณาทำรายการใหม่</p>
                    <p class="font-thin text-sm dark:text-white">QR CODE</p>
                    <img src="../img/QR.jpg" alt="">
                    <p class="font-thin text-sm dark:text-white">ใช้สำหรับจองสนามบนเว็บไซต์เท่านั้น</p>
                    <br>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="user_avatar">
                        อัพโหดลรูปภาพหลักฐานการโอนเงิน
                    </label>
                    <input name="userPayment_img"
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="user_avatar_help" id="user_avatar" type="file" required>
                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>
                    <p class="font-thin text-sm dark:text-white">หลังจากโอนเงินแล้วให้กดปุ่มยืนยัน</p>

                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help"></div>
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        ยืนยัน
                    </button>
                </div>
        </form>
        <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">รายละเอียดการจอง</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology
                acquisitions of 2021 so far, in reverse chronological order.</p>
            <div class="flex flex-col">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class=" shadow-md sm:rounded-lg ">
                            <table class="min-w-full">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            <p class="font-black dark:text-white">หัวข้อ</p>
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            <p class="font-black dark:text-white">รายละเอียด</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p class="font-semibold dark:text-white">วันที่จอง</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $reserves->reserve_date }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p class="font-semibold dark:text-white">เวลา</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <!-- 17:00 - 19:00 -->
                                            {{ $reserves->time_start }} - {{ $reserves->time_end }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p class="font-semibold dark:text-white">จำนวนชั่วโมง</p>
                                        </td>
                                        <?php
                                        $total_hr = (strtotime($reserves->time_end) - strtotime($reserves->time_start)) / 3600;
                                        ?>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <!-- 2 ชั่วโมง -->
                                            {{ $total_hr }} ชั่วโมง
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p class="font-semibold dark:text-white">ราคา</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $reserves->total_price }} บาท
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p class="font-semibold dark:text-white">ส่วนลด</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            @if ($reserves->total_point_discount == null)
                                                0 บาท
                                            @else
                                                {{ $reserves->total_point_discount }} บาท
                                            @endif
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <p class="font-semibold dark:text-white">ราคาสุทธิ</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $reserves->total_price_discount }} บาท
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

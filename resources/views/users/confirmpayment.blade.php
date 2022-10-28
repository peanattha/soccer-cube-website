@extends('layouts.layout')

@section('title', 'Confirem Payment')

@section('stadiums', 'active')

<link type="text/css" rel="stylesheet" href="../css/app.css">
<link type="text/css" rel="stylesheet" href="../css/payment.css">

@section('content')
    <div class="confirm_payment">
        <form action="{{ route('confirmPayment', ['id' => $reserves->id]) }}" method="post" enctype="multipart/form-data" class="m-2">
            @csrf
            <div class="confirm_payment container flex-auto w-screen mx-2">
                <div
                    class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md ">
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 ">
                        จำนวนเงินที่ต้องจ่าย</h5>
                    <p class="font-thin text-2xl">{{ $reserves->total_price_discount }} บาท</p>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 e">
                        รายละเอียดการชำระเงิน</h5>
                    <p class="font-thin text-2xl">Order No: {{$reserves->id}}</p>
                    <p class="font-thin text-sm ">ต้องโอนภายใน {{ $reserves->reserve_date }}</p>
                    <p class="font-thin text-sm ">หากเลยเวลากรุณาทำรายการใหม่</p>
                    <p class="font-thin text-sm ">QR CODE</p>
                    <img src="../img/QR.jpg" alt="">
                    <p class="font-thin text-sm ">ใช้สำหรับจองสนามบนเว็บไซต์เท่านั้น</p>
                    <br>
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="user_avatar">
                        อัพโหดลรูปภาพหลักฐานการโอนเงิน
                    </label>
                    <input name="userPayment_img"
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer "
                        aria-describedby="user_avatar_help" id="user_avatar" type="file" required>
                    <div class="mt-1 text-sm text-gray-500 " id="user_avatar_help"></div>
                    <p class="font-thin text-sm">หลังจากโอนเงินแล้วให้กดปุ่มยืนยัน</p>

                    <div class="mt-1 text-sm text-gray-500 " id="user_avatar_help"></div>
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                        ยืนยัน
                    </button>
                </div>
            </div>
        </form>
        <div class="m-2 p-6 bg-white rounded-lg border border-gray-200 shadow-md">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">รายละเอียดการจอง</h5>
            <p class="mb-3 font-normal text-gray-700">Here are the biggest enterprise technology
                acquisitions of 2021 so far, in reverse chronological order.</p>
            <div class="flex flex-col">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class=" shadow-md sm:rounded-lg ">
                            <table class="min-w-full">
                                <thead class="bg-gray-100 ">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase ">
                                            <p class="font-black ">หัวข้อ</p>
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase ">
                                            <p class="font-black ">รายละเอียด</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 ">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <p class="font-semibold ">วันที่จอง</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $reserves->reserve_date }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <p class="font-semibold ">เวลา</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap ">
                                            <!-- 17:00 - 19:00 -->
                                            {{ $reserves->time_start }} - {{ $reserves->time_end }}
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <p class="font-semibold ">จำนวนชั่วโมง</p>
                                        </td>
                                        <?php
                                        $total_hr = (strtotime($reserves->time_end) - strtotime($reserves->time_start)) / 3600;
                                        ?>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap ">
                                            <!-- 2 ชั่วโมง -->
                                            {{ $total_hr }} ชั่วโมง
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 ">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <p class="font-semibold">ราคา</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap ">
                                            {{ $reserves->total_price }} บาท
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 ">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <p class="font-semibold ">ส่วนลด</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap ">
                                            @if ($reserves->total_point_discount == null)
                                                0 บาท
                                            @else
                                                {{ $reserves->total_point_discount }} บาท
                                            @endif
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-b odd:bg-white even:bg-gray-50 ">
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                            <p class="font-semibold ">ราคาสุทธิ</p>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap ">
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

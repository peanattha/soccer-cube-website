@extends('layouts.master')

@section('title', 'Payment')

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />
<script src="https://unpkg.com/flowbite@1.3.4/dist/datepicker.js"></script>
<link rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/payment.css">
<script src="../js/nav.js"></script>

@section('srcImg', '../img/Soccer_Cube_1.png')

@section('content')
    <div class="payment">
        <div class="payment-d container flex-auto w-screen mx-2">
            <div
                class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    เงือนไขการให้บริการ</h5>
                <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <ul class="list-disc dark:text-gray-400">
                        <li>แต้มจะได้รับหลังจากทำการจองสนามเป็นที่เรียนร้อยแล้ว <br> โดยจะได้เป็น 1% จากราคาที่จอง</li>
                        <li>แต้มขั้นต่ำที่สามารถใช้ได้คือ 100 แต้ม สูงสุดที่ 500 แต้ม</li>
                        <li>100 แต้มมีค่าเท่ากับ 10 บาท</li>
                        <li>คำสั่งจองจะถูกยกเลิก <br> หากไม่ชำระเงินภายในเวลาที่กำหนด</li>
                    </ul>
                </div>
                {{-- <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    เลือกช่องทางการชำระเงิน</h5>
                <div class="flex items-center mb-4">
                    <input id="country-option-1" type="radio" name="countries" value="USA"
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                        aria-labelledby="country-option-1" aria-describedby="country-option-1" checked="">
                    <label for="country-option-1" class="block ml-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                        โอนผ่านบัญชีธนาคาร
                    </label>
                </div>
                <div class="flex items-center mb-4">
                    <input id="country-option-2" type="radio" name="countries" value="Germany"
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                        aria-labelledby="country-option-2" aria-describedby="country-option-2">
                    <label for="country-option-2" class="block ml-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                        พร้อมเพย์
                    </label>
                </div>
                <div class="flex items-center mb-4">
                    <input id="country-option-3" type="radio" name="countries" value="Spain"
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600"
                        aria-labelledby="country-option-3" aria-describedby="country-option-3">
                    <label for="country-option-3" class="block ml-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                        ชำระเงินที่สนาม
                    </label>
                </div> --}}
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    แต้มส่วนลด</h5>
                @if ($reserves->user->point == null)
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">แต้มของคุณ 0 แต้ม</p>
                @else
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">แต้มของคุณ {{ $reserves->user->point }}
                        แต้ม</p>
                @endif
                <form action="{{ route('insertDiscount', ['id' => $reserves->id]) }}" method="POST">
                    @csrf
                    <div class="flex items-center">
                        <select name="point" onchange="this.form.submit()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            <?php $tmp = 0;
                            $tmp_bathtoPoints = $reserves->total_point_discount * 10; ?>
                            @if ($tmp_bathtoPoints == 0)
                                <option value="" selected hidden>ไม่ใช้แต้ม
                                @else
                                <option value="" selected hidden>{{ $tmp_bathtoPoints }} แต้ม
                            @endif

                            <option value='{{ $tmp }}'>ไม่ใช้แต้ม</option>
                            @for ($i = 100; $i <= 500; $i = $i + 100)
                                @if ($reserves->user->point >= $i)
                                    <option value="{{ $i }}"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        {{ $i }} แต้ม
                                    </option>
                                @endif
                            @endfor
                        </select>
                        <div>
                        </div>
                </form>
            </div>
            <br>
            <form action="{{ route('showConfirm', ['id' => $reserves->id]) }}" method="post">
                @csrf
                <button type="submit"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    จ่ายเงิน
                </button>
                <a href="{{ route('cancelReserve', ['id' => $reserves->id]) }}">
                    <button type="button"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        ยกเลิกการจอง
                    </button>
                </a>
            </form>
        </div>
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
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
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
    </div>
@endsection

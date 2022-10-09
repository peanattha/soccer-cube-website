@extends('layouts.layout')

@section('title', 'Reserved')

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />
<link rel="stylesheet" href="./css/style.css">
<link type="text/css" rel="stylesheet" href="../css/reserved.css">
<script src="../js/nav.js"></script>
<link href="/css/app.css" rel="stylesheet">

@section('content')
    <div class="reserved">
        <form action="{{ route('reservedFilter') }}" method="GET" class="filter">
            <select name="filter" onchange="this.form.submit()"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:text-white dark:bg-gray-800 dark:border-gray-700">
                <option value="" selected hidden>เลือกตัวกรอง</option>
                <option value="1">Week</option>
                <option value="2">Month</option>
                <option value="3">Cancle</option>
                <option value="4">reserve</option>
                <option value="5">wait for pay</option>
                <option value="6">All</option>
            </select>
        </form>
        @if (count($reserves) == 0)
            <p class="txton">คุณยังไม่มีรายการจอง</p>
        @else
            @foreach ($reserves as $reserve)
                <div
                    class="flex flex-row bg-white hover:bg-gray-100 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <img
                        src="data:image/png;base64,{{ chunk_split(base64_encode($reserve->stadium->stadium_img)) }}"
                        alt="">
                    <div>
                        <div >
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $reserve->stadium->stadium_name }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">ราคา :
                                {{ $reserve->total_price_discount }}
                                บาท
                            </p>
                            <?php
                            $reserve_date = date('d/m/Y', strtotime($reserve->reserve_date));
                            ?>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">วันที่จอง :
                                {{ $reserve->reserve_date }}
                            </p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">เวลา : {{ $reserve->time_start }}
                                น.
                                -
                                {{ $reserve->time_end }} น.</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">สถานะการจ่ายเงิน :
                                {{ $reserve->payment->payment_status }}</p>

                            <?php
                            $currentDate = date('Y-m-d');
                            $d = date('Y-m-d', strtotime($currentDate . ' +1 days'));
                            ?>

                            @if (($d < $reserve->reserve_date && $reserve->payment->payment_status == 'payment completed') || $reserve->payment->payment_status == 'Waiting to pay')
                                @if ($reserve->payment->payment_status == 'Waiting to pay' && $reserve->stadium->del == null)
                                    {{-- <script type="text/javascript">
                                        function countDown() {
                                            var timeA = new Date(); // วันเวลาปัจจุบัน
                                            // var date = new Date('M d Y', strtotime($reserve->reserve_date));
                                            // var time = new Date('H-i-sa', strtotime({{$reserve->time_start}}));
                                            var timeB = new Date("March 24,2022 20:57:00"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
                                            // var timeB = new Date(2012,1,24,0,0,1,0);
                                            // วันเวลาสิ้นสุด รูปแบบ ปี,เดือน;วันที่,ชั่วโมง,นาที,วินาที,,มิลลิวินาที เลขสองหลักไม่ต้องมี 0 นำหน้า
                                            // เดือนต้องลบด้วย 1 เดือนมกราคมคือเลข 0
                                            var timeDifference = timeB.getTime() - timeA.getTime();
                                            if (timeDifference >= 0) {
                                                timeDifference = timeDifference / 1000;
                                                timeDifference = Math.floor(timeDifference);
                                                var wan = Math.floor(timeDifference / 86400);
                                                var l_wan = timeDifference % 86400;
                                                var hour = Math.floor(l_wan / 3600);
                                                var l_hour = l_wan % 3600;
                                                var minute = Math.floor(l_hour / 60);
                                                var second = l_hour % 60;
                                                var showPart = document.getElementById({{$reserve->id}});
                                                showPart.innerHTML = "กรุณาจ่ายเงินภายใน :  " + wan + " วัน " + hour + " ชั่วโมง " +
                                                    minute + " นาที " + second + " วินาที";
                                                if (wan == 0 && hour == 0 && minute == 0 && second == 0) {
                                                    clearInterval(iCountDown); // ยกเลิกการนับถอยหลังเมื่อครบ
                                                    window.location.replace("{{ route('cancelReserve', ['id' => $reserve->id]) }}");
                                                }
                                            }
                                        }
                                        // การเรียกใช้
                                        var iCountDown = setInterval("countDown()", 1000);
                                    </script>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" id="{{$reserve->id}}"></p> --}}
                                    <a href="{{ route('payment', ['id' => $reserve->id]) }}"
                                        class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:bg-green-800">
                                        Pay
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                @endif
                                <a href="{{ route('cancelReserve', ['id' => $reserve->id]) }}"
                                    onclick="return confirm('Are you sure you want to cancel reserve ?')"
                                    class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:bg-red-800">
                                    Cancel
                                    <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- <div class="bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

                </div> --}}
            @endforeach
        @endif
    </div>
@endsection

@if (session()->has('error'))
    <script>
        var msg = '{{ Session::get('error') }}';
        var exist = '{{ Session::has('error') }}';
        if (exist) {
            alert(msg);
        }
    </script>
@endif

@extends('layouts.master')

@section('title', 'Stadium')

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />
<script src="https://unpkg.com/flowbite@1.3.4/dist/datepicker.js"></script>
<link rel="stylesheet" href="../css/style.css">
<link type="text/css" rel="stylesheet" href="../css/detailStadium.css">
<script src="../js/nav.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('srcImg', '../img/Soccer_Cube_1.png')

@section('content')

    <div class="stadiums">
        <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <img class="rounded-t-lg" src="data:image/png;base64,{{ chunk_split(base64_encode($stadium->stadium_img)) }}"
                alt="">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $stadium->stadium_name }}</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">ราคา
                    {{ $stadium->stadium_price }}</h5>
                <p class="mb-3 text-gray-700 dark:text-gray-400">{{ $stadium->stadium_detail }}</p>
            </div>
        </div>

        <div class="form-reserve">
            <form action="{{ route('insertPayment', ['id' => $stadium->id]) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-white ">Date</label>
                    <input datepicker datepicker-autohide name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Select date">
                </div>
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-white ">Time Start</label>
                    <select name="startTime"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <option value="" selected hidden>Time Start</option>
                        <option value="08:00:00">08:00 น.</option>
                        <option value="09:00:00">09:00 น.</option>
                        <option value="10:00:00">10:00 น.</option>
                        <option value="11:00:00">11:00 น.</option>
                        <option value="12:00:00">12:00 น.</option>
                        <option value="13:00:00">13:00 น.</option>
                        <option value="14:00:00">14:00 น.</option>
                        <option value="15:00:00">15:00 น.</option>
                        <option value="16:00:00">16:00 น.</option>
                        <option value="17:00:00">17:00 น.</option>
                        <option value="18:00:00">18:00 น.</option>
                        <option value="19:00:00">19:00 น.</option>
                        <option value="20:00:00">20:00 น.</option>
                        <option value="21:00:00">21:00 น.</option>
                        <option value="22:00:00">22:00 น.</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-white ">Time End</label>
                    <select name="endTime"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <option value="" selected hidden>Time End</option>
                        <option value="08:00:00">08:00 น.</option>
                        <option value="09:00:00">09:00 น.</option>
                        <option value="10:00:00">10:00 น.</option>
                        <option value="11:00:00">11:00 น.</option>
                        <option value="12:00:00">12:00 น.</option>
                        <option value="13:00:00">13:00 น.</option>
                        <option value="14:00:00">14:00 น.</option>
                        <option value="15:00:00">15:00 น.</option>
                        <option value="16:00:00">16:00 น.</option>
                        <option value="17:00:00">17:00 น.</option>
                        <option value="18:00:00">18:00 น.</option>
                        <option value="19:00:00">19:00 น.</option>
                        <option value="20:00:00">20:00 น.</option>
                        <option value="21:00:00">21:00 น.</option>
                        <option value="22:00:00">22:00 น.</option>

                    </select>
                </div>
                <div class="mb-6">
                    <input type="submit" value="Submit"
                        class="inline-flex justify-center items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:bg-green-800">
                </div>
            </form>
        </div>

        <div class="flex flex-col justify-center">
            <div class="flex justify-center">
                <form action="{{ route('dateFilter', ['id' => $stadium->id]) }}" method="POST" class="flex">
                    @csrf
                    <div class="mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-white ">Date</label>
                        <input datepicker datepicker-autohide name="dateFilter"
                            class=" bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date">
                    </div>
                    <div class="mb-6 flex items-end">
                        <input type="submit" value="Search"
                            class="inline-flex  justify-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:bg-green-800">
                    </div>
                </form>
            </div>
            <div class="flex flex-col">
                <div class="inline-block">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <table class="min-w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr></tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Date
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Stadium
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Start
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    End
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($reserves->count() == 0)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="4"
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            ไม่มีรายการจอง
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($reserves as $reserve)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td
                                                class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $reserve->reserve_date }}
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->stadium->stadium_name }}
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->time_start }}
                                            </td>
                                            <td
                                                class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $reserve->time_end }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

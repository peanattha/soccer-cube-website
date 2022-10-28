@extends('layouts.layout')

@section('title', 'Stadium Details')

@section('stadiums', 'active')

<link type="text/css" rel="stylesheet" href="../css/app.css">
<link type="text/css" rel="stylesheet" href="../css/stadium.css">
<script src="https://unpkg.com/flowbite@1.3.4/dist/datepicker.js"></script>
<link type="text/css" rel="stylesheet" href="../css/detailStadium.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@if (session()->has('error'))
    <script>
        var msg = '{{ Session::get('error') }}';
        var exist = '{{ Session::has('error') }}';
        if (exist) {
            alert(msg);
        }
    </script>
@endif

@section('content')
    <div class="container stadiums">
        <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
            <img class="rounded-t-lg" src="data:image/png;base64,{{ chunk_split(base64_encode($stadium->stadium_img)) }}"
                alt="">
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                    {{ $stadium->stadium_name }}</h5>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">ราคา
                    {{ $stadium->stadium_price }}</h5>
                <p class="mb-3 text-gray-700">{{ $stadium->stadium_detail }}</p>
            </div>
        </div>
        <div>
            <div class="form-reserve">
                <form action="{{ route('insertPayment', ['id' => $stadium->id]) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-black ">Date</label>
                        <input datepicker datepicker-autohide name="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5 "
                            placeholder="Select date">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block mb-2 text-sm font-medium text-black ">Time Start</label>
                        <select name="startTime"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                        <label for="message" class="block mb-2 text-sm font-medium text-black ">Time End</label>
                        <select name="endTime"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                            class="inline-flex justify-center items-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300">
                    </div>
                </form>
            </div>
            <div class="flex flex-col justify-center">
                <div class="flex justify-center">
                    <form action="{{ route('dateFilter', ['id' => $stadium->id]) }}" method="POST" class="flex">
                        @csrf
                        <div class="mb-6">
                            <label for="message" class="block mb-2 text-sm font-medium text-black ">Date</label>
                            <input datepicker datepicker-autohide name="dateFilter"
                                class=" bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                placeholder="Select date">
                        </div>
                        <div class="mb-6 flex items-end">
                            <input type="submit" value="Search"
                                class="inline-flex  justify-center py-2 px-3 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 ">
                        </div>
                    </form>
                </div>
                <div class="table_resv flex flex-col">
                    <div class="inline-block">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr></tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase ">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                        Start
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                        End
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($reserves->count() == 0)
                                        <tr class="bg-white border-b">
                                            <td colspan="4"
                                                class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                                ไม่มีรายการจอง
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($reserves as $reserve)
                                            <tr class="bg-white border-b">
                                                <td
                                                    class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap ">
                                                    {{ $reserve->reserve_date }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ $reserve->time_start }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
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
    </div>
@endsection

@extends('layouts.master')

@section('title', 'Home')
<link href="/css/app.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">

@section('srcImg', './img/Soccer_Cube_Home.png')

@section('content-home')
    <div class="text">
        <h1 style="font-size: 80px">Soccer Cube</h1>
        <p>
            สนามฟุตบอลหญ้าเทียมให้เช่า ในร่ม และกลางแจ้ง <br> หลังวัดป่าอดุลยาราม ใกล้มหาวิทยาลัยขอนแก่น
        </p>
        <a href="{{ route('stadiums') }}"><input type="button" value="Reserve Now" class="btnReserveNow"></a>
    </div>
@endsection

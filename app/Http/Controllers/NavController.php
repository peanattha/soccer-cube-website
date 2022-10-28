<?php

namespace App\Http\Controllers;

use App\Models\bank;
use App\Models\user;
use App\Models\reserve;
use App\Models\payment;
use App\Models\stadium;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NavController extends Controller
{
    //
    public function showPayment($id)
    {
        $sta_id = reserve::find($id)->stadium_id;
        if (stadium::find($sta_id)->del == 1) {
            return redirect()->route('reserved');
        } else {
            $reserves = reserve::find($id);
            $time_start = reserve::find($id)->time_start;
            $time_end = reserve::find($id)->time_end;
            $total_hr = (strtotime($time_end) - strtotime($time_start)) / 3600;
            return view('users.payment', compact('reserves', 'total_hr'));
        }
    }

    public function insertDiscount(Request $request, $id)
    {
        $update_reserve = reserve::find($id);
        $total_point_discount = reserve::find($id)->total_point_discount;
        if ($total_point_discount == null) {
            $total_point_discount = 0;
        }
        $pointToBath = ($request->point) * 0.1;
        $update_reserve->total_point_discount = $pointToBath;

        $time_start = reserve::find($id)->time_start;
        $time_end = reserve::find($id)->time_end;
        $total_hr = (strtotime($time_end) - strtotime($time_start)) / 3600;

        $stadium = stadium::find($update_reserve->stadium_id);
        $stadium_price = $stadium->stadium_price;
        $price = $total_hr * $stadium_price;

        $update_reserve->total_price_discount = $price - $pointToBath;

        $update_reserve->save();
        return redirect()->route('payment', ['id' => $id]);
    }

    public function insertPayment(Request $request, $id)
    {
        $date =  date('Y-m-d', strtotime($request->date));  //วันที่ผู้ใช้กรอกเข้ามา

        //เช็คคอลัมเริ่ม => อยู่ระหว่าง
        $reserve_date =  DB::table('reserves')
            ->where('reserve_date', $date)
            ->where('stadium_id', $id)
            ->where('deleted_at', null)
            ->whereBetween("time_start", [
                $request->startTime,  //เวลาเริ่มผู้ใช้กรอกเข้ามา
                date('H:i:s', strtotime($request->endTime . ' -1 mins')) //เวลาจบมผู้ใช้กรอกเข้ามา
            ])->get();

        // เช็คคอลัมจบ => อยู่ระหว่าง
        $reserve_date3 =  DB::table('reserves')
            ->where('reserve_date', $date)
            ->where('stadium_id', $id)
            ->where('deleted_at', null)
            ->whereBetween("time_end", [
                date('H:i:s', strtotime($request->startTime . ' +1 mins')),
                $request->endTime
            ])->get();

        //เริ่ม เเละ จบ อยู่รหว่าง /
        $reserve_date1 =  DB::table('reserves')
            ->where('reserve_date', $date)
            ->where('stadium_id', $id)
            ->where('time_start', '<', $request->startTime)
            ->where('time_end', '>', $request->endTime)
            ->where('deleted_at', null)
            ->get();

        //เท่ากันทั้ง เริ่ม จบ /
        $reserve_date2 =  DB::table('reserves')
            ->where('reserve_date', $date)
            ->where('stadium_id', $id)
            ->where('time_start', $request->startTime)
            ->where('time_end', $request->endTime)
            ->where('deleted_at', null)
            ->get();

        $cur_date = Carbon::now()->format('m/d/Y');  //วันตอนนี้

        $cur_time = Carbon::now()->format('H:i:s');  //เวลาตอนนี้

        if (($reserve_date2->count() == 0) && ($reserve_date1->count() == 0)
            && ($reserve_date->count() == 0) && ($reserve_date3->count() == 0) && ($cur_date <= $request->date)
        ) {
            if ($cur_date == $request->date) {  //เช็คว่าวันที่จองเป็นวันนี้รึป่าว
                if ($cur_time <= $request->startTime) {  //เช็คว่าถ้าเป็นวันนี้เเล้วเวลา จองต้องมากกว่าเวลาปัจจุบัน
                    if ($request->startTime >= $request->endTime) {   //เช็คเวลาเริ่มมากกว่าเวลาจบรึป่าว
                        return redirect()->back()->with('error', 'วันเเละเวลานี้ไม่สามารถจองได้ กรุณาเลือกใหม่');
                    } else {
                        $new_reserve = new reserve;
                        $new_reserve->user_id = Auth::user()->id;
                        $new_reserve->payment_id = 5; //Waiting to pay ถูก
                        $new_reserve->stadium_id = $id;
                        $stadium = stadium::find($id);
                        $total_hr = (strtotime($request->endTime) - strtotime($request->startTime)) / 3600;
                        $new_reserve->total_price = $total_hr * ($stadium->stadium_price);
                        $new_reserve->total_price_discount = $total_hr * ($stadium->stadium_price);
                        $new_reserve->reserve_date = date('Y-m-d', strtotime($request->date));
                        $new_reserve->time_start = $request->startTime;
                        $new_reserve->time_end = $request->endTime;
                        $new_reserve->save();
                        $reserve_id = $new_reserve->id;
                        return redirect()->route('payment', ['id' => $reserve_id]);
                    }
                } else {
                    return redirect()->back()->with('error', 'วันเเละเวลานี้ไม่สามารถจองได้ กรุณาเลือกใหม่');
                }
            } else {
                if ($request->startTime >= $request->endTime) {  //เช็คเวลาเริ่มมากกว่าเวลาจบรึป่าว
                    return redirect()->back()->with('error', 'ไม่สามารถเลือกเวลานี้ได้ กรุณาเลือกใหม่');
                } else {
                    $new_reserve = new reserve;
                    $new_reserve->user_id = Auth::user()->id;
                    $new_reserve->payment_id = 5; //Waiting to pay ถูก
                    $new_reserve->stadium_id = $id;
                    $stadium = stadium::find($id);
                    $total_hr = (strtotime($request->endTime) - strtotime($request->startTime)) / 3600;
                    $new_reserve->total_price = $total_hr * ($stadium->stadium_price);
                    $new_reserve->total_price_discount = $total_hr * ($stadium->stadium_price);
                    $new_reserve->reserve_date = date('Y-m-d', strtotime($request->date));
                    $new_reserve->time_start = $request->startTime;
                    $new_reserve->time_end = $request->endTime;
                    $new_reserve->save();
                    $reserve_id = $new_reserve->id;
                    return redirect()->route('payment', ['id' => $reserve_id]);
                }
            }
        } else {
            return redirect()->back()->with('error', 'วันเเละเวลานี้ไม่สามารถจองได้ กรุณาเลือกใหม่');
        }
    }
    public function showConfirm($id)
    {
        $reserves = reserve::find($id);
        return view('users.confirmpayment', compact('reserves'));
    }
    public function confirmPayment(Request $request, $id)
    {
        $reserves_update = reserve::find($id);
        $reserves_update->payment_id = 2; //Waiting to confirmed payment ถูก
        $file = $request->file('userPayment_img');
        $contents = $file->openFile()->fread($file->getSize()); //insert img to database
        $reserves_update->slip_img = $contents;
        $reserves_update->save();

        //add user point
        $user = user::find(reserve::find($id)->user_id);
        $use_point = reserve::find($id)->total_point_discount;
        $BathtoPoint = $use_point * 10;
        $user->point = $user->point - $BathtoPoint;
        $price = reserve::find($id)->total_price_discount;
        $user->point = $user->point + ($price * 0.01);
        $user->save();

        return redirect()->route('reserved');
    }
    public function showHome()
    {
        $stadiums = stadium::where('del', null)->get();
        return view('home',compact('stadiums'));
    }
    public function showWellcome()
    {
        $stadiums = stadium::where('del', null)->get();
        return view('welcome',compact('stadiums'));
    }
    public function showStadiums()
    {
        $stadiums = stadium::where('del', null)->get();
        return view('users.stadiums', compact('stadiums'));
    }
    public function showStadiumDetail(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $stadium = stadium::find($request->idStadium);
        $reserves = reserve::where('stadium_id', $request->idStadium)->where('reserve_date', '>=', $now)->orderBy('reserve_date')->orderBy('time_start')->get();
        return view('users.stadiumDetail', compact('stadium', 'reserves'));
    }
    public function dateFilter(Request $request, $id)
    {
        $date = date('Y-m-d', strtotime($request->dateFilter));
        $reserves = reserve::where('reserve_date', $date)->where('stadium_id', $id)->orderBy('time_start')->get();
        $stadium = stadium::find($id);
        return view('users.stadiumDetail', compact('reserves', 'stadium'));
    }
    public function showReserved()
    {
        $reserves = Reserve::withTrashed()->where('user_id', Auth::user()->id)->get();
        return view('users.reserved', compact('reserves'));
    }
    public function showReservedFilter(Request $request)
    {
        if ($request->filter == 1) {
            $now = Carbon::now();
            $reserves = Reserve::withTrashed()->whereBetween("reserve_date", [
                $now->startOfWeek()->format('Y-m-d'),
                $now->endOfWeek()->format('Y-m-d')
            ])->where('user_id', Auth::user()->id)->get();
            return view('users.reserved', compact('reserves'));
        } else if ($request->filter == 2) {
            $now = Carbon::now();
            $reserves = Reserve::withTrashed()->whereBetween("reserve_date", [
                $now->startOfMonth()->format('Y-m-d'),
                $now->endOfMonth()->format('Y-m-d')
            ])->where('user_id', Auth::user()->id)->get();
            return view('users.reserved', compact('reserves'));
        } else if ($request->filter == 3) {
            $reserves = Reserve::onlyTrashed()->where('user_id', Auth::user()->id)->get();
            return view('users.reserved', compact('reserves'));
        } else if ($request->filter == 4) {
            $reserves = Reserve::where('payment_id', 1)->get();  //payment completed ถูก
            return view('users.reserved', compact('reserves'));
        } else if ($request->filter == 5) {
            $reserves = Reserve::where('payment_id', 5)->get();  //Waiting to pay ถูก
            return view('users.reserved', compact('reserves'));
        } else {
            return redirect()->route('reserved');
        }
    }
    public function cancelReserve($id)
    {
        $update_payment = reserve::find($id);
        $payment_id = reserve::find($id)->payment_id;
        if ($payment_id == 5) {
            $update_payment->payment_id = payment::where('payment_status', 'Cancel complete')->first()->id; // 3 ถูก
            $update_payment->save();
            reserve::destroy($id);
        } else {
            $update_payment->payment_id = payment::where('payment_status', 'Waiting to refund')->first()->id; // 3 ถูก
            $update_payment->save();
        }
        return redirect()->route('reserved');
    }
    public function cancelReserveAdmin()
    {
        $cancel_reserves = reserve::all()->where('payment_id', 3); //Waiting to refund ถูก
        $banks = bank::all();
        return view('admin.cancelReserveAdmin', compact('cancel_reserves','banks'));
    }
    public function confirmedCancelAdmin($id)
    {
        $update_payment = reserve::find($id);
        $update_payment->payment_id = payment::where('payment_status', 'Refund complete')->first()->id; //4 ถุก
        $update_payment->save();
        reserve::destroy($id);
        return redirect()->route('cancelReserveAdmin');
    }
    public function showAdminStadiums()
    {
        $stadiums = stadium::where('del', null)->get();
        return view('admin.stadiums', compact('stadiums'));
    }

    public function showEditStadium($id)
    {
        $id = $id;
        $stadium = stadium::find($id);
        return view('admin.editstadiums', compact('stadium'));
    }

    public function showInsertStadium()
    {
        return view('admin.insertstadiums');
    }

    public function insertStadium(Request $request)
    {
        $new_stadium = new stadium;
        $new_stadium->stadium_name = $request->name;
        $new_stadium->stadium_price = $request->price;
        $new_stadium->stadium_detail = $request->detail;
        $file = $request->file('img');
        $contents = $file->openFile()->fread($file->getSize());
        $new_stadium->stadium_img = $contents;
        $new_stadium->save();
        return redirect()->route('stadiumsAdmin');
    }

    public function deleteStadium($id)
    {
        // stadium::destroy($id);
        $stadium = stadium::find($id);
        $stadium->del = 1;
        $stadium->save();

        $reserves = reserve::where('stadium_id', $id)->where('payment_id', 1)->orWhere('payment_id', 2)->get();
        foreach ($reserves as $reserve) {
            $reserve->payment_id = 3;
            $reserve->save();
        }

        $reserves = reserve::where('stadium_id', $id)->where('payment_id', 5)->get();
        foreach ($reserves as $reserve) {
            $reserve->payment_id = 6;
            $reserve->save();
        }

        return redirect()->route('stadiumsAdmin');
    }

    public function editStadium(Request $request, $id)
    {
        $update_stadium = stadium::find($id);
        $update_stadium->stadium_name = $request->name;
        $update_stadium->stadium_price = $request->price;
        $update_stadium->stadium_detail = $request->detail;
        $file = $request->file('img');
        $contents = $file->openFile()->fread($file->getSize());
        $update_stadium->stadium_img = $contents;
        $update_stadium->save();
        return redirect()->route('stadiumsAdmin');
    }
    public function adminDashboard()
    {
        $now = Carbon::now();
        $reserves = reserve::all();
        $price = reserve::all()->sum('total_price_discount');
        $date = date('Y-m-d', strtotime($now));

        $price_day = reserve::where('reserve_date', $date)->get()->sum('total_price_discount');

        $price_week = Reserve::whereBetween("reserve_date", [
            $now->startOfWeek()->format('Y-m-d'),
            $now->endOfWeek()->format('Y-m-d')
        ])->get()->sum('total_price_discount');

        $price_month = Reserve::whereBetween("reserve_date", [
            $now->startOfMonth()->format('Y-m-d'),
            $now->endOfMonth()->format('Y-m-d')
        ])->get()->sum('total_price_discount');

        $price_year = Reserve::whereBetween("reserve_date", [
            $now->startOfYear()->format('Y-m-d'),
            $now->endOfYear()->format('Y-m-d')
        ])->get()->sum('total_price_discount');

        $count_cancel = reserve::onlyTrashed()->count();

        $count_reserve = reserve::all()->count();
        return view('admin.dashboard', compact('reserves', 'price', 'price_day', 'price_week', 'price_month', 'price_year', 'count_cancel', 'count_reserve'));
    }
    public function showReserveAdmin()
    {
        $reserves = reserve::all()->where('payment_id', 2); //Waiting to confirmed payment ถูก
        return view('admin.confirmReserve', compact('reserves'));
    }
    public function confirmReserveAdmin($id)
    {
        $update_reserve = reserve::find($id);
        $update_reserve->payment_id = 1; //payment completed ถูก
        $update_reserve->save();
        return redirect()->route('reserveAdmin');
    }
    public function dashboardFilter(Request $request)
    {
        if ($request->filter == 1) {
            $now = Carbon::now();
            $reserves = Reserve::withTrashed()->whereBetween("reserve_date", [
                $now->startOfWeek()->format('Y-m-d'),
                $now->endOfWeek()->format('Y-m-d')
            ])->get();
        } else if ($request->filter == 2) {
            $now = Carbon::now();
            $reserves = Reserve::withTrashed()->whereBetween("reserve_date", [
                $now->startOfMonth()->format('Y-m-d'),
                $now->endOfMonth()->format('Y-m-d')
            ])->get();
        } else if ($request->filter == 3) {
            $reserves = Reserve::onlyTrashed()->get();
        } else if ($request->filter == 4) {
            $reserves = Reserve::where('payment_id', 1)->get();  //payment completed ถูก
        } else {
            return redirect()->route('adminDashboard');
        }
        $now = Carbon::now();
        $price = reserve::all()->sum('total_price_discount');
        $date = date('Y-m-d', strtotime($now));
        $price_day = reserve::where('reserve_date', $date)->get()->sum('total_price_discount');
        $price_week = Reserve::whereBetween("reserve_date", [
            $now->startOfWeek()->format('Y-m-d'),
            $now->endOfWeek()->format('Y-m-d')
        ])->get()->sum('total_price_discount');

        $price_month = Reserve::whereBetween("reserve_date", [
            $now->startOfMonth()->format('Y-m-d'),
            $now->endOfMonth()->format('Y-m-d')
        ])->get()->sum('total_price_discount');

        $price_year = Reserve::whereBetween("reserve_date", [
            $now->startOfYear()->format('Y-m-d'),
            $now->endOfYear()->format('Y-m-d')
        ])->get()->sum('total_price_discount');

        $count_cancel = reserve::onlyTrashed()->count();

        $count_reserve = reserve::all()->count();
        return view('admin.dashboard', compact(
            'reserves',
            'price',
            'price_day',
            'price_week',
            'price_month',
            'price_year',
            'count_cancel',
            'count_reserve'
        ));
    }
}

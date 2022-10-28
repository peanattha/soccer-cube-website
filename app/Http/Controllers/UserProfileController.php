<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\bank;
use App\Models\bank_detail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        $point = Auth::user()->point;
        $bank_details = bank_detail::all();
        $banks = bank::where('user_id', Auth::user()->id)->get();
        $isAdmin = (Auth::user()->is_admin);
        $admins = DB::select('SELECT * FROM users WHERE is_admin = 1');
        return view('profile.show', [
            'request' => $request,
            'user' => $request->user(),
            'point' => $point,
            'bank_details' => $bank_details,
            'banks' => $banks,
            'isAdmin' => $isAdmin,
            'admins' => $admins,
        ]);
    }

    public function bank(Request $request)
    {
        $new_bank = new Bank;
        $new_bank->user_id = Auth::user()->id;
        $new_bank->bank_detail_id = $request->bankname;
        $new_bank->firstname = $request->firstname;
        $new_bank->lastname = $request->lastname;
        $new_bank->account_number = $request->bankid;
        $new_bank->save();
        return redirect()->route('profile.show');
    }

    public function update_bank(Request $request, $id)
    {
        $update_bank = bank::find($id);
        $update_bank->user_id = Auth::user()->id;
        $update_bank->bank_detail_id = $request->bankname;
        $update_bank->firstname = $request->firstname;
        $update_bank->lastname = $request->lastname;
        $update_bank->account_number = $request->bankid;
        $update_bank->save();
        return redirect()->route('profile.show');
    }

    public function addAdmin(Request $request)
    {
        $add_admin = user::find(user::where('email', $request->email)->first()->id);
        $add_admin->is_admin = 1;
        $add_admin->save();
        return redirect()->route('profile.show');
    }

    public function deleteAdmin($id)
    {
        $update_admin = user::find($id);
        $update_admin->is_admin = null;
        $update_admin->save();
        return redirect()->route('profile.show');
    }
}


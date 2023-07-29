<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function phoneLogin()
    {
        return view('auth.getOtp');
    }

    public function sendOtp(Request $request)
    {
        $user = User::where('phone','=',$request['phone'])->first();
        if (empty($user))
        {
            sendOTP($request['phone']);
            $type = 'new';
            return view('auth.Verfication',
                [
                    'phone' => $request['phone'],
                    'type' => $type,
                ]);

        }else
        {
            $otp =  sendOTP($request['phone']);
            if ($otp == 2)
            {
                return redirect()->back()->with('fail', 'حداقل 2 دقیقه تا درخواست بعدی باید صبر کنید');
            }
            $type = 'old';
            return view('auth.Verfication',
            [
                'phone' => $request['phone'],
                'type' => $type,
            ]);
        }


    }
}

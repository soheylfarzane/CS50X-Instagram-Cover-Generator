<?php

use App\Lib\Data;
use App\Models\SiteOption;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;


if (!function_exists('sendSms')) {

    function sendSms($receiver, $message)
    {
        $url = 'http://smspanel.Trez.ir/SendMessageWithPost.ashx';
        $client = new Client();
        $response = $client->post($url, [
            'form_params' => [
                'UserName' => env('SMS_USERNAME'),
                'Password' => env('SMS_PASSWORD'),
                'PhoneNumber' => env('SMS_NUMBER'),
                'MessageBody' => $message,
                'RecNumber' => $receiver,
                'Smsclass' => '1',
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data;
    }
}
if (!function_exists('sendOTP')) {

    function sendOTP($receiver)
    {

        $code = rand(1000, 9999);
        $message = 'کد فعالسازی : ' . $code;
        $oldOtp = \Illuminate\Support\Facades\DB::table('otps')->where('phone', '=', $receiver)->first();


        if ($oldOtp) {
            $createdAt = Carbon::parse($oldOtp->created_at);
            $now = Carbon::now();

            // Check if the difference is less than 2 minutes
            if ($createdAt->diffInMinutes($now) < 2) {

                return 2;

            } else {

                \Illuminate\Support\Facades\DB::table('otps')->where('phone', '=', $receiver)->delete();
                \Illuminate\Support\Facades\DB::table('otps')->insert([
                    'code' => $code,
                    'phone' => $receiver,
                    'active' => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                sendSms($receiver, $message);

                return 1;
            }
        } else {
            \Illuminate\Support\Facades\DB::table('otps')->insert([
                'code' => $code,
                'phone' => $receiver,
                'active' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            sendSms($receiver, $message);
            return 1;
        }


    }
}
if (!function_exists('checkOTP')) {

    function checkOTP($phone, $code)
    {

        $otp = \Illuminate\Support\Facades\DB::table('otps')->where('phone', $phone)->first();
        if ($otp) {
            if ($otp->code == $code) {
                \Illuminate\Support\Facades\DB::table('otps')->where('phone', '=', $phone)->delete();
                return $phone;
            } else {
                return false;
            }

        } else {
            return sendOTP($phone);
        }

    }
}
if (!function_exists('uploadResize')) {

    function uploadResize($request, $name = 'photo', $size = 256)
    {

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $path = '/uploads/' . $year . '/' . $month . '/' . $day . '/';
        $directory = public_path($path);

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }


        $file = $request->file($name);

        if (!in_array($file->getClientOriginalExtension(), ['jpg', 'png'])) {
            return redirect()->route('MediaList')->with('fail', 'فرمت فایل مورد نظر پشتیبانی نمی شود.');
        }

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $url = $path . time();
        $destinationPath = public_path($url);
        $file->move($destinationPath, $fileName);
        $photo = $url . '/' . $fileName;

        // Resize the image to 256px
        $resizedImage = Image::make($destinationPath . '/' . $fileName)->resize($size, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Save the resized image
        $resizedImage->save($destinationPath . '/' . $name . $size . '-' . $size . $fileName);

        // Get the URL of the resized image


        return $url . '/' . $name . $size . '-' . $size . $fileName;;

    }


}


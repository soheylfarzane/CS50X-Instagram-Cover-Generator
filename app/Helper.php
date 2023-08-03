<?php

use App\Lib\Data;
use App\Models\SiteOption;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
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
            return 'unknown';
        }

    }
}
if (!function_exists('uploadResize')) {

    function uploadResize($request, $name = 'photo', $size = 256)
    {

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $path = 'uploads/' . $year  ;
        $directory = public_path($path);

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }


        $file = $request->file($name);
        if (empty($file))
        {
            return 'empty';
        }

        if (!in_array($file->getClientOriginalExtension(), ['jpg','JPG','Jpg','PNG','Png', 'png'])) {
            return false;
        }

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $url = $path ;
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


        File::delete($photo);
        return $url . '/' . $name . $size . '-' . $size . $fileName;;

    }


}
if (!function_exists('uploader')) {

    function uploader($request, $folder, $name = 'photo',$size = 256,)
    {

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $path = 'uploads/'.$folder.'/' . $year . '/' . $month . '/' . $day . '/';
        $directory = public_path($path);

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }


        $file = $request->file($name);
        if (empty($file))
        {
            return 'empty';
        }

        if (!in_array($file->getClientOriginalExtension(), ['jpg','JPG','Jpg','PNG','Png', 'png'])) {
            return false;
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
        $resizedImage->save($destinationPath . '/' . $name . $size . '-' . $size .'-'. $fileName);

        // Get the URL of the resized image


        return $url . '/' . $name . $size . '-' . $size.'-'. $fileName;;

    }


}
if (!function_exists('fileUploader')) {

    function fontUploader($request, $name = 'file')
    {
        $path = 'fonts'. '/';
        $directory = public_path($path);

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        $file = $request->file($name);
        if (empty($file))
        {
            return 'empty';
        }
        if (!in_array($file->getClientOriginalExtension(), ['ttf'])) {
            return false;
        }
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $url = $path . time();
        $destinationPath = public_path($url);
        $file->move($destinationPath, $fileName);
        $photo = $url . '/' . $fileName;
        return $url . '/' . $name . $fileName;;
    }


}
if (!function_exists('storeUploads')) {

    function storeUploads($path,$userID, $templateId)
    {

        DB::table('uploads')->insert(
            [
                'user_id' => $userID,
                'path' => $path,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }


}
if (!function_exists('storeResults')) {

    function storeResults($path,$userID, $templateId)
    {

        DB::table('results')->insert(
            [
                'user_id' => $userID,
                'template_id' => $templateId,
                'path' => $path,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }


}


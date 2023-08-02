<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Template;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{

    public function data()
    {
        $setting = Setting::first();
        return response()->json(
            [
                'SiteName' => $setting->name,
                'SiteSlogan' => $setting->slogan,
                'SiteDescription' => $setting->description,
                'SiteMessage' => $setting->message,
                'SiteLogo' => $setting->logo,
                'siteBanner1' => $setting->banner1,
                'siteBanner2' => $setting->banner2,
                'siteBanner3' => $setting->banner3,
                'siteBanner4' => $setting->banner4,
                'siteAboutUrl' => $setting->aboutUrl,
                'siteUrl' => $setting->siteUrl,
                'appLastUpdate' => $setting->lastUpdate,
                'appUpdatedUrl' => $setting->updatedUrl,
                'appLastVersion' => $setting->version,
            ]

        );
    }
    public function lastTemplate()
    {
        $template = Template::with('category')->orderBy('created_at','desc')->get();
    return $template;
    }
    public function categoryTemplate(Request $request)
    {
        $template = Category::where('id','=',$request->query('id'))->with('templates')->orderBy('created_at','desc')->withCount('templates')->get();
    return $template;
    }
    public function categories(Request $request)
    {
        if ($request->query('id'))
        {
            $template = Category::where('id','=',$request->query('id'))->with('templates')->orderBy('created_at','desc')->withCount('templates')->get();
            return $template;
        }
        $categories = Category::orderBy('created_at','desc')->withCount('templates')->get();
        return $categories;
    }

    public function sendOtp(Request $request)
    {
        if (!$request['phone'])
        {
            return response()->json(
                [
                    'status' => 'fail Phone number is missing',
                ]
            ,400);
        }
        $status = sendOTP($request['phone']);
        if ($status == 1)
        {
            return response()->json(
                [
                    'status' => 'OTP sent',
                    'phone' => $request['phone'],
                ]
            );
        }else
        {
            return response()->json(
                [
                    'status' => 'Fail Wait 2 Minutes',
                    'phone' => $request['phone'],
                ]
            ,429);
        }


    }

    public function checkOtp(Request $request)
    {
        if (!$request['phone'])
        {
            return response()->json(
                [
                    'status' => 'fail Phone number is missing',
                ]
                ,400);
        }
        if (!$request['code'])
        {
            return response()->json(
                [
                    'status' => 'fail Phone number is missing',
                ]
                ,400);
        }
        $user = User::where('phone','=',$request['phone'])->first();


        $otpCheck =  checkOTP($request['phone'],$request['code']);
        if ($otpCheck == $request['phone'])
        {
//            توکن بده
            $tokenLength = 32; // Desired token length in bytes
            $randomBytes = random_bytes($tokenLength);
            $randomTokenHex = bin2hex($randomBytes);

            if ($user)
            {
                User::where('phone','=',$request['phone'])->update(
                    [
                        'token' => $randomTokenHex,
                        'updated_at' => Carbon::now(),
                    ]
                );
                return  response()->json(
                    [
                        'status' => 'success',
                        'name' => $user->name,
                        'active' => $user->active,
                        'token' => $randomTokenHex,
                    ]
                );
            }else
            {
               User::create([
                   'name' => 'StoryYar',
                   'phone' => $request['phone'],
                   'limit' => 10,
                   'password' => Hash::make(random_bytes(64)),
                   'phoneVerified' => true,
                   'active' => false,
                   'token' => $randomTokenHex,
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
               ]) ;
                $user = User::where('phone','=',$request['phone'])->first();
                return  response()->json(
                    [
                        'status' => 'success',
                        'name' => $user->name,
                        'active' => $user->active,
                        'token' => $randomTokenHex,
                    ]
                );
            }

        }elseif ($otpCheck == false)
        {
            return  response()->json(
                [
                    'status' => 'fail',
                    'message' => 'Wrong OTP Code',
                ]
            ,401);
        }else
        {
            return  response()->json(
                [
                    'status' => 'fail',
                    'message' => 'No OTP Code Found',
                ]
                ,404);

        }

    }

    public function updateUser(Request $request)
    {


        $token = $request->header('apiToken');
        $userData = User::where('token','=',$token)->first();
        if (empty($userData))
        {
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => 'Unauthorized Token',
                ],401
            );
        }
        else{


            $data = [];
            if ($request['name'])
            {
                $data['name'] = $request['name'];
            }
            if ($request['telegram'])
            {
                $data['telegram'] = $request['telegram'];
            }
            if ($request['instagram'])
            {
                $data['instagram'] = $request['instagram'];
            }            if ($request['slogan'])
            {
                $data['slogan'] = $request['slogan'];
            }if ($request['birthDay'])
            {
                $data['birthDay'] = $request['birthDay'];
            }
            $data['active'] = 1;
            User::where('token','=',$token)->update($data);
            $user = User::where('token','=',$token)->first();



            return response()->json($user,200
            );



        }


    }
    public function uploader(Request $request)
    {
         if ($request->header('apiToken') == '0123456789')
         {
             $path =  uploadResize($request,'image','1024');
             if ($path == false )
             {
                 return response()->json(
                     [
                         'status' => 'fail',
                         'message' => 'Only Jpg , Png , Svg  Support',
                     ],400
                 );
             }
             $id = DB::table('uploads')->insertGetId(
                 [
                     'user_id' =>1,
                     'path' =>$path,
                 ]
             );
             $result = DB::table('uploads')->find($id);
             return $result;
         }else
         {
             return response()->json(
                 [
                     'status' => 'fail',
                     'message' => 'Unauthorized Token',
                 ],401
             );
         }




    }

}

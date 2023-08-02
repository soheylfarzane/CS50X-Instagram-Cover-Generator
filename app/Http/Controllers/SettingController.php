<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setting()
    {
        $setting = Setting::first();
        return view('admin.setting',[
            'setting' => $setting
        ]);
    }

    public function storeSetting(Request $request)
    {
        $setting = Setting::first();

        $name = $this->defaultSetter($request['name'], 'استوری یار');
        $logo = $this->settingUploader($request, 'logo', '/default/logo.svg');
        $slogan = $this->defaultSetter($request['slogan'], 'با استوری یار بهترین ها رو بساز');
        $banner1 = $this->settingUploader($request, 'banner1', '/default/banner1.png');
        $banner2 = $this->settingUploader($request, 'banner2', '/default/banner2.jpg');
        $banner3 = $this->settingUploader($request, 'banner3', '/default/banner3.jpg');
        $banner4 = $this->settingUploader($request, 'banner4', '/default/banner4.png');
        $description = $this->defaultSetter($request['description'], 'این متن توضیحات نرم افزار خودمونه یادت باشه عوضش کنی!!!');
        $message = $this->defaultSetter($request['message'], 'خوش آمدید اینجا استوری یار است.');
        $aboutUrl = $this->defaultSetter($request['aboutUrl'], 'https://storyyar.ir/about');
        $siteUrl = $this->defaultSetter($request['siteUrl'], 'https://storyyar.ir/');
        $lastUpdate = $this->defaultSetter($request['lastUpdate'], '1 شهریور 1402');
        $updatedUrl = $this->defaultSetter($request['updatedUrl'], 'https://storyyar.ir/app');
        $version = $this->defaultSetter($request['version'], '1.0.0');

        if (!$setting) {
            Setting::create([
                'name' => $name,
                'logo' => $logo,
                'slogan' => $slogan,
                'banner1' => $banner1,
                'banner2' => $banner2,
                'banner3' => $banner3,
                'banner4' => $banner4,
                'description' => $description,
                'message' => $message,
                'aboutUrl' => $aboutUrl,
                'siteUrl' => $siteUrl,
                'lastUpdate' => $lastUpdate,
                'updatedUrl' => $updatedUrl,
                'version' => $version,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            Setting::first()->update([
                'name' => $name,
                'logo' => $logo,
                'slogan' => $slogan,
                'banner1' => $banner1,
                'banner2' => $banner2,
                'banner3' => $banner3,
                'banner4' => $banner4,
                'description' => $description,
                'message' => $message,
                'aboutUrl' => $aboutUrl,
                'siteUrl' => $siteUrl,
                'lastUpdate' => $lastUpdate,
                'updatedUrl' => $updatedUrl,
                'version' => $version,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }


        return redirect(route('setting'))->with('status', 'با موفقیت ذخیره شد');
    }

    private function defaultSetter($request, $default)
    {
        $value = $request;
        if (!isset($value)) {
            $value = $default;
        }
        return $value;
    }

    private function settingUploader($request, $name, $default)
    {
        $setting = Setting::first();
        $file = $request->file($name);
        if (!isset($file)) {
            if (!isset($setting->$name)) {
                return $default;
            }
            return $setting->$name;
        }

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $path = 'uploads/setting/' . $year . '-' . $month . '-' . $day . '/';
        $directory = public_path($path);

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (!in_array($file->getClientOriginalExtension(), ['jpg', 'JPG', 'Jpg', 'PNG', 'Png', 'png'])) {
            return false;
        }
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $url = $path . time();
        $destinationPath = public_path($url);
        $file->move($destinationPath, $fileName);
        $photo = $url . '/' . $fileName;

        return $photo;
    }
}

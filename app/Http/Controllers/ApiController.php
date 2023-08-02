<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Template;
use Illuminate\Http\Request;

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
        $template = Template::orderBy('created_at','desc')->get();
    return $template;
    }

}

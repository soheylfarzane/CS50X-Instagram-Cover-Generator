<?php

namespace App\Lib;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class Cover
{
    public function coverKaviyani($image, $text1, $text2, $heading1FontFamily,$heading2FontFamily)
    {
        $mainImage = Image::make('template/cover/01/01.png');
        $userImage = Image::make($image)->fit(1080, 1080);
        $shadowImage = Image::make('template/cover/01/03.png')->fit(1080, 1080);
        $line1Image = Image::make('template/cover/01/04.png')->fit(1080, 1080);
        $line2Image = Image::make('template/cover/01/05.png')->fit(1080, 1080);
        $mainImage->insert($userImage,'center');
        $mainImage->insert($shadowImage,'center');
        $mainImage->insert($line1Image,'center');
        $mainImage->insert($line2Image,'center');
        $headingText = \PersianRender\PersianRender::render($text1);
        $heading2Text = \PersianRender\PersianRender::render($text2);
        $textLayer = Image::make('template/cover/01/00.png');
        $textLayer->text($headingText, 540,  758 , function ($font) use ($heading1FontFamily)  {
            $font->file($heading1FontFamily);
            $font->size(85);
            $font->color('#454545');
            $font->align('center');
            $font->valign('center');
        });
        $textLayer->text($heading2Text, 540,  958 , function ($font) use ($heading2FontFamily)  {
            $font->file($heading2FontFamily);
            $font->size(76);
            $font->color('#6a6a6a');
            $font->align('center');
            $font->valign('center');
        });
        $textLayer->blur(10);
        $textLayer->text($headingText, 540,  750 , function ($font) use ($heading1FontFamily) {
            $font->file($heading1FontFamily);
            $font->size(85);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('center');
        });
        $textLayer->text($heading2Text, 540,  950 , function ($font) use ($heading2FontFamily) {
            $font->file($heading2FontFamily);
            $font->size(76);
            $font->color('#f5ed0f');
            $font->align('center');
            $font->valign('center');
        });
        $mainImage->insert($textLayer,'center');
        $current = Carbon::now()->format('YmdHs');
        $path = 'results/result'.$current.'.jpg';
        $mainImage->save($path);
        return $path;
    }
    public function coverKalateModel1($image,$headingText,$subHeadingText,$instagramIdText,$heading1FontFamily = 'fonts/yekan/YekanBakhFaNum-Black.ttf',$heading2FontFamily = 'fonts/yekan/YekanBakhFaNum-Black.ttf',)
    {
        $headingText = \PersianRender\PersianRender::render($headingText);
        $subHeadingText = \PersianRender\PersianRender::render($subHeadingText);
        $mainImage = Image::make('template/cover/02/01.png');
        $userImage = Image::make($image)->fit(1080, 1080);
        $frameImage = Image::make('template/cover/02/frame.png');
        $layer1Image = Image::make('template/cover/02/03.png');
        $layer2Image = Image::make('template/cover/02/04.png');
        $instagramImage = Image::make('template/icon/instagram-logo.png')->fit(80, 80);;
        $mainImage->insert($userImage,'center');
        $mainImage->insert($layer1Image,'center');
        $mainImage->insert($layer2Image,'center');
        $mainImage->insert($instagramImage,'bottom-left',30,50);
        $textLayer = Image::make('template/cover/01/00.png');

        $textLayer->text($headingText, 540,  750 , function ($font) use ($heading1FontFamily,)  {
            $font->file($heading1FontFamily);
            $font->size(110);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('center');
        });
        $textLayer->text($subHeadingText, 540,  850 , function ($font) use ($heading2FontFamily)  {
            $font->file($heading2FontFamily);
            $font->size(60);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('center');
        });
        $textLayer->text($instagramIdText, 120,  1000 , function ($font) use ($heading1FontFamily)  {
            $font->file($heading1FontFamily);
            $font->size(36);
            $font->color('#393939');
            $font->align('bottom-left');
            $font->valign('bottom-left');
        });
        $mainImage->insert($textLayer,'center');
        $mainImage->insert($frameImage,'center');
        return $mainImage->response();
    }
}

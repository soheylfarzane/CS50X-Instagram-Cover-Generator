<?php

namespace App\Http\Controllers;



use App\Lib\Cover;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

//use Intervention\Image\ImageManagerStatic as Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function userIndex()
    {
        $templates = DB::table('templates')->get();
        return view('welcome',[
            'templates' => $templates,
        ]);
    }




    public function index($key)
    {
        $template = DB::table('templates')->where('slug','=',$key)->first();
         $fonts = DB::table('fonts')->get();

        return view('createForm',[
            'fonts' => $fonts,
            'template' => $template,
        ]);
    }

    public function generator($key,Request $request)
    {

        $template = DB::table('templates')->where('slug','=',$key)->first();
        $cover = NEW Cover();
        if ($key == 'coverKaviyani')
        {
            $this->validate($request,[
                'headding1' => 'required|max:30',
                'headding2' => 'required|max:30',
            ],[
                'headding1.required' => 'این فیلد الزامی می باشد',
                'headding1.max' => 'حداکثر 30 کاراکتر وارد کنید.',
                'headding2.required' => 'این فیلد الزامی می باشد',
                'headding2.max' => 'حداکثر 30 کاراکتر وارد کنید.',
            ]);
            $headding1Font = DB::table('fonts')->where('id',$request['headding1Font'])->first();
            $headding2Font = DB::table('fonts')->where('id',$request['headding2Font'])->first();

            $image =  uploadResize($request,'image','1080');
            if ($image == false)
            {
                return redirect()->back()->with('fail', 'فرمت فایل مورد نظر پشتیبانی نمی شود. jpg و png پشتیبانی می شود.');
            }
            if ($image == 'empty')
            {
                return redirect()->back()->with('fail', 'لطفا یک فایل انتخاب کنید... فرمت باید jpg یا png باشد');
            }


            storeUploads($image,Auth::id(),$template->id);
            $path = $cover->coverKaviyani($image,$request['headding1'],$request['headding2'],$headding1Font->path,$headding2Font->path);
        }elseif($key == 'coverKalateModel1')
        {
            $this->validate($request,[
                'headding1' => 'required|max:30',
                'headding2' => 'required|max:30',
            ],[
                'headding1.required' => 'این فیلد الزامی می باشد',
                'headding1.max' => 'حداکثر 30 کاراکتر وارد کنید.',
                'headding2.required' => 'این فیلد الزامی می باشد',
                'headding2.max' => 'حداکثر 30 کاراکتر وارد کنید.',
            ]);
            $headding1Font = DB::table('fonts')->where('id',$request['headding1Font'])->first();
            $headding2Font = DB::table('fonts')->where('id',$request['headding2Font'])->first();
            $image =  uploadResize($request,'image','1080');
            if ($image == false)
            {
                return redirect()->back()->with('fail', 'فرمت فایل مورد نظر پشتیبانی نمی شود. jpg و png پشتیبانی می شود.');
            }
            if ($image == 'empty')
            {
                return redirect()->back()->with('fail', 'لطفا یک فایل انتخاب کنید... فرمت باید jpg یا png باشد');
            }

            $path = $cover->coverKalateModel1($image,$request['headding1'],$request['headding2'],'@soheylfarzane',$headding1Font->path,$headding2Font->path);
        }





        File::delete($image);
        storeResults($path,Auth::id(),$template->id);
         return view('result',[
             'path' => $path,
         ]);
    }

    private function writeJustify($image, $text = 'لورم ایپسوم یک متن ساختگی به زبان فارسی می باشد.این New My Lorem Ipsum  است.', $fontSize = 28,$color = '#ffffff',$fontFamily = 'fonts/YekanBakhFaNum-Bold.ttf', $top = 0)
    {
        $maxLineWidth = 1550 / $fontSize; // حداکثر عرض خط مورد نظر شما

        // تقسیم متن به جملات با استفاده از نقطه‌ها (.)
        $sentences = preg_split('/(?<=[.?!])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

        // آرایه‌ای برای نگه‌داری خطوط جدید
        $newLines = [];
        $currentLine = '';

        // تراز کردن کلمات و حفظ جملات با فضای خالی
        foreach ($sentences as $sentence) {
            $words = explode(' ', $sentence);


            foreach ($words as $key => $word) {
                $word = str_replace(['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', ')', '('], ['0', '1', '2', '3', '4', '5', '5', '7', '8', '9', '"', '"'], $word);
                // اگر کلمه شامل اعداد باشد، اعداد انگلیسی را معکوس می‌کنیم
                if (preg_match('/[0-9]/', $word)) {
                    $word = strrev($word);
                }



                if (preg_match('/[a-zA-Z]/', $word)) {
                    $newArray[] = $word;


                    // Remove the English word from the original array


                }

                // اگر کلمه شامل اعداد فارسی باشد، اعداد فارسی را معکوس می‌کنیم


                $wordLength = mb_strlen($word, 'UTF-8');

                if (mb_strlen($currentLine . $word . ' ', 'UTF-8') <= $maxLineWidth) {
                    // اگر کلمه فعلی به همراه فاصله‌ی اضافی به خط فعلی اضافه شود، طول خط فعلی بیشتر از حداکثر عرض خواهد شد
                    // بنابراین می‌توانیم این کلمه را به خط فعلی اضافه کنیم
                    if (!empty($currentLine)) {
                        $currentLine .= ' ';
                    }
                    $currentLine .= $word;
                } else {
                    // اگر کلمه فعلی بیش از حداکثر عرض خط باشد، آن را به خط جدید اضافه می‌کنیم
                    $newLines[] = $currentLine;
                    $currentLine = $word;
                }

            }
        }

        // اضافه کردن جمله آخر به خطوط جدید
        if (!empty($currentLine)) {
            $newLines[] = $currentLine;
        }



        // ترکیب خطوط تراز شده به یکدیگر
        $justifiedText = implode("\n", $newLines);

        $numberLines = count($newLines);

        for ($i = 0; $i < $numberLines; $i++) {
            $persian_text_rev = \PersianRender\PersianRender::render($newLines[$i]);

            $image->text($persian_text_rev, 1000, $i * ($fontSize + 30) + 1100 + $top, function ($font) use ($fontSize,$color,$fontFamily) {
                $font->file($fontFamily);
                $font->size($fontSize + 6);
                $font->color($color);
                $font->align('right');
                $font->valign('center');
            });
        }
    }
    private function writHeading($image, $text = 'لورم ایپسوم یک متن ساختگی به زبان فارسی می باشد.این New My Lorem Ipsum  است.', $fontSize = 28,$color = '#ffffff',$fontFamily = 'fonts/YekanBakhFaNum-Bold.ttf', $top = 0)
    {
        $maxLineWidth = 1550 / $fontSize; // حداکثر عرض خط مورد نظر شما

        // تقسیم متن به جملات با استفاده از نقطه‌ها (.)
        $sentences = preg_split('/(?<=[.?!])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

        // آرایه‌ای برای نگه‌داری خطوط جدید
        $newLines = [];
        $currentLine = '';

        // تراز کردن کلمات و حفظ جملات با فضای خالی
        foreach ($sentences as $sentence) {
            $words = explode(' ', $sentence);


            foreach ($words as $key => $word) {
                $word = str_replace(['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', ')', '('], ['0', '1', '2', '3', '4', '5', '5', '7', '8', '9', '"', '"'], $word);
                // اگر کلمه شامل اعداد باشد، اعداد انگلیسی را معکوس می‌کنیم
                if (preg_match('/[0-9]/', $word)) {
                    $word = strrev($word);
                }



                if (preg_match('/[a-zA-Z]/', $word)) {
                    $newArray[] = $word;


                    // Remove the English word from the original array


                }

                // اگر کلمه شامل اعداد فارسی باشد، اعداد فارسی را معکوس می‌کنیم


                $wordLength = mb_strlen($word, 'UTF-8');

                if (mb_strlen($currentLine . $word . ' ', 'UTF-8') <= $maxLineWidth) {
                    // اگر کلمه فعلی به همراه فاصله‌ی اضافی به خط فعلی اضافه شود، طول خط فعلی بیشتر از حداکثر عرض خواهد شد
                    // بنابراین می‌توانیم این کلمه را به خط فعلی اضافه کنیم
                    if (!empty($currentLine)) {
                        $currentLine .= ' ';
                    }
                    $currentLine .= $word;
                } else {
                    // اگر کلمه فعلی بیش از حداکثر عرض خط باشد، آن را به خط جدید اضافه می‌کنیم
                    $newLines[] = $currentLine;
                    $currentLine = $word;
                }

            }
        }

        // اضافه کردن جمله آخر به خطوط جدید
        if (!empty($currentLine)) {
            $newLines[] = $currentLine;
        }



        // ترکیب خطوط تراز شده به یکدیگر
        $justifiedText = implode("\n", $newLines);

        $numberLines = count($newLines);

        for ($i = 0; $i < $numberLines; $i++) {
            $persian_text_rev = \PersianRender\PersianRender::render($newLines[$i]);

            $image->text($persian_text_rev, 900, $i * ($fontSize + 30) + 1100 + $top, function ($font) use ($fontSize,$color,$fontFamily) {
                $font->file($fontFamily);
                $font->size($fontSize + 6);
                $font->color($color);
                $font->align('right');
                $font->valign('center');
            });
        }
    }

    public function newsDigiato($newsNumber = 0)
    {

        $url = "https://digiato.com/feed";
        $response = Http::get($url);
        if ($response->ok()) {
            $xmlString = $response->body();
            // Process the XML content here
        } else {
            // Handle the case when the request fails
            $statusCode = $response->status();
            // Handle the error accordingly
        }
        $xml = simplexml_load_string($xmlString);
        $channel = $xml->channel;
        $firstItem = $channel->item[$newsNumber];


// Accessing the item properties
        $title = (string)$firstItem->title;
        $image = (string)$firstItem->image->url;


        $cleanTitle = str_replace('/ عکس', ' ', $title);
        $link = (string)$firstItem->link;
        $replacements = array(
            "دیجیاتو نوشت" => "",
            "روزیاتو نوشت" => "",
            "گجت نیوز نوشت" => "",
            "زومیت نوشت" => "",
            "همشهری‌آنلاین نوشت" => "",
            "ایسنا نوشت" => "",
            $title => "",
            'The' => "",
        );
        $cleanDescription = str_replace(array_keys($replacements), array_values($replacements), (string)$firstItem->description);
        $description = $cleanDescription;
        $pubDate = (string)$firstItem->pubDate;

        $patternp = '/<p>(.*?)<\/p>/s';

        if (preg_match($patternp, $description, $matches)) {
            $paragraph = $matches[0];

        } else {
            $paragraph = '';
        }


        $notag = strip_tags($description);
        $replacements = array(
            "دیجیاتو نوشت" => "",
            "روزیاتو نوشت" => "",
            "گجت نیوز نوشت" => "",
            "زومیت نوشت" => "",
            "همشهری‌آنلاین نوشت" => "",
            "appeared first on دیجیاتو." => "",
        );
        $cleanDescription = str_replace(array_keys($replacements), array_values($replacements), $notag);
        $des = str_replace("\n",'',$cleanDescription);


        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $convertedString = str_replace($persianDigits, $englishDigits, $des);

        return [
            'imageUrl' => str_replace('.webp','',$image),
            'title' => $cleanTitle,
            'description' => $convertedString,
        ];
    }


}


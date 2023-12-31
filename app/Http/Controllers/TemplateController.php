<?php

namespace App\Http\Controllers;

use App\Lib\Cover;
use App\Lib\Keys;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addTemplate()
    {
        $fonts = DB::table('fonts')->get();
        $categories = DB::table('categories')->get();

        $covers = New Keys();
        $keys = $covers->keys();
        $templates = Template::get();



        return view('admin/createTemplateForm', [
            'fonts' => $fonts,
            'categories' => $categories,
            'keys' => $keys,
            'templates' => $templates,
        ]);

    }

    public function storeTemplate(Request $request)
    {




        $request->validate([
            'name' => 'required',
            'key' => 'required',
            'font_id' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'لطفا یک مقدار مناسب وارد کنید',
            'key.required' => 'لطفا یک مقدار مناسب وارد کنید',
            'font_id.required' => 'لطفا یک مقدار مناسب وارد کنید',
            'category_id.required' => 'لطفا یک مقدار مناسب وارد کنید',
        ]);
        $image = uploader($request, 'template/thumbnail', 'thumbnail', 1080);
        if ($image == false) {
            return redirect()->back()->with('fail', 'فرمت فایل مورد نظر پشتیبانی نمی شود. jpg و png پشتیبانی می شود.');
        }
        if ($image == 'empty') {
            return redirect()->back()->with('fail', 'لطفا یک فایل انتخاب کنید... فرمت باید jpg یا png باشد');
        }

        Template::create([

            'name' => $request['name'],
            'slug' => $request['key'],
            'thumbnail' => $image,
            'font_id' => $request['font_id'],
            'category_id' => $request['category_id'],
            'text1' => $request['text1'],
            'text2' => $request['text2'],
            'text3' => $request['text3'],
            'text4' => $request['text4'],
            'text5' => $request['text5'],
            'text6' => $request['text6'],
            'longText' => $request['longText'],
            'maxText1' => $request['maxText1'],
            'maxText2' => $request['maxText2'],
            'maxText3' => $request['maxText3'],
            'maxText4' => $request['maxText4'],
            'maxText5' => $request['maxText5'],
            'maxText6' => $request['maxText6'],
            'maxLongText' => $request['maxLongText'],
            'logo' => $request['logo'],
        ]);


        return redirect()->back()->with('status', 'قالب جدید اضافه شد هم اکنون میتوانید استفاده کنید');
    }

    public function templates()
    {
        $templates = DB::table('templates')->get();

        return view('admin/templateList', [
            'templates' => $templates,
        ]);

    }

    public function CoverGenerator(Request $request)
    {
        $cover = new Cover();
        if ($request['name'] == 'kaviyani') {

        } else {
            $this->validate($request, [
                'headding1' => 'required|max:30',
                'headding2' => 'required|max:30',
            ], [
                'headding1.required' => 'این فیلد الزامی می باشد',
                'headding1.max' => 'حداکثر 30 کاراکتر وارد کنید.',
                'headding2.required' => 'این فیلد الزامی می باشد',
                'headding2.max' => 'حداکثر 30 کاراکتر وارد کنید.',
            ]);
        }
    }
}

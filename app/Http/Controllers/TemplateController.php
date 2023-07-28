<?php

namespace App\Http\Controllers;

use App\Lib\Cover;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('admin/createTemplateForm',[
            'fonts' => $fonts,
            'categories' => $categories,
        ]);

    }

    public function storeTemplate(Request $request)
    {


        $request->validate([
           'name' => 'required',
           'key' => 'required',
           'font_id' => 'required',
           'category_id' => 'required',
        ],[
            'name.required' => 'لطفا یک مقدار مناسب وارد کنید',
            'key.required' => 'لطفا یک مقدار مناسب وارد کنید',
            'font_id.required' => 'لطفا یک مقدار مناسب وارد کنید',
            'category_id.required' => 'لطفا یک مقدار مناسب وارد کنید',
        ]);
        $image =  uploader($request,'template/thumbnail','thumbnail',1080);
        if ($image == false)
        {
            return redirect()->back()->with('fail', 'فرمت فایل مورد نظر پشتیبانی نمی شود. jpg و png پشتیبانی می شود.');
        }
        if ($image == 'empty')
        {
            return redirect()->back()->with('fail', 'لطفا یک فایل انتخاب کنید... فرمت باید jpg یا png باشد');
        }

        Template::create([

            'name' => $request['name'],
            'slug' => $request['key'],
            'thumbnail' => $image,
            'font_id' => $request['font_id'],
            'category_id' => $request['category_id'],
        ]);


        return redirect()->back()->with('status', 'قالب جدید اضافه شد هم اکنون میتوانید استفاده کنید');
    }
    public function templates()
    {
        $templates = DB::table('templates')->get();

        return view('admin/templateList',[
            'templates' => $templates,
        ]);

    }
    public function CoverGenerator(Request $request)
    {
        $cover = NEW Cover();
        if($request['name'] == 'kaviyani') {

        }else
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
        }
    }
}

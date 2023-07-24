<?php

namespace App\Http\Controllers;

use App\Lib\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    public function addTemplate()
    {
        $fonts = DB::table('fonts')->get();
        $categories = DB::table('categories')->get();

        return view('admin/createTemplateForm',[
            'fonts' => $fonts,
            'categories' => $categories,
        ]);

    }
    public function templates()
    {
        $fonts = DB::table('fonts')->get();
        $categories = DB::table('categories')->get();

        return view('admin/templateList',[
            'fonts' => $fonts,
            'categories' => $categories,
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

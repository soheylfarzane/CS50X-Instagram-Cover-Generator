<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Font;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FontController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fontsList()
    {
        $fonts = DB::table('fonts')->get();


        return view('admin.fontsList',[
            'fonts' => $fonts,
        ]);

    }
    public function addFont()
    {
        $fonts = DB::table('fonts')->get();


        return view('admin.createFontForm',[
            'fonts' => $fonts,
        ]);

    }

    public function storeFont(Request $request)
    {
        $path =  fontUploader($request);
        if($path == false)
        {
            return redirect()->route('addFont')->with('fail', 'فرمت فایل صحیح نمی باشد فرمت صحیح ttf  می باشد');
        }elseif ($path == 'empty')
        {
            return redirect()->route('addFont')->with('fail', 'لطفا یک فایل انتخاب کنید ');
        }

        Font::create([
            'name' => $request['name'],
            'weight' => $request['weight'],
            'path' => $path,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        return redirect()->route('addFont')->with('status', 'فونت جدید با موفقیت اضافه شد');
    }

    public function deleteFont($id)
    {

        $font = Font::find($id);
        File::delete($font->path);
        Font::find($id)->delete();
        return redirect()->route('fontsList')->with('status', 'دسته بندی با موفقیت حذف شد');
    }
}

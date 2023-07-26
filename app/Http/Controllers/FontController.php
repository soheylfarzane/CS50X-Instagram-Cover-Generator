<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FontController extends Controller
{
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
}

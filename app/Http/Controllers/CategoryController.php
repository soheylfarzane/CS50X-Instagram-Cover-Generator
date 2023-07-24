<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function addCategory()
    {
        $fonts = DB::table('fonts')->get();
        $categories = DB::table('categories')->get();

        return view('admin/createCategoryForm',[
            'fonts' => $fonts,
            'categories' => $categories,
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function categories()
    {
        $categories = DB::table('categories')->get();

        return view('admin/categoryList',[
            'categories' => $categories,
        ]);

    }    public function addCategory()
    {
        $fonts = DB::table('fonts')->get();
        $categories = DB::table('categories')->get();

        return view('admin/createCategoryForm',[
            'fonts' => $fonts,
            'categories' => $categories,
        ]);

    }

    public function storeCategory(Request $request)
    {
        Category::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        return redirect()->route('addCategory')->with('status', 'دسته بندی با موفقیت اضافه شد');
    }

    public function deleteCategory($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories')->with('status', 'دسته بندی با موفقیت حذف شد');
    }
}

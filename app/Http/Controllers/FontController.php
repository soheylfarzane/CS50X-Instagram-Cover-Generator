<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FontController extends Controller
{
    public function fontsList()
    {
        return view('admin.fontsList');
    }
}

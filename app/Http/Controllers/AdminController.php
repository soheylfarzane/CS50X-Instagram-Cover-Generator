<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $results = DB::table('results')->get();
        $templates = DB::table('templates')->get();
        $fonts = DB::table('fonts')->get();
        $users = DB::table('users')->get();
        return view('admin.dashboard',[
            'countResults' => count($results),
            'countTemplates' => count($templates),
            'countFonts' => count($fonts),
            'countUsers' => count($users),
        ]);
    }
}

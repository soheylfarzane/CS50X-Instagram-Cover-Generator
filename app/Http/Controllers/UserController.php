<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function usersList()
    {
        $users = DB::table('users')->paginate(20);
        return view('admin.usersList',[
            'users' => $users,
            ]);
    }
}

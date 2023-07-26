<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersList()
    {
        return view('admin.usersList');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('is_admin');
        $this->middleware('auth');
    }
    public function admin()
    {
        return view('admin');
    }
}

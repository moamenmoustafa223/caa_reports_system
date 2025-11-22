<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login_admin()
    {
        return view('auth.login_admin');
    }


    public function login_employee()
    {
        return view('auth.login_employee');
    }

}

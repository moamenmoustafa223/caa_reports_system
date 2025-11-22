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
        // If anyone is already logged in (admin or employee), redirect to admin dashboard
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }

        return view('auth.login_admin');
    }


    public function login_employee()
    {
        // If anyone is already logged in (admin or employee), redirect to employee dashboard
        if (auth('employee')->check()) {
            return redirect()->route('employee.index');
        }

        return view('auth.login_employee');
    }

}

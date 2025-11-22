<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\SafetyTip;
use Illuminate\Support\Facades\Auth;

class HomeEmployeeController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();
        $safetyTips = SafetyTip::active()->ordered()->get();
        return view('Employee.index', compact('employee', 'safetyTips'));
    }
}

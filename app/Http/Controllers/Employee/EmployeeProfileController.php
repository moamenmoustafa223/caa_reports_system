<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeProfileController extends Controller
{
    public function show(Request $request)
    {
        $employee = $request->user();
        return view('employee.profile.show', compact('employee'));
    }

    public function update(Request $request)
    {
        $employee = $request->user();
        $data = $request->validate([
            'phone' => 'nullable|string',
        ]);
        $employee->update($data);
        return back()->with('success', 'Profile updated');
    }
}

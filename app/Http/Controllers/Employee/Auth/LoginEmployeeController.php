<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginEmployeeController extends Controller
{




    public function store(Request $request)
    {
        $this->validator($request);

        if (Auth::guard('employee')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->get('remember'))) {

            // Check if employee is active
            if (Auth::guard('employee')->user()->status != 1) {
                Auth::guard('employee')->logout();
                return redirect()
                    ->route('login_employee')
                    ->withInput()
                    ->with('error', __('back.account_inactive'));
            }

            return redirect()->intended(RouteServiceProvider::EMPLOYEE)
                ->with('success','تم تسجيل الدخول بنجاح .. أهلاً وسهلا بكم');
        }

        //Authentication failed...
        return $this->loginFailed();
    }


    public function destroy(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login_employee')->with('success','تم تسجبل الخروج بنجاح.. شكراً لكم ');
    }


    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'phone'    => 'required',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }


    private function loginFailed(){
        return redirect()
            ->route('login_employee')
            ->withInput()
            ->with('error', trans('auth.Username_and_password_error'));
    }








}

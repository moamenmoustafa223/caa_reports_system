<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $setting = Setting::first();
        return view('backend.pages.setting.index', compact('setting'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name_ar' => 'required',
            'company_name_en' => 'required',
        ]);

        $setting = Setting::find($id);

        if ($request->hasFile('logo')) {
            $image = $request->logo;
            $newImage = time() . $image->getClientOriginalName();
            $image->move('uploads/setting', $newImage);
            $setting->logo = 'uploads/setting/' . $newImage;
            $setting->save();
        }

        $setting->update([
            'company_name_ar' => $request->input('company_name_ar'),
            'company_name_en' => $request->input('company_name_en'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('success', trans('back.updated_successfully'));
    }
}

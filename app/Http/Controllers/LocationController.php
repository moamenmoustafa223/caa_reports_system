<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('backend.pages.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
        ], [
            'name_ar.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
        ]);

        Location::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status ?? 1,
        ]);

        toast('تم الإضافة بنجاح','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
        ], [
            'name_ar.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
        ]);

        $location = Location::find($id);

        $location->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'status' => $request->status ?? 1,
        ]);

        toast('تم التعديل بنجاح','success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}

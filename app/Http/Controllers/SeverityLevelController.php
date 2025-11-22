<?php

namespace App\Http\Controllers;

use App\Models\SeverityLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeverityLevelController extends Controller
{
    public function index()
    {
        $severityLevels = SeverityLevel::ordered()->get();
        return view('backend.pages.severity_levels.index', compact('severityLevels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_key' => 'required|string|max:255|unique:severity_levels,level_key',
            'name_ar' => 'required',
            'name_en' => 'required',
            'order' => 'required|integer',
            'color' => 'required',
        ], [
            'level_key.required' => 'المفتاح مطلوب',
            'level_key.unique' => 'المفتاح موجود مسبقا',
            'name_ar.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
            'order.required' => 'الترتيب مطلوب',
            'color.required' => 'اللون مطلوب',
        ]);

        SeverityLevel::create([
            'level_key' => $request->level_key,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'order' => $request->order,
            'color' => $request->color,
        ]);

        toast('تم الإضافة بنجاح','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $severityLevel = SeverityLevel::find($id);

        $request->validate([
            'level_key' => 'required|string|max:255|unique:severity_levels,level_key,' . $severityLevel->id,
            'name_ar' => 'required',
            'name_en' => 'required',
            'order' => 'required|integer',
            'color' => 'required',
        ], [
            'level_key.required' => 'المفتاح مطلوب',
            'level_key.unique' => 'المفتاح موجود مسبقا',
            'name_ar.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
            'order.required' => 'الترتيب مطلوب',
            'color.required' => 'اللون مطلوب',
        ]);

        $severityLevel->update([
            'level_key' => $request->level_key,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'order' => $request->order,
            'color' => $request->color,
        ]);

        toast('تم التعديل بنجاح','success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $severityLevel = SeverityLevel::find($id);
        $severityLevel->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}

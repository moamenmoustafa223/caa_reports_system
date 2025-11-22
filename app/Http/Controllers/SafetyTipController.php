<?php

namespace App\Http\Controllers;

use App\Models\SafetyTip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafetyTipController extends Controller
{
    public function index()
    {
        $safetyTips = SafetyTip::ordered()->get();
        return view('backend.pages.safety_tips.index', compact('safetyTips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
        ], [
            'title_ar.required' => 'العنوان بالعربي مطلوب',
            'title_en.required' => 'العنوان بالإنجليزي مطلوب',
            'description_ar.required' => 'الوصف بالعربي مطلوب',
            'description_en.required' => 'الوصف بالإنجليزي مطلوب',
        ]);

        SafetyTip::create([
            'user_id' => Auth::id(),
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'icon' => $request->icon,
            'order' => $request->order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        toast('تم الإضافة بنجاح','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
        ], [
            'title_ar.required' => 'العنوان بالعربي مطلوب',
            'title_en.required' => 'العنوان بالإنجليزي مطلوب',
            'description_ar.required' => 'الوصف بالعربي مطلوب',
            'description_en.required' => 'الوصف بالإنجليزي مطلوب',
        ]);

        $safetyTip = SafetyTip::find($id);

        $safetyTip->update([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'icon' => $request->icon,
            'order' => $request->order ?? 0,
            'status' => $request->status ?? 1,
        ]);

        toast('تم التعديل بنجاح','success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $safetyTip = SafetyTip::find($id);
        $safetyTip->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}

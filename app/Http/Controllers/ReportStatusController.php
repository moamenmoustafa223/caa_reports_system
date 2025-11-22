<?php

namespace App\Http\Controllers;

use App\Models\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportStatusController extends Controller
{
    public function index()
    {
        $reportStatuses = ReportStatus::all();
        return view('backend.pages.report_statuses.index', compact('reportStatuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'color' => 'required',
        ], [
            'name_ar.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
            'color.required' => 'اللون مطلوب',
        ]);

        ReportStatus::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'color' => $request->color,
            'description' => $request->description,
        ]);

        toast('تم الإضافة بنجاح','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'color' => 'required',
        ], [
            'name_ar.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
            'color.required' => 'اللون مطلوب',
        ]);

        $reportStatus = ReportStatus::find($id);

        $reportStatus->update([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'color' => $request->color,
            'description' => $request->description,
        ]);

        toast('تم التعديل بنجاح','success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $reportStatus = ReportStatus::find($id);
        $reportStatus->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}

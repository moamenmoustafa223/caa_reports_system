<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\CategoryEmployees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryEmployeesController extends Controller
{

    public function index()
    {
        $categoriesEmployees = CategoryEmployees::all();
        return view('backend.HR.CategoryEmployees.index', compact('categoriesEmployees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'required',
        ], [
            'name.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
        ]);

        CategoryEmployees::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'name_en' => $request->name_en,
            'notes' => $request->notes,
        ]);
        toast('تم الإضافة بنجاح','success');
        return redirect()->back();
    }




    public function show(CategoryEmployees $categoryEmployees)
    {
        //
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'name_en' => 'required',
        ], [
            'name.required' => 'الاسم عربي مطلوب',
            'name_en.required' => 'الاسم انجليزي مطلوب',
        ]);

        $categoryEmployees = CategoryEmployees::find($id);

        $categoryEmployees->update([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'name_en' => $request->name_en,
            'notes' => $request->notes,
        ]);

        toast('تم التعديل بنجاح','success');
        return redirect()->back();
    }




    public function destroy($id)
    {
        $categoryEmployees = CategoryEmployees::find($id);
        $categoryEmployees->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}

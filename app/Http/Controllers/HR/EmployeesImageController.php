<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\EmployeesImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeesImageController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,csv,xlsx,xls,docx|max:5048',
        ]);

        if ($image = $request->file('image')){
            $path = 'images/employeesImages/';
            $filename = time().$image->getClientOriginalName();
            $image->move($path, $filename);
            $data['image'] = $path.$filename;
        }

        $data['user_id'] = Auth::id();
        $data['employee_id'] = $request->employee_id;
        $data['name'] = $request->name;
        EmployeesImage::create($data);

        toast('تم الإضافة بنجاح','success');
        return redirect()->back();
    }




    public function destroy($id)
    {
        $employeesImage = EmployeesImage::find($id);
        $employeesImage->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }
}

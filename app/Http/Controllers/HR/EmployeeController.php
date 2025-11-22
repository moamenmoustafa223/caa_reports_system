<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\Employee;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{


    public function index(Request $request)
    {
        $search = $request->input('query');
        $employees = Employee::query()
            ->withCount('reports')
            ->where('name_ar', 'LIKE', "%{$search}%")
            ->orWhere('name_en', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orderBy('id', 'desc')->paginate(10);

        return view('backend.HR.Employees.index', compact('employees'));
    }


    public function create()
    {
        return view('backend.HR.Employees.add');
    }



    public function store(Request $request)
    {
        $request->validate([
            'category_employees_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'employee_no' => ['required', 'unique:employees,employee_no'],
            'phone' => ['required', 'unique:employees,phone'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'password' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,gif,png|max:20000',
            'Join_date' => 'nullable|date',
        ]);

        if ($image = $request->file('image')){
            $filename = time().$image->getClientOriginalName();
            $image->move('images/employees/', $filename);
            $data['image'] = 'images/employees/'.$filename;
        }

        $data['user_id'] = Auth::id();
        $data['category_employees_id'] = $request->category_employees_id;

        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;

        $data['employee_no'] = $request->employee_no;
        $data['Join_date'] = $request->Join_date;

        $data['phone'] = normalizePhoneNumber($request->phone, Setting::first()->phone_code ?? '968');

        $data['email'] = $request->email;
        $data['password'] = hash::make($request->password);

        $data['Nationality'] = $request->Nationality;
        $data['id_number'] = $request->id_number;
        $data['status'] = $request->status;

        Employee::create($data);

        toast('تم الإضافة بنجاح','success');
        return redirect()->route('Employees.index');
    }



    public function show($id)
    {
        $employee = Employee::find($id);
        return view('backend.HR.Employees.show', compact('employee'));
    }



    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('backend.HR.Employees.edit', compact('employee'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_employees_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'employee_no' => ['required', 'unique:employees,employee_no,' .$id],
            'phone' => ['required', 'unique:employees,phone,' .$id],
            'email' => ['required', 'email', 'unique:employees,email,' .$id],
            'image' => 'nullable|image|mimes:jpg,jpeg,gif,png|max:20000',
            'Join_date' => 'nullable|date',
        ]);

        $employee = Employee::find($id);

        if ($image = $request->file('image')){
            $filename = time().$image->getClientOriginalName();
            $image->move('images/employees/', $filename);
            $data['image'] = 'images/employees/'.$filename;
        }

        $data['user_id'] = Auth::id();
        $data['category_employees_id'] = $request->category_employees_id;

        $data['name_ar'] = $request->name_ar;
        $data['name_en'] = $request->name_en;

        $data['employee_no'] = $request->employee_no;
        $data['Join_date'] = $request->Join_date;

        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] = hash::make($request->password);
        }

        $data['Nationality'] = $request->Nationality;
        $data['id_number'] = $request->id_number;
        $data['status'] = $request->status;

        $employee->update($data);

        toast('تم التعديل بنجاح','success');
        return redirect()->route('Employees.index');
    }










    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee->reports()->count() > 0)
        {
            toast(__('back.cannot_delete_employee_has_reports'),'error');
            return redirect()->back();
        }

        $employee->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->back();
    }


}

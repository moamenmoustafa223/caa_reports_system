<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\HR\Message;
use App\Models\User;
use App\Notifications\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function index()
    {
        $employee = Auth::guard('employee')->user()->id;
        $messages = Message::where('employee_id', $employee)->orderBy('id', 'desc')->get();
        return view('Employee.messages', compact('messages'));
    }



    public function create()
    {
        return view('Employee.create_message');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'notes' => 'required',
        ], [
            'title.required' => 'عنوان الرسالة مطلوب',
            'notes.required' => 'وصف الرسالة مطلوب',
        ]);

        Message::create([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'notes' => $request->notes,
        ]);


        // ارسال اشعار للأدمن
        $user = User::first();
        $messageData = [
            'title' => 'رسالة جديدة من:',
            'body' => Auth::guard('employee')->user()->name_ar,
        ];
        $user->notify(new MessageNotification($messageData));

        toast('تم الإضافة بنجاح','success');
        return redirect()->route('Messages.index');
    }



    public function show(Message $message)
    {
        //
    }



    public function edit($id)
    {
        $message = Message::find($id);
        return view('Employee.edit_message', compact('message'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'notes' => 'required',
        ], [
            'title.required' => 'عنوان الرسالة مطلوب',
            'notes.required' => 'وصف الرسالة مطلوب',
        ]);

        $message = Message::find($id);
        $message->update([
            'employee_id' => $request->employee_id,
            'title' => $request->title,
            'notes' => $request->notes,
        ]);
        toast('تم التعديل بنجاح','success');
        return redirect()->route('Messages.index');
    }



    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        toast('تم الحذف بنجاح','success');
        return redirect()->route('Messages.index');
    }
}

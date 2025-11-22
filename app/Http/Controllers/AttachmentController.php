<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttachmentController extends Controller
{
    public function index()
    {
        $attachments = Attachment::orderBy('id', 'desc')->paginate(25);
        return view('backend.pages.attachments.index', compact('attachments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'attachment_name' => 'required|string',
            'file'            => 'nullable|file|max:5048',
        ]);
    
        $data['user_id'] = Auth::id();
        $data['student_id'] = $request->student_id;
        $data['attachment_name'] = $request->attachment_name;
    
        if ($file = $request->file('file')) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $path = 'uploads/attachments/';

            // Upload to local storage
            $file->move(public_path($path), $filename);
            $data['file'] = $path . $filename;
        }
    
        Attachment::create($data);
    
        toast('تم الإضافة بنجاح', 'success');
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);

        // Delete file from local storage
        if ($attachment->file && file_exists(public_path($attachment->file))) {
            unlink(public_path($attachment->file));
        }

        $attachment->delete();

        toast('تم الحذف بنجاح', 'success');
        return redirect()->back();
    }
}

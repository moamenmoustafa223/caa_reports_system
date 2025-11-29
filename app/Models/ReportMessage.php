<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HR\Employee;

class ReportMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'message',
        'sender_admin_id',
        'sender_employee_id',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the report that owns the message.
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Get the admin sender.
     */
    public function senderAdmin()
    {
        return $this->belongsTo(User::class, 'sender_admin_id');
    }

    /**
     * Get the employee sender.
     */
    public function senderEmployee()
    {
        return $this->belongsTo(Employee::class, 'sender_employee_id');
    }

    /**
     * Check if message was sent by admin.
     */
    public function isSentByAdmin()
    {
        return !is_null($this->sender_admin_id);
    }

    /**
     * Check if message was sent by employee.
     */
    public function isSentByEmployee()
    {
        return !is_null($this->sender_employee_id);
    }

    /**
     * Get the sender name.
     */
    public function getSenderNameAttribute()
    {
        if ($this->isSentByAdmin()) {
            return $this->senderAdmin->name ?? trans('back.admin');
        } elseif ($this->isSentByEmployee()) {
            if (app()->getLocale() == 'ar') {
                return $this->senderEmployee->name_ar ?? trans('back.employee');
            } else {
                return $this->senderEmployee->name_en ?? trans('back.employee');
            }
        }
        return trans('back.unknown');
    }
}

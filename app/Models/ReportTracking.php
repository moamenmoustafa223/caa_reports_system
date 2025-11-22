<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HR\Employee;

class ReportTracking extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'status_id',
        'comment',
        'changed_by_admin_id',
        'changed_by_employee_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the report that owns the tracking.
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Get the status.
     */
    public function status()
    {
        return $this->belongsTo(ReportStatus::class, 'status_id');
    }

    /**
     * Get the admin who changed the status.
     */
    public function changedByAdmin()
    {
        return $this->belongsTo(User::class, 'changed_by_admin_id');
    }

    /**
     * Get the employee who changed the status.
     */
    public function changedByEmployee()
    {
        return $this->belongsTo(Employee::class, 'changed_by_employee_id');
    }

    /**
     * Get localized comment based on current locale.
     */
    public function getCommentAttribute($value)
    {
        return $value;
    }

    /**
     * Get who changed the status (admin or employee).
     */
    public function getChangedByAttribute()
    {
        if ($this->changed_by_admin_id) {
            return $this->changedByAdmin;
        } elseif ($this->changed_by_employee_id) {
            return $this->changedByEmployee;
        }
        return null;
    }
}

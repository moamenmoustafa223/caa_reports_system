<?php

namespace App\Models\HR;

use App\Models\HR\EmployeesCourse;
use App\Models\HR\EmployeesImage;
use App\Models\HR\Holiday;
use App\Models\HR\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = [];

    //    protected $fillable = [
    //        'category_employees_id',
    //        'branch_id',
    //        'image',
    //        'name',
    //        'name_en',
    //        'email',
    //        'password',
    //        'id_number',
    //        'jop',
    //        'jop_en',
    //        'phone',
    //        'Nationality',
    //        'address',
    //        'notes',
    //    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function User()
    {
        return $this->belongsTo(User::class,);
    }



    public function CategoryEmployees()
    {
        return $this->belongsTo(CategoryEmployees::class);
    }


    public function employees_images()
    {
        return $this->hasMany(EmployeesImage::class);
    }


    // Reporting System Relationships
    public function reports()
    {
        return $this->hasMany(\App\Models\Report::class);
    }

    public function reportTrackings()
    {
        return $this->hasMany(\App\Models\ReportTracking::class, 'changed_by_employee_id');
    }

    /**
     * Get localized name based on current locale.
     */
    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function status()
    {
        return $this->status ? trans("back.active") : trans("back.inactive");
    }
}

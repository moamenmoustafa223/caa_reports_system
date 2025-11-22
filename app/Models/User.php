<?php

namespace App\Models;

use App\Models\HR\Allowance;
use App\Models\HR\CategoryAllowance;
use App\Models\HR\CategoryDiscounts;
use App\Models\HR\CategoryEmployees;
use App\Models\HR\CategoryHoliday;
use App\Models\HR\Contract;
use App\Models\HR\Discount;
use App\Models\HR\Employee;
use App\Models\HR\EmployeesCourse;
use App\Models\HR\Holiday;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;


    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //========================================== العلاقات


    public function Payment_methods()
    {
        return $this->hasMany(Payment_method::class);
    }



    public function category_employees()
    {
        return $this->hasMany(CategoryEmployees::class, );
    }


    public function employee()
    {
        return $this->hasMany(Employee::class, );
    }


    public function category_allowance()
    {
        return $this->hasMany(CategoryAllowance::class, );
    }


    public function allowance()
    {
        return $this->hasMany(Allowance::class, );
    }


    public function category_discounts()
    {
        return $this->hasMany(CategoryDiscounts::class, );
    }


    public function discount()
    {
        return $this->hasMany(Discount::class, );
    }


    public function category_holiday()
    {
        return $this->hasMany(CategoryHoliday::class, );
    }


    public function holiday()
    {
        return $this->hasMany(Holiday::class, );
    }

    public function contract()
    {
        return $this->hasMany(Contract::class, );
    }


    public function employees_course()
    {
        return $this->hasMany(EmployeesCourse::class, );
    }
}

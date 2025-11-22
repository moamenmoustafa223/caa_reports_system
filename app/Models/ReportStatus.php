<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'color',
        'description',
    ];

    /**
     * Get all reports with this status.
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'status_id');
    }

    /**
     * Get all trackings with this status.
     */
    public function trackings()
    {
        return $this->hasMany(ReportTracking::class, 'status_id');
    }

    /**
     * Get localized name based on current locale.
     */
    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    /**
     * Get localized description based on current locale.
     */
    public function getDescriptionAttribute($value)
    {
        return $value;
    }
}

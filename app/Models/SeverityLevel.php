<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeverityLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_key',
        'name_ar',
        'name_en',
        'order',
        'color',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get all reports with this severity level.
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Get localized name based on current locale.
     */
    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    /**
     * Scope to order by order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}

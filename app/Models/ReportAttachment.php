<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'file_path',
        'file_type',
        'name',
        'size',
    ];

    protected $casts = [
        'size' => 'decimal:3',
    ];

    /**
     * Get the report that owns the attachment.
     */
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Get the full URL of the attachment.
     */
    public function getUrlAttribute()
    {
        // Return local asset URL
        return asset($this->file_path);
    }

    /**
     * Check if the attachment is an image.
     */
    public function isImage()
    {
        return $this->file_type === 'image';
    }

    /**
     * Check if the attachment is an audio file.
     */
    public function isAudio()
    {
        return $this->file_type === 'audio';
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedSizeAttribute()
    {
        $size = $this->size;
        if ($size < 1) {
            return round($size * 1024, 2) . ' KB';
        }
        return round($size, 2) . ' MB';
    }
}

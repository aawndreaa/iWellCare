<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecordAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'mime_type',
        'description',
        'status',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Get the medical record that owns the attachment.
     */
    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    /**
     * Scope a query to only include active attachments.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedFileSizeAttribute(): string
    {
        if (!$this->file_size) {
            return 'N/A';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Get the file extension from file name.
     */
    public function getFileExtensionAttribute(): string
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    /**
     * Check if attachment is an image.
     */
    public function isImage(): bool
    {
        return in_array(strtolower($this->file_extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
    }

    /**
     * Check if attachment is a document.
     */
    public function isDocument(): bool
    {
        return in_array(strtolower($this->file_extension), ['pdf', 'doc', 'docx', 'txt', 'rtf']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $patient_id
 * @property int $doctor_id
 * @property int $consultation_id
 * @property \Carbon\Carbon $record_date
 * @property string $record_type
 * @property string $title
 * @property string $description
 * @property string $diagnosis
 * @property string $treatment_plan
 * @property array $medications
 * @property array $allergies
 * @property array $clinical_measurements
 * @property array $lab_results
 * @property array $imaging_results
 * @property string $notes
 * @property string $status
 * @property string $file_path
 * @property string $file_name
 * @property int $file_size
 * @property string $file_type
 */
class MedicalRecord extends Model
{
    use HasFactory;

    protected $patient_id;
    protected $doctor_id;
    protected $consultation_id;
    protected $record_date;
    protected $record_type;
    protected $title;
    protected $description;
    protected $diagnosis;
    protected $treatment_plan;
    protected $medications;
    protected $allergies;
    protected $clinical_measurements;
    protected $lab_results;
    protected $imaging_results;
    protected $notes;
    protected $status;
    protected $file_path;
    protected $file_name;
    protected $file_size;
    protected $file_type;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'consultation_id',
        'record_date',
        'record_type',
        'title',
        'description',
        'diagnosis',
        'treatment_plan',
        'medications',
        'allergies',
        'clinical_measurements',
        'lab_results',
        'imaging_results',
        'notes',
        'status',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
    ];

    protected $casts = [
        'record_date' => 'date',
        'clinical_measurements' => 'array',
        'lab_results' => 'array',
        'imaging_results' => 'array',
        'medications' => 'array',
        'allergies' => 'array',
    ];

    /**
     * Get the patient that owns the medical record.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the doctor that created the medical record.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the consultation associated with this medical record.
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }

    /**
     * Get the attachments for this medical record.
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(MedicalRecordAttachment::class);
    }

    /**
     * Scope a query to only include active medical records.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include medical records by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('record_type', $type);
    }

    /**
     * Scope a query to only include medical records by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get the record type badge class.
     */
    public function getRecordTypeBadgeClassAttribute(): string
    {
        return match ($this->record_type) {
            'consultation' => 'badge bg-primary',
            'lab_result' => 'badge bg-info',
            'imaging' => 'badge bg-warning',
            'prescription' => 'badge bg-success',
            'vaccination' => 'badge bg-secondary',
            'surgery' => 'badge bg-danger',
            'emergency' => 'badge bg-dark',
            default => 'badge bg-light text-dark',
        };
    }

    /**
     * Get the status badge class.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'active' => 'badge bg-success',
            'archived' => 'badge bg-secondary',
            'pending' => 'badge bg-warning',
            'cancelled' => 'badge bg-danger',
            default => 'badge bg-light text-dark',
        };
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedFileSizeAttribute(): string
    {
        if (! $this->getAttribute('file_size')) {
            return 'N/A';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->getAttribute('file_size');
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2).' '.$units[$unit];
    }

    /**
     * Check if medical record has attachments.
     */
    public function hasAttachments(): bool
    {
        return $this->attachments()->count() > 0;
    }

    /**
     * Get clinical measurements as formatted string.
     */
    public function getClinicalMeasurementsTextAttribute(): string
    {
        if (empty($this->clinical_measurements)) {
            return 'Not recorded';
        }

        $formatted = [];
        foreach ($this->clinical_measurements as $key => $value) {
            $formatted[] = ucfirst(str_replace('_', ' ', $key)).': '.$value;
        }

        return implode(', ', $formatted);
    }

    /**
     * Get medications as formatted string.
     */
    public function getMedicationsTextAttribute(): string
    {
        if (empty($this->medications)) {
            return 'None prescribed';
        }

        return implode(', ', $this->medications);
    }

    /**
     * Get allergies as formatted string.
     */
    public function getAllergiesTextAttribute(): string
    {
        if (empty($this->allergies)) {
            return 'None known';
        }

        return implode(', ', $this->allergies);
    }

    /**
     * Get lab results as formatted string.
     */
    public function getLabResultsTextAttribute(): string
    {
        if (empty($this->lab_results)) {
            return 'No lab results';
        }

        $formatted = [];
        foreach ($this->lab_results as $test => $result) {
            $formatted[] = $test.': '.$result;
        }

        return implode(', ', $formatted);
    }

    /**
     * Check if medical record is recent (within last 30 days).
     */
    public function isRecent(): bool
    {
        return $this->record_date->diffInDays(now()) <= 30;
    }

    /**
     * Get the medical record type display name.
     */
    public function getRecordTypeDisplayAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->record_type));
    }
}

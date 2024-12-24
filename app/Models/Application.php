<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'applicant_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'resume',
        'coverletter',
        'interest',
        'expected_salary',
        'currency',
        'status'
    ];

    public function job():BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function applicant():BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}

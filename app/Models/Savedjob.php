<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Savedjob extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'job_id'
    ];

    public function applicants():BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function jobs():BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}

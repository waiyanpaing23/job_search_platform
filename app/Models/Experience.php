<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'job_title',
        'company',
        'start_date',
        'end_date',
        'responsibilities'
    ];

    public function applicant():BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'description',
        'job_type',
        'category_id',
        'location',
        'requirement',
        'benefit',
        'min_salary',
        'max_salary',
        'currency',
        'salary_type',
        'expiry_date',
        'employer_id',
        'contact_email',
        'status'
    ];

    public function employer():BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function applications():HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function savedjob():HasMany
    {
        return $this->hasMany(Savedjob::class);
    }
}

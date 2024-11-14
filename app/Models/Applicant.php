<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'phone',
        'address',
        'date_of_birth',
        'resume',
        'profile'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function experiences():HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function educations():HasMany
    {
        return $this->hasMany(Education::class);
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

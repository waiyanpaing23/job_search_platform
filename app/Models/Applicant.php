<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'phone',
        'address',
        'date_of_birth',
        'bio',
        'about',
        'linkedin',
        'github',
        'twitter',
        'portfolio_link'
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

    public function skills():BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'applicant_skill');
    }
}

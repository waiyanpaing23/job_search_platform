<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_logo',
        'company_name',
        'company_description',
        'website_url',
        'industry',
        'company_size',
        'location',
        'contact_email',
        'phone',
        'status'
    ];

    public function employers():HasMany
    {
        return $this->hasMany(Employer::class);
    }

    public function jobs():HasMany
    {
        return $this->hasMany(Job::class);
    }

    // public function jobs()
    // {
    //     return $this->hasManyThrough(Job::class, Employer::class);
    // }

}

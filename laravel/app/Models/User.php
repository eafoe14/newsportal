<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ДОБАВЛЯЕМ ЭТОТ КОД:
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'company_info'
    ];

    // Relationships
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function processedApplications()
    {
        return $this->hasMany(Application::class, 'processed_by');
    }

    // Helpers
    public function isAdvertiser()
    {
        return $this->role === 'advertiser';
    }

    public function isRegularUser()
    {
        return $this->role === 'user';
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'admin_comment',
        'processed_by',
        'processed_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Status helpers
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'pending' => 'status-pending',
            'approved' => 'status-approved',
            'rejected' => 'status-rejected',
            'in_progress' => 'status-in-progress',
            default => 'status-pending'
        };
    }

    public function getStatusText()
    {
        return match($this->status) {
            'pending' => 'На рассмотрении',
            'approved' => 'Одобрена',
            'rejected' => 'Отклонена',
            'in_progress' => 'В работе',
            default => 'На рассмотрении'
        };
    }
}
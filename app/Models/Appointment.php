<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'architect_id',
        'start_date',
        'end_date',
        'message',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function architect()
    {
        return $this->belongsTo(User::class, 'architect_id');
    }

    public function scopeApprovedAppointments($query)
    {
        return $query->where('status', 'approved');
    }
}

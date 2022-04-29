<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'architect_id',
        'start_date',
        'end_date',
        'message',
        'architect_message',
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

    public function scopeFutureAppointments($query)
    {
        return $query->where('end_date', '>=', Carbon::now());
    }
}

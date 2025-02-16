<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentActivity extends Model
{
    use HasFactory;

    protected $table = 'recent_activities';
    protected $fillable = [
        'activity_type',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}

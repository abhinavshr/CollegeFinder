<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'college_id',
        'course_name',
        'course_code',
        'duration',
        'course_type',
        'fees',
        'eligibility',
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(Colleges::class, 'college_id');
    }
}

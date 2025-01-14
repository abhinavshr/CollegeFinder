<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarships extends Model
{
    use HasFactory;

    protected $table = 'scholarships';

    protected $fillable = [
        'college_id',
        'scholarship_name',
        'eligibility',
        'benefits',
    ];

    public function college()
    {
        return $this->belongsTo(Colleges::class);
    }
}

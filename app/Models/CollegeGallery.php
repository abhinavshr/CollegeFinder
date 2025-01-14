<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeGallery extends Model
{
    use HasFactory;

    protected $table = 'collegegallerys';

    protected $fillable = [
        'college_id',
        'image',
        'caption',
    ];

    public function college()
{
    return $this->belongsTo(Colleges::class);
}

}

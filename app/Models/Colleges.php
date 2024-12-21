<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colleges extends Model
{
    use HasFactory;

    protected $table = 'colleges';

    protected $fillable = [
        'college_admin_id',
        'name',
        'location',
        'city',
        'contact_email',
        'contact_phone',
        'website',
        'description',
        'logo',
        'affiliated_university',
        'level_of_education',
        'course_offered',
        'alumni_network',
        'placement_availability',
        'entrance_exams_required',
        'country',
    ];

    public function collegeAdmin()
    {
        return $this->belongsTo(CollegeAdmin::class, 'college_admin_id');
    }
}

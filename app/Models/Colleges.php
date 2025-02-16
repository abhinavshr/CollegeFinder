<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function scholarships()
    {
        return $this->hasMany(Scholarships::class, 'college_id');
    }
    public function courses(): HasMany
    {
        return $this->hasMany(Courses::class, 'college_id');
    }

    protected static function booted() {
        static::created(function ($college) {
            RecentActivity::create([
                'activity_type' => 'New College Added',
                'message' => 'New college "' . $college->name . '" was added.',
            ]);
        });

        static::updated(function ($college) {
            RecentActivity::create([
                'activity_type' => 'College Info Updated',
                'message' => 'College "' . $college->name . '" was updated.',
            ]);
        });
    }


}

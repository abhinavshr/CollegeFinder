<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CollegeAdmin extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'college_name',
        'college_email',
        'password',
        'admin_profile',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

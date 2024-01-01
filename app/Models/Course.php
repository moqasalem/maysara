<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    // protected array $guarded = [''];
    protected $guarded = [
        'id', // Example: If 'id' should not be mass assignable
    ];
//    public function students(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return $this->belongsToMany(User::class,'course_user', 'course_id', 'user_id');
//    }

    public function students(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseStudent::class,'course_id', 'id');
    }
    public function assessments()
{
    return $this->hasMany(Assessment::class,'course_id');
}
}

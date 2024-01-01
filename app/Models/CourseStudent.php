<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;
    // protected array $guarded = [''];
    protected $guarded = [
        'id', // Example: If 'id' should not be mass assignable
    ];
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}

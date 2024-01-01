<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $fillable=[
        'course_id',
        'type',
        'title',
        'body',
        'report',
    ];

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
}

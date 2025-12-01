<?php

namespace App\Models;

use App\Models\Course;
use App\Models\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'university_id', 'course_id', 'image', 'description'];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

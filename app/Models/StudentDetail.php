<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Country;
use App\Models\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentDetail extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone_no', 'email', 'country_id', 'university_id', 'course_id', 'intake_month_year', 'image', 'documents'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

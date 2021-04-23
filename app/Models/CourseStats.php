<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStats extends Model
{
    
    protected $fillable = [
        'total_reviews',
        'average_reviews',
        'total_video_hours',
        'total_minutes',
        'durationHMS',
        'total_articles',
        'sales_this_month',
        'total_sales',
        'total_hours',
        'total_lessons',
        'total_quizzes',
        'total_published_lessons',
        'total_students',
        'enrolled_this_month',
        'total_unanswered_questions',
    ];

    public function course()
    {
        return belongsTo(Course::class);
    }
}

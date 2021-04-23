<?php

namespace App\Models;

use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use Glorand\Model\Settings\Traits\HasSettingsField;
use App\Models\Auth\BaseUser;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope,
        HasSettingsField;

    public function authored_courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }
    
    public function enrollments()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')->withTimestamps();
    }

    public function students()
    {
        $courses = $this->authored_courses->pluck('id');
        $students = \DB::table('enrollments')
                            ->whereIn('course_id', $courses)
                            ->pluck('user_id');
                            
        return $this->whereIn('id', $students)->get();
    }
    
    public function completions()
    {
        return $this->belongsToMany(Lesson::class, 'completions', 'user_id', 'lesson_id')->withTimestamps();
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
    public function sales()
    {
        return $this->hasManyThrough(Payment::class, Course::class);
    }
    
    public function course_reviews()
    {
        return $this->hasManyThrough(Review::class, Course::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'user_id');
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function purchases()
    {
        return $this->hasMany(Payment::class, 'payer_id');
    }
    
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }
    
    public function refunds()
    {
        return $this->hasMany(Refund::class, 'requester_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
    
    /****** USER METHODS *********/
    public function canAccessCourse($course)
    {
        return (bool)$this->enrollments()->where('course_id', $course->id)->count()
                || (bool)$this->authored_courses()->where('id', $course->id)->count();
                // || (bool)$this->hasRole('Administrator');
            
    }
    
    public function hasCompletedLesson($lesson)
    {
        return (bool)$this->completions()->where('lessons.id', $lesson->id)->count();
    }
    
    public function hasCompletedCourse($course)
    {
        return (bool)$this->certificates()->where('course_id', $course->id)->count();
    }
    
    public function percentCompleted($course)
    {
        $total_lessons = $course->lessons()->hasContent()->count();
        $lessons_array = $course->lessons->pluck('id');
        $user_completed = $this->completions()->whereIn('lessons.id', $lessons_array)->count();
        
        if($total_lessons > 0){
            $percent_completed = ($user_completed/$total_lessons)*100;
        } else {
            $percent_completed = 0;
        }
        
        return (int)$percent_completed;
    }
    
    
    public function percentSectionCompleted($section)
    {
        $total_lessons = $section->lessons->count();
        $total_lessons_completed_by_user = $this->completions()->where('section_id', $section->id)->count();
        if($total_lessons > 0){
            $pcnt = ($total_lessons_completed_by_user / $total_lessons) * 100;
            $x = round($pcnt/5) * 5;
        } else {
            $x = 0;
        }
        
        return $x;
    }
    
    public function isAuthor()
    {
        return (bool)$this->courses->count();
    }

    public function isCourseAuthor(Course $course)
    {
        return (bool)$this->authored_courses()->where('id', $course->id)->count();
    }
}

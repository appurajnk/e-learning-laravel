<?php

namespace App\Models\Methods;

use App\Models\Payment;
use App\Models\Lesson;

/**
 * Trait UserMethod.
 */
trait CourseMethods
{
    public function get_average_reviews()
    {
        return round($this->reviews()->avg('rating'),1);
    }

    public function get_total_reviews()
    {
        return $this->reviews()->count();
    }

    public function get_total_students()
    {
        return $this->students()->count();
    }

    public function get_enrollments_this_month()
    {
            $now = \Carbon\Carbon::now();
            $enrolled_this_month = $this->students()
                                        ->whereBetween('enrollments.created_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])
                                        ->count('enrollments.id');
            return $enrolled_this_month;
    }

    public function get_sales_this_month()
    {
 
        $now = \Carbon\Carbon::now();
        $sales_earnings_this_month = Payment::where('course_id', $this->id)
                                        ->whereBetween('created_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])
                                        ->whereNull('refunded_at')
                                        ->sum('author_earning');
                                        
        return $sales_earnings_this_month;
    }

    public function get_total_sales()
    {
        return Payment::where('course_id', $this->id)
                    ->whereNull('refunded_at')
                    ->sum('author_earning');
    }

    public function get_total_lessons()
    {
        return $this->lessons()->count();
    }

    public function get_total_published_lessons()
    {
        if(!$this->lessons) return 0;
        return $this->lessons()->hasContent()->count();
        
    }

    public function get_total_unanswered_questions()
    {
        return $this->questions()->doesntHave('comments')->count();
    }

    public function get_total_hours()
    {
        $q = $this->lessons()->whereIn('content_type', ['video', 'article', 'youtube'])->sum('duration');
        $duration = round( $q/60, 1);   
        return $duration;
    }

    public function get_total_video_hours()
    {
        $q = $this->lessons()->whereIn('content_type', ['video', 'youtube'])->sum('duration');
        $duration = round( $q/60, 1);   
        return $duration;
    }

    public function get_total_articles()
    {
        return $this->lessons()->where('content_type', 'article')->count();
    }

    public function get_duration_hms()
    {
        return convert_hours_to_duration($this->get_total_hours());
    }


    public function get_percent_complete()
    {
        return auth()->check() ? auth()->user()->percentCompleted($this) : null;
    }
    
}

<?php

namespace App\Listeners;

use App\Events\UpdateCourseStats;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateCourseStatsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateCourseStats  $event
     * @return void
     */
    public function handle(UpdateCourseStats $event)
    {
        /* STATS
        'total_reviews',x
        'average_rating'x

        'total_video_hours',
        'total_minutes',
        'durationHMS',
        'total_articles',
        'sales_this_month',
        'total_sales',x
        'total_hours',
        'total_lessons',
        'total_quizzes',
        'total_published_lessons',
        'total_students',x
        'enrolled_this_month',x
        'total_unanswered_questions',
        */

        $course = $event->course;
        $stat = $event->stat;
        // calculate sales this month

        switch ($stat){
            case "total_reviews":
                $data = [
                    "total_reviews" => $course->get_total_reviews(),
                    "average_rating" => $course->get_average_reviews()
                ];
                $this->updateStats($course, $data);
                break;
                    
            case "total_students":
            case "total_sales":
                $data = [
                    "total_students" => $course->get_total_students(),
                    "enrolled_this_month" => $course->get_enrollments_this_month(),
                    "total_sales" => $course->get_total_sales(),
                    "sales_this_month" => $course->get_sales_this_month()
                ];
                $this->updateStats($course, $data);
                
                break;

            case "course_content_stats":
                $data = [
                    "total_video_hours" => $course->get_total_video_hours(),
                    "durationHMS" => $course->get_duration_hms(),
                    "total_articles" => $course->get_total_articles(),
                    "total_hours" => $course->get_total_hours(),
                    "total_published_lessons" => $course->get_total_published_lessons(),
                    "total_lessons" => $course->get_total_lessons(),
                    "total_unanswered_questions" => $course->get_total_unanswered_questions()
                ];
                
                $this->updateStats($course, $data);
                break;
            default: 
                // do nothing
        }

    }


    protected function updateStats($course, array $data)
    {
        $course->settings()->setMultiple($data);
        return true;
    }


}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseSimpleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'approved' => $this->approved,
            'status_code' => $this->status_code,
            'average_review' => $this->average_review,
            'description' => $this->description,
            'durationHMS' => $this->durationHMS,
            'enrolled_this_month' => $this->enrolled_this_month,
            'featured' => $this->featured,
            'is_in_cart' => $this->is_in_cart,
            'author' => [
                'uuid' => $this->author->uuid,
                'username' => $this->author->username,
                'full_name' => $this->author->full_name,
            ],
            'images' => [
                'thumbnail' => $this->thumbnail,
                'cover_image' => $this->cover_image,
            ],
            'language' => $this->language,
            'level' => $this->level,
            'percent_completed' => $this->percent_completed,
            'price' => $this->price,
            'price_discounted' => $this->price_discounted,
            'published' => $this->published,
            'sales_this_month' => $this->sales_this_month,
            'short_description' => $this->short_description,
            'slug' => $this->slug,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'total_articles' => $this->total_articles,
            'total_hours' => $this->total_hours,
            'total_lessons' => $this->total_lessons,
            'total_minutes' => +$this->total_minutes,
            'total_published_lessons' => $this->total_published_lessons,
            'total_quizzes' => $this->total_quizzes,
            'total_reviews' => $this->total_reviews,
            'total_sales' => $this->total_sales,
            'total_students' => $this->total_students,
            'total_video_hours' => $this->total_video_hours,
            'updated_at' => $this->updated_at,
            'uuid' => $this->uuid,
            'tags' => $this->tags
        ];
    }
}

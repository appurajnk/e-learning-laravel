<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'article_body' => $this->article_body,
            'content_type' => $this->content_type,
            'course_id' => $this->course_id,
            'description' => $this->description,
            'durationHMS' => $this->durationHMS,
            'image' => $this->image,
            'duration' => $this->duration,
            'lesson_type' => $this->lesson_type,
            'minutes_seconds' => $this->minutes_seconds,
            'preview' => $this->preview,
            'section_id' => $this->section_id,
            'sortOrder' => $this->sortOrder,
            'title' => $this->title,
            'user_has_completed' => $this->user_has_completed,
            'uuid' => $this->uuid,
            'video_provider' => $this->video_provider,
            'type' => $this->content_type == 'video' || $this->content_type == 'youtube' ? 'video/'.$this->video_provider : null,
            'video' => new VideoResource($this->video),
            'has_content' => ! is_null($this->content_type),
            'video_links' => $this->video_links
        ];
    }
}

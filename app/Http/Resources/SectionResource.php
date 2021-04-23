<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'course_id' => $this->course_id,
            //'durationHMS' => $this->durationHMS,
            'lessons' => LessonResource::collection($this->whenLoaded('lessons')),
            'objective' => $this->objective,
            'sortOrder' => $this->sortOrder,
            'title' => $this->title,
            // 'total_minutes' => $this->total_minutes,
            'uuid' => $this->uuid
        ];
    }
}

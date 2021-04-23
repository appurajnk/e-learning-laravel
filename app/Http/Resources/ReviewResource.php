<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'body' => $this->body,
            'course_id' => $this->course_id,
            'course' => new CourseResource($this->whenLoaded('course')),
            'user' => new UserResource($this->whenLoaded('user')),
            'rating' => (float)$this->rating,
            'title' => $this->title,
            'uuid' => $this->uuid,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'comments' => $this->whenLoaded('comments'),
            'timeago' => $this->timeago

            //RequirementsResource::collection($this->whenLoaded('what_to_learn')),
        ];
    }
}

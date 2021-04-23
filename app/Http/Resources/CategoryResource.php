<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'slug' => $this->slug,
            'image' => $this->image,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'sortOrder' => $this->sortOrder,
            'live' => $this->live,
            'courses' => CourseResource::collection($this->whenLoaded('courses')),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'parent' =>  $this->when( $this->parent_id, function () {
                            return [
                                    'name' => $this->parent->name,
                                    'slug' => $this->parent->slug,
                                    'uuid' => $this->parent->uuid
                                ];
                        }),
        ];
    }
}

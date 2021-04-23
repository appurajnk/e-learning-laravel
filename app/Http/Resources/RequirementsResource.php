<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequirementsResource extends JsonResource
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
            'sortOrder' => $this->sortOrder,
            'text' => $this->text,
            'type' => $this->type,
            'uuid' => $this->uuid
        ];
    }
}

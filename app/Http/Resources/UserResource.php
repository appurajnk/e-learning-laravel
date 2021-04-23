<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'uuid' => $this->uuid,
            'active' => $this->active ? 'yes' : 'no',
            'full_name' => $this->full_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' =>  auth()->check() && (auth()->user()->can('view backend') || auth()->id() == $this->id) ? $this->email : 'xxxxx@xxx.xxx',
            'confirmed' => $this->confirmed_label,
            'roles_label' => $this->roles_label,
            'bio' => $this->bio,
            'picture' => $this->picture,
            'tagline' => $this->tagline,
            'average_review' => $this->average_review,
            'total_reviews' => $this->total_reviews,
            'total_courses' => $this->total_courses,
            'total_students' => $this->total_students,
            'username' => $this->username,
            'website' => $this->website,
            'youtube' => $this->youtube,
            'facebook' => $this->facebook,
            'github' => $this->github,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'has_purchases' => $this->has_purchases,
            'has_refunds' => $this->has_refunds,
            'authored_courses' => CourseResource::collection($this->whenLoaded('authored_courses')),
            //'roles' => $this->getRoleNames(),
            'isAdmin' => $this->hasRole('administrator'),
            'links' => [
                //'show' => route('frontend.user.show', ['username' => $this->username]),
                'actions' => auth()->check() && auth()->user()->can('view backend') ? $this->action_buttons : null
            ],
        ];
    }
}

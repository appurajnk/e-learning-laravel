<?php

namespace App\Repositories\Eloquent;

use App\Models\Announcement;
use App\Models\Course;
use App\Repositories\Contracts\IAnnouncement;
use App\Http\Resources\AnnouncementResource;


class AnnouncementRepository extends RepositoryAbstract implements IAnnouncement
{
    
    public function entity()
    {
        return Announcement::class;
    }
    
    public function fetchAuthorAnnouncements(array $data)
    {
        $announcements = auth()->user()
                            ->announcements()
                            ->orderBy($data['sort'], $data['direction'])
                            ->with('courses');
        
        if($data['query']){
            $announcements = $announcements->where('title', 'LIKE', '%'.$data['query'].'%');
        }

        $announcements = $announcements->paginate($data['limit']);

        return $announcements;
    }
    
    public function fetchAnnouncements(array $data, $course_uuid)
    {
        $course = Course::where('uuid', $course_uuid)->first();
        $announcements = $course->announcements()->with(['user'])
                                ->latest()
                                ->paginate(1, ['*'], 'page', $data['page']);
        return $announcements;
    }
    
    public function fetchAnnouncement($uuid)
    {
        $announcement = Announcement::where('uuid', $uuid)->first();
        return $announcement;
    }
    
    public function storeAnnouncement(array $data)
    {
        $announcement = Announcement::create([
                            'title' => $data['title'],
                            'body' => $data['body'],
                            'user_id' => auth()->id(),
                            'slug' => time() . '-' . \Str::slug($data['title'])
                        ]);

        $announcement->courses()->attach($data['courses']);
        
        return $announcement;
    }

    public function updateAnnouncement(array $data, $id)
    {
        $announcement = Announcement::find($id);
        $announcement->update([
            'title' => $data['title'],
            'body' => $data['body']
        ]);
        $announcement->courses()->sync($data['courses']);
    }
    
    public function destroyAnnouncement($uuid)
    {
        $announcement = Announcement::where('uuid', $uuid)->first();
        $announcement->courses()->detach();
        $announcement->delete();
    }

    
}
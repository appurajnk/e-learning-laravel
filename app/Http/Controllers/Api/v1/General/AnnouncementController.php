<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Repositories\Contracts\IAnnouncement;
use App\Http\Resources\AnnouncementResource;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    
    protected $announcements;
    
    public function __construct(IAnnouncement $announcements)
    {
        $this->announcements = $announcements;
    }   

    public function fetchAnnouncements(Request $request, $course_uuid)
    {
        $announcements = $this->announcements->fetchAnnouncements($request->all(), $course_uuid);
        return response()->json($announcements, 200);
    }
    
    public function fetchAnnouncement($uuid)
    {
        $announcement = $this->announcements->fetchAnnouncement($uuid);
        return new AnnouncementResource($announcement);
    }
    
}

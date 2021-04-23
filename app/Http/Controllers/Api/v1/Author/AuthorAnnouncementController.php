<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Repositories\Contracts\IAnnouncement;
use App\Http\Resources\AnnouncementResource;
use App\Http\Controllers\Controller;

class AuthorAnnouncementController extends Controller
{
    
    protected $announcements;
    
    public function __construct(IAnnouncement $announcements)
    {
        $this->announcements = $announcements;
    }   

    public function fetchAuthorAnnouncements(Request $request)
    {
        $announcements = $this->announcements->fetchAuthorAnnouncements($request->all());
        return AnnouncementResource::collection($announcements);
    }

    
    public function storeAnnouncement(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required',
            'courses' => 'required'
        ]);
        $announcement = $this->announcements->storeAnnouncement($request->all());
        return new AnnouncementResource($announcement);
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required',
            'courses' => 'required'
        ]);
        $announcement = $this->announcements->updateAnnouncement($request->all(), $id);
        return new AnnouncementResource($announcement);
    }
    
    public function destroyAnnouncement($uuid)
    {
        $this->announcements->destroyAnnouncement($uuid);
        return response()->json(null, 200);
    }

}

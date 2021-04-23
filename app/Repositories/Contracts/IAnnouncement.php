<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IAnnouncement extends IRepository
{
    
    public function fetchAuthorAnnouncements(array $data);
    public function fetchAnnouncements(array $data, $course_uuid);
    public function fetchAnnouncement($uuid);
    public function storeAnnouncement(array $data);
    public function destroyAnnouncement($uuid);
    public function updateAnnouncement(array $data, $id);
    
}
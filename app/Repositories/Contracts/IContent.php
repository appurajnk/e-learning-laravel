<?php
namespace App\Repositories\Contracts;

interface IContent extends IRepository
{
    
    public function findByLesson($id);
    public function deleteVideo($fileName);
    public function destroyVideo($lessonId);
    public function createYoutube(array $data);
    public function updateDuration($id, $duration);
    public function updateArticle(array $data);
    public function createVideoContent(array $data, $lessonId);
    

}
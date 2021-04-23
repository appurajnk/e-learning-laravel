<?php
namespace App\Repositories\Contracts;


use Illuminate\Http\Request;


interface ICourseTarget extends IRepository
{
    
    public function createOrUpdate(array $data, $id);
    public function fetchCourseRequirements($id);
    public function updateDraggable(array $data);
    
}
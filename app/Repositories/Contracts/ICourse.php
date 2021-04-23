<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;


interface ICourse extends IRepository
{
    
    public function create(array $data);
    
    public function findByUuid($uuid);
    
    public function findBySlug($slug);
    
    public function update(array $data, $id);
    
    public function updatePrice(array $data, $id);
    
    public function updateCourseImage($filename, $id);
    
    public function search(Request $request);
    
    public function getFilterParameters($category);
    
    public function findWhereIn($field, array $data);
    
    public function checkIfUserCanAccess($id);

    public function checkIfUserCanAccessBySlug($slug);
    
    public function fetchDashboardHeaderInformation($id);
    
    public function resetProgress($id);
    
    public function fetchOverviewInfo($id);
    
    public function submitForReview($uuid);
    
    public function getAdminCourses(array $data);
    
    public function approve(Request $request, $uuid);
    
    public function fetchCourseApprovals($uuid);

    public function getAutocomplete($search_term);

    public function getFirstVideoLesson($course);

    public function getAttachments($id);
    
}
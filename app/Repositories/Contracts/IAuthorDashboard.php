<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IAuthorDashboard extends IRepository
{
    
    public function findAuthorCourses(array $data);
    public function findAuthorReviews(array $data);
    
}
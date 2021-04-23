<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IUserDashboard extends IRepository
{
    
    public function findUserCourseCategories();
    public function findUserCourses(array $data);
    public function fetchPurchaseHistory(array $data);

}
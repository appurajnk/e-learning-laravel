<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IUser extends IRepository
{
    
    public function getAll(array $data);
    public function findByUuid($uuid);
    public function findByUsername($username);
    public function getAutocomplete($search_term);
    public function toggleActive($id);
    public function enroll(array $data);
    public function getUnenrolledCourses($uuid);
    public function unenroll($user, $course);

}
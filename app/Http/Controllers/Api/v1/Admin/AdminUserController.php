<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Inertia\Inertia;
use App\Repositories\Contracts\IUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class AdminUserController extends Controller
{
    
    protected $users;


    public function __construct(IUser $users)
    {
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $users = $this->users->getAll($request->all());
        return UserResource::collection($users);
    }

    public function fetchUser($uuid)
    {
        $user = $this->users->findByUuid($uuid);
        return response()->json($user, 200);
    }

    public function toggleActive($id)
    {
        $user = $this->users->toggleActive($id);
    }

    public function enroll(Request $request)
    {
        $this->validate($request, [
            'course' => 'required',
            'user' => 'required'
        ]);

        $this->users->enroll($request->all());
    }

    public function unenroll(Request $request)
    {
        $this->users->unenroll($request->user, $request->course);
        
    }

    public function getUnenrolledCourses($uuid)
    {
        $courses = $this->users->getUnenrolledCourses($uuid);
        return response()->json($courses, 200);
    }

}

<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IUser;

class UserRepository  extends RepositoryAbstract implements IUser
{
    public function entity()
    {
        return User::class;
    }
    
    public function findByUsername($username)
    {
        $user = User::where('username', $username)
                    ->with(['authored_courses' => function($q){
                        $q->where('published', true) 
                            ->where('approved', true);
                    }, 
                        'authored_courses.what_to_learn',
                        'authored_courses.requirements',
                        'authored_courses.target_students'
                    ])->first();
        return $user;
    }


    public function getAutocomplete($search_term)
    {
        $users = User::where(function($q) use ($search_term){
                    $q->where('first_name', 'LIKE', '%'.$search_term.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search_term.'%')
                    ->orWhere('username', 'LIKE', '%'.$search_term.'%');
                })->get();

        return $users;
    }

    /********************** ADMIN ROUTES ***********************/
    public function getAll(array $data)
    {
        $builder = (new User)->newQuery();
        if($data['query']){
            $term = $data['query'];
            $builder->where(function($q) use ($term){
                $q->where('first_name', 'LIKE', '%'.$term.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$term.'%')
                    ->orWhere('email', 'LIKE', '%'.$term.'%')
                    ->orWhere('username', 'LIKE', '%'.$term.'%');
            });
        }
        
        $builder->orderBy($data['sort'], $data['direction']);
        $users = $builder->paginate($data['limit']);
        
        return $users;

    }
    
    public function findByUuid($uuid)
    {
        $user = User::where('uuid', $uuid)->with('enrollments')->first();
        return $user;
    }

    public function toggleActive($id)
    {
        $user= $this->find($id);
        $user->active = ! $user->active;
        $user->save();
    }

    public function getUnenrolledCourses($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $enrollments = $user->enrollments->pluck('course_id');
        $courses = Course::where('published', true)
                        ->where('approved', true)
                        ->whereNotIn('id', $enrollments)
                        ->where('user_id', '!=', $user->id)
                        ->get();

        return $courses;
    }

    public function enroll(array $data)
    {
        $course = Course::find($data['course']);
        $course->students()->attach($data['user']);
    }

    public function unenroll($user, $course)
    {
        $student = User::find($user);
        $student->enrollments()->detach($course);
    }
}



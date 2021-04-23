<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IUser;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    
    protected $users;
    
    public function __construct(IUser $users)
    {
        $this->users = $users;
    }
    
    
    public function index($username)
    {
        $user = $this->users->findByUsername($username);
        if(! $user){
            return response()->json(null, 404);
        }

        return new UserResource($user);
    }

}

<?php

namespace App\Http\Controllers\Frontend;

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
    
    
    public function show($username)
    {
        $user = $this->users->findByUsername($username);
        if(! $user){
            return redirect()->route('frontend.404');
        }

        return view('frontend.user.Show')
                ->with([
                    'user' => new UserResource($user)
                ]);
    }
    
}

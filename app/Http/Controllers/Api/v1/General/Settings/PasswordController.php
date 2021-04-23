<?php
namespace App\Http\Controllers\Api\v1\General\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use App\Rules\Auth\MatchOldPassword;

class PasswordController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(Request $request)
    {
    
        $this->validate($request, [
            'old_password' => ['required', new MatchOldPassword],
            'password' => 'required|string|min:6|confirmed'
        ]);
        $this->userRepository->updatePassword($request->only('old_password', 'password'));
        return response()->json(null, 200);
    }
}
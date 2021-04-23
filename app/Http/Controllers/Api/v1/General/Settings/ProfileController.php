<?php
namespace App\Http\Controllers\Api\v1\General\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            //'username' => 'required|string|max:255|alpha_dash|unique:users,username,'.$user->id,
            'website' => 'nullable|url'
        ]);
        return tap($user)->update($request->only('last_name', 'first_name', 'bio', 'tagline', 'website', 'linkedin', 'twitter', 'youtube', 'github', 'facebook'));
    }
    
    
    
    public function uploadProfileImage(Request $request)
    {
        $user = $request->user();
        $path = $request->file('photo')->store($user->id, 'avatars');
        if($path){
            $user->avatar_location = $path;
            $user->avatar_type = 'storage';
            $user->save();
        }
        
        return $user;
    }

    public function updatePayoutSettings(Request $request)
    {
        $this->validate($request, [
            'paypal_email' => 'required|email'
        ]);

        $user = auth()->user();
        $user->settings()->setMultiple([
            'payout_method' => $request->payout_method,
            'paypal_email' => $request->paypal_email
        ]);
    }
    

}
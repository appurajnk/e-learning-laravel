<?php

namespace App\Models\Auth\Traits;

use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;

/**
 * Class SendUserPasswordReset.
 */
trait SendUserPasswordReset
{
    /**
     * Send the password reset notification.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        try{
            $this->notify(new UserNeedsPasswordReset($token));
        } catch(\Exception $e){
            report($e);
            return false;
        }
    }
}

<?php

namespace App\Models\Auth\Traits\Attribute;

use Illuminate\Support\Facades\Hash;

/**
 * Trait UserAttribute.
 */
trait UserAttribute
{
    /**
     * @param $password
     */
    public function setPasswordAttribute($password) : void
    {
        // If password was accidentally passed in already hashed, try not to double hash it
        if (
            (\strlen($password) === 60 && preg_match('/^\$2y\$/', $password)) ||
            (\strlen($password) === 95 && preg_match('/^\$argon2i\$/', $password))
        ) {
            $hash = $password;
        } else {
            $hash = Hash::make($password);
        }

        // Note: Password Histories are logged from the \App\Observer\User\UserObserver class
        $this->attributes['password'] = $hash;
    }

    public function getPaypalEmailAttribute()
    {
        if(!installed()) return null;
        return $this->settings()->get('paypal_email', null);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->last_name
            ? $this->first_name.' '.$this->last_name
            : $this->first_name;
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->full_name;
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }

    /**
     * @return string
     */
    public function getRolesLabelAttribute()
    {
        $roles = $this->getRoleNames()->toArray();

        if (\count($roles)) {
            return implode(', ', array_map(function ($item) {
                return ucwords($item);
            }, $roles));
        }

        return 'N/A';
    }

    /**
     * @return string
     */
    public function getPermissionsLabelAttribute()
    {
        $permissions = $this->getDirectPermissions()->toArray();

        if (\count($permissions)) {
            return implode(', ', array_map(function ($item) {
                return ucwords($item['name']);
            }, $permissions));
        }

        return 'N/A';
    }

    public function getTotalReviewsAttribute()
    {
        return $this->course_reviews->count();
    }

    public function getAverageReviewAttribute()
    {
        return $this->total_reviews > 0 ? $this->course_reviews->avg('rating') : 0;
    }

    public function getTotalStudentsAttribute()
    {
        return $this->students()->count();
    }

    public function getTotalCoursesAttribute()
    {
        return $this->authored_courses->count();
    }

    public function getHasPurchasesAttribute()
    {
        return $this->purchases->count() > 0;
    }

    public function getHasRefundsAttribute()
    {
        return $this->refunds->count() > 0;
    }
}

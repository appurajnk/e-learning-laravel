<?php

namespace App\Repositories\Eloquent;

use App\Models\Language;
use App\Repositories\Contracts\ILanguage;


class LanguageRepository extends RepositoryAbstract implements ILanguage
{
    
    public function entity()
    {
        return Language::class;
    }
    
    public function findByCode($code)
    {
        return Language::where('carbon_code', $code)->first();
    }

    public function markAsDefault($id)
    {
        Language::where('is_default', true)->update([
            'is_default' => false
        ]);
        
        Language::find($id)->update([
            'is_default' => true,
            'is_active' => true
        ]);
    }
}
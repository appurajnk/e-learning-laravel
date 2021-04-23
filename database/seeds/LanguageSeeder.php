<?php

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    const LanguagesJSON = __DIR__.'/languages.json';
    
    public function run()
    {
        $this->languages()
            ->each(function ($language) {
                Language::create($language);
            });
    }
    
    public function languages()
    {
        $languages = json_decode(\File::get(self::LanguagesJSON), true);
        return collect($languages);
    }
}

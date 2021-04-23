<?php

namespace App\Http\Controllers;

/**
 * Class LanguageController.
 */
class LanguageController extends Controller
{
    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function swap($locale)
    {
        \Cache::forget('lang.js');

        $language = \App\Models\Language::where('carbon_code', $locale)->first();

        if (! empty($language)) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}

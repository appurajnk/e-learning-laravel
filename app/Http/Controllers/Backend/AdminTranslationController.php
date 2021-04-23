<?php

namespace App\Http\Controllers\Backend;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JoeDixon\Translation\Drivers\Translation;

class AdminTranslationController extends Controller
{
    
    private $translation;

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    public function index(Request $request)
    {
        return view('backend.translations.Index');
    }

    public function edit(Request $request, $language)
    {
        if ($request->has('language') && $request->get('language') !== $language) {
            return redirect()
                ->route('admin.translations.edit', ['language' => $request->get('language'), 'group' => $request->get('group'), 'filter' => $request->get('filter')]);
        }
        $languages = collect(Language::all()->pluck('carbon_code', 'carbon_code'));
        $groups = $this->translation->getGroupsFor('en')->merge('single');
        $translations = $this->translation->filterTranslationsFor($language, $request->get('filter'));

        if ($request->has('group') && $request->get('group')) {
            if ($request->get('group') === 'single') {
                $translations = $translations->get('single');
                $translations = new Collection(['single' => $translations]);
            } else {
                $translations = $translations->get('group')->filter(function ($values, $group) use ($request) {
                    return $group === $request->get('group');
                });
                $translations = new Collection(['group' => $translations]);
            }
        }

        return view('backend.translations.Edit', compact('language', 'languages', 'groups', 'translations'));
    }


}

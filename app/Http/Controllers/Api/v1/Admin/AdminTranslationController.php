<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use JoeDixon\Translation\Drivers\Translation;
use App\Repositories\Contracts\ILanguage;

class AdminTranslationController extends Controller
{
    
    private $disk;
    private $translation;
    private $languages;

    public function __construct(Translation $translation, FileSystem $disk, ILanguage $languages)
    {
        $this->disk = $disk;
        $this->translation = $translation;
        $this->languages = $languages;
    }

    public function fetchAllLanguages(Request $request)
    {
        $query = (new Language)->newQuery()->orderBy('is_default', 'desc')->orderBy('is_active', 'desc')->orderBy('name'); 
        if($request->activeOnly){
            $query->where('is_active', true)->get();
        }
        return response()->json($query->get(), 200);
    }

    // store new language
    public function store(Request $request)
    {
        $code = $request->code;
        $this->validate($request, [
            'name' => 'required|unique:languages,name',
            'code' => 'required|unique:languages,carbon_code',
            'php_code' => 'required|unique:languages,php_code'
        ]);

        // save language
        Language::create([
            'name' => $request->name,
            'php_code' => $request->php_code,
            'carbon_code' => $request->code,
            'is_active' => $request->is_active,
            'is_rtl' => $request->is_rtl
        ]);

        // create language folder
        $this->disk->makeDirectory(resource_path("lang/{$code}"));

        \Cache::forget('locales');
        
        
    }

    public function destroy($id)
    {
        $language = Language::find($id);
        if($language){
            $language->delete();
        }
    }

    public function updateLanguage(Request $request, $id)
    {
        $language = Language::find($id);
        $this->validate($request, [
            'name' => 'required|unique:languages,name,'.$language->id,
            'carbon_code' => 'required|unique:languages,carbon_code,'.$language->id,
            'php_code' => 'required|unique:languages,php_code,'.$language->id
        ]);
        
        $language->update([
            'name' => $request->name,
            'php_code' => $request->php_code,
            'carbon_code' => $request->carbon_code,
            'is_rtl' => $request->is_rtl,
            'is_active' => $request->is_active
        ]);

        if($request->is_default == true){
            $this->languages->markAsDefault($id);
            setting(["site.site_language" => $language->carbon_code]);
            setting()->save();
        }
        
        \Cache::forget('locales');
    }

}

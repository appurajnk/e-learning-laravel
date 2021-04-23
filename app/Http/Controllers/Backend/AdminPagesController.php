<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Controllers\Controller;

class AdminPagesController extends Controller
{
    

    public function index()
    {
        return view('backend.pages.index');
    }

    public function create(Request $request)
    {
        $default_lang = Language::where('is_default', true)->first();
        return view('backend.pages.create')->with(['language' => $default_lang]);
    }

    public function edit($uuid)
    {
        $langs = Language::where('is_active', true)->orderBy('is_default', 'desc')->get();
        return view('backend.pages.edit')->with(['languages' => $langs])->with(['uuid' => $uuid]);
    }

}

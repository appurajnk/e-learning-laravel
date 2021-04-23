<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if(!$page){
            return redirect()->route('frontend.404');
        }

        return view('frontend.page.Show')->with(['page' => $page]);
    }

}

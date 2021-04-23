<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IPage;
use App\Http\Resources\PageResource;


class AdminPagesController extends Controller
{
    
    private $pages;

    public function __construct(IPage $pages)
    {
        $this->pages = $pages;
    }


    public function fetchAll(Request $request)
    {
        $pages = $this->pages->getAdminPages($request->all());
        return PageResource::collection($pages);
    }

    public function getByUuid($uuid)
    {
        $page = $this->pages->getByUuid($uuid);
        return new PageResource($page);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'slug' => 'required|unique:pages,slug|alpha_dash',
            'title' => 'required'
            //'title' => 'required|unique_translation:pages,title'
        ]);
        $page = $this->pages->store($request->all());
        return response()->json($page, 200);
    }

    public function fetchPageForLocale($uuid, $locale)
    {
        $page = $this->pages->fetchPageForLocale($uuid, $locale);
        return new PageResource($page);
    }

    public function update(Request $request, $uuid)
    {
        $page = $this->pages->getByUuid($uuid);

        $this->validate($request, [
            'body' => 'required',
            'title' => 'required'
            //'title' => 'required|unique_translation:pages,title,'.$page->id
        ]);
        
        $page = $this->pages->update($request->all(), $uuid);
        return new PageResource($page);
        
    }

    public function updateSlug(Request $request, $id)
    {
        $this->validate($request, [
            'slug' => 'required|alpha_dash|unique:pages,slug,'.$id
        ]);
        $page = $this->pages->updateSlug($request->all(), $id);
        return new PageResource($page);

    }

    public function togglePublish($id)
    {
        $page = $this->pages->togglePublish($id);
        return new PageResource($page);
    }

    public function destroy($id)
    {
        $this->pages->destroy($id);
        return response()->json(null, 200);
    }
}

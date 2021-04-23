<?php

namespace App\Repositories\Eloquent;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IPage;
use App\Http\Resources\CourseResource;

class PageRepository  extends RepositoryAbstract implements IPage
{
    
    
    public function entity()
    {
        return Page::class;
    }
    
    public function getAdminPages(array $data)
    {
        
        $pages = Page::orderBy($data['sort'], $data['direction']);
                    
        if($data['query']){
            $pages = $pages->where('title', 'LIKE', '%'.$data['query'].'%');
        }
        
        $pages = $pages->paginate($data['limit']);
        
        return $pages;
    }

    public function store(array $data)
    {
        $page = new Page;
        $page
            ->setTranslation('title', $data['locale'], $data['title'])
            ->setTranslation('body', $data['locale'], $data['body']);

        $page->slug = $data['slug'];
        $page->save();

        \Cache::forget('pages');

        return $page;
    }

    public function fetchPageForLocale($uuid, $locale)
    {
        $page = $this->getByUuid($uuid);
        return $page;
    }

    public function getByUuid($uuid)
    {
        $page = Page::where('uuid', $uuid)->first();
        return $page;
    }

    public function update(array $data, $uuid)
    {
        $page = $this->getByUuid($uuid);
        $page->setTranslation('title', $data['locale'], $data['title']);
        $page->setTranslation('body', $data['locale'], $data['body']);
        $page->save();
        \Cache::forget('pages');

    }

    public function updateSlug(array $data, $id)
    {
        $page = Page::find($id);
        $page->slug = $data['slug'];
        $page->save();
        \Cache::forget('pages');
        return $page;

    }

    public function togglePublish($id)
    {
        $page = Page::find($id);
        $page->published = ! $page->published;
        $page->save();
        \Cache::forget('pages');
        return $page;
    }
    
    public function destroy($id)
    {
        $page = Page::find($id);
        \Cache::forget('pages');
        $page->delete();
    }
    
}



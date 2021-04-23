<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\ICategory;
use App\Http\Resources\CategoryResource;


class CategoryRepository extends RepositoryAbstract implements ICategory
{
    
    public function entity()
    {
        return Category::class;
    }
    
    public function fetchAllWithCourses()
    {
        $categories = Category::parents()
                        ->whereHas('children', function($q) {
                            $q->whereHas('courses', function($c) {
                                $c->where('published', true)
                                    ->where('approved', true);
                            });
                        })
                        ->with(['children' => function($children){
                            $children->has('courses')
                                ->ordered();
                        }])
                        ->ordered()
                        ->get();
        
        return $categories;
    }

    public function fetchAll()
    {
        $categories = Category::parents()
                        ->with('children.courses')
                        ->with(array('children' => function($children){
                            $children->orderBy('sortOrder', 'asc');
                        }))
                        ->orderBy('sortOrder', 'asc')
                        ->get();
        return $categories;
    }
    
    public function findById($id)
    {
        $category = Category::find($id);
        return $category;
    }
    
    public function update(array $data, $id)
    {
        $category = Category::find($id)
                        ->update([
                            'name' => $data['name'],
                            'slug' => \Str::slug($data['name']),
                            'image' => $data['icon']
                        ]);
        \Cache::forget('categories');
        return $category;

    }

    public function store(array $data)
    {
        $max_sort = Category::max('sortOrder');
        $category = Category::create([
                        'name' => $data['name'],
                        'slug' => \Str::slug($data['name']),
                        'sortOrder' => $max_sort+1,
                        'parent_id' => $data['parent'],
                        'image' => $data['icon']
                    ]);
        \Cache::forget('categories');
        return $category;

    }

    public function findBySlug($slug)
    {
        $category = Category::where('slug', $slug)->with(['children', 'parent'])->first();
        return $category;
    }
    
    public function findCategoriesWithCourses()
    {
        $categories = Category::isChild()->has('courses')->orderBy('name')->get();
        return $categories;
    }

    public function orderCategories(array $data)
    {
        foreach($data as $category){
            $parent = Category::find($category['id']);
            $parent->sortOrder = $category['sortOrder'];
            $parent->parent_id = null;
            $parent->save();
            if(\Arr::exists($category, 'children')){
                foreach($category['children'] as $subcat){
                    $child = Category::find($subcat['id']);
                    $child->update([
                        'sortOrder' => (int)$subcat['sortOrder'],
                        'parent_id' => (int)$subcat['parent_id']
                    ]);
                }
            }
        }

        \Cache::forget('categories');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(! $category->hasChildren()){
            $category->delete();
            \Cache::forget('categories');
        }
    }
}
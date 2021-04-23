<?php

namespace App\Repositories\Eloquent;

use App\Models\Section;
use App\Repositories\Contracts\ISection;
use App\Http\Resources\SectionResource;


class SectionRepository extends RepositoryAbstract implements ISection
{
    
    public function entity()
    {
        return Section::class;
    }
    
    public function updateDraggable(array $data)
    {
        foreach($data as $d){
            $section = Section::find($d['id']);
            $section->sortOrder = $d['sortOrder'];
            $section->save();
        }
    }
    
    public function findByCourse($id)
    {
        $sections = Section::where('course_id', $id)->with('lessons')->orderBy('sortOrder')->get();
        return $sections;
    }
    
    
    
    public function create(array $data)
    {
        $maxSort = Section::where('course_id', $data['course'])->max('sortOrder');
        $section = Section::create([
            'title' => $data['title'],
        	'objective' => $data['objective'],
        	'course_id' => $data['course'],
        	'sortOrder' => $maxSort+1
        ]);
        
        return $section;
    }
    
    public function update(array $data, $id)
    {
        
        $section = $this->find($id);
        
        $section->update([
            'title' => $data['title'],
        	'objective' => $data['objective']
        ]);
        
        return $section;
    }
    
}
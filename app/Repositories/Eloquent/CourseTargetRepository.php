<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseTarget;
use App\Models\Category;
use App\Repositories\Contracts\ICourseTarget;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;

class CourseTargetRepository  extends RepositoryAbstract implements ICourseTarget
{
    
    public function entity()
    {
        return CourseTarget::class;
    }
    
    public function createOrUpdate(array $data, $id)
    {
  
        foreach($data as $key => $items) {
            $ids = data_get(\Arr::collapse($items), '*.id');
            $filtered = \Arr::where($ids, function ($value, $key) {
                return $value != null;
            });
            
            foreach($items['items'] as $item){
                if( $item['id'] == null ){
                    $maxSort = \DB::table('course_targets')->where('course_id', $id)
                                ->where('type', $key)->max('sortOrder');
                    $t = CourseTarget::create([
                       'type' => $key,
                       'text' => $item['text'],
                       'course_id' => $id,
                       'sortOrder' => $maxSort+1
                    ]);
                    
                    array_push($filtered, $t->id);
                } else {
                    $target = $this->find($item['id']);
                    $target->update([
                        'text' => $item['text']
                    ]);
                }
            }
            
            CourseTarget::where('course_id', $id)
                    ->whereNotIn('id', $filtered)
                    ->where('type', $key)->delete();
        };
  
    }
    
    public function fetchCourseRequirements($id){
        return CourseTarget::where('course_id', $id)->orderBy('sortOrder', 'asc')->get();
    }
    
    public function updateDraggable(array $data)
    {
        foreach($data as $d){
            $target = $this->find($d['id']);
            $target->sortOrder = $d['sortOrder'];
            $target->save();
        }
    }
    
    protected function getIds(array $data)
    {
        $ids = [];
        
        foreach ($data as $i) {
            $ids = array_merge($ids, this.getIds($i));
        }
        
        return $ids;
    }
    
    
}



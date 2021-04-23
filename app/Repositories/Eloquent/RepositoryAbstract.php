<?php

namespace App\Repositories\Eloquent;


use App\Models\Category;
use App\Repositories\Criteria\ICriteria;
use App\Http\Resources\CategoryResource;
use App\Repositories\Exceptions\NoEntityDefined;

use App\Repositories\Contracts\IRepository;

abstract class RepositoryAbstract implements IRepository, ICriteria
{
    protected $entity;
    
    public function __construct()
    {
        $this->entity = $this->resolveEntity();
        
    }
    
    public function all()
    {
        return $this->entity->get();
    }
    
    public function find($id)
    {
        return $this->entity->find($id);
    }
    
    public function findWhere($column, $value)
    {
        return $this->entity->where($column, $value)->get();
    }
    
    public function findWhereFirst($column, $value)
    {
        return $this->entity->where($column, $value)->first();
    }
    
    
    public function paginate($per_page = 10)
    {
        return $this->entity->paginate($per_page);
    }
    
 
    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
    
    
    public function withCriteria(...$criteria)
    {
        $criteria = array_flatten($criteria);
        
        foreach($criteria as $criterion){
            $this->entity = $criterion->apply($this->entity);
        }
        
        return $this;
    }
    
    
    
    protected function resolveEntity()
    {
        if( ! method_exists($this, 'entity')){
            throw new NoEntityDefined();
        }
        
        return app()->make($this->entity());
    }
}
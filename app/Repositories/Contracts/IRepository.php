<?php

namespace App\Repositories\Contracts;

interface IRepository
{
    
    public function all();
    
    public function find($id);
    
    public function findWhere($column, $value);
    
    public function findWhereFirst($column, $value);
    
    public function paginate($per_page = 10);

    public function destroy($id);
    
    
}
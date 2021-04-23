<?php
namespace App\Repositories\Contracts;

interface ISection extends IRepository
{
    
    
    public function updateDraggable(array $data);
    
    public function findByCourse($id);
    
    public function create(array $data);
    
    public function update(array $data, $id);
    
    
}
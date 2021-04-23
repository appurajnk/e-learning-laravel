<?php
namespace App\Repositories\Contracts;

interface ICategory extends IRepository
{
    
    
    public function fetchAll();
    public function fetchAllWithCourses();
    public function findById($id);
    public function update(array $data, $id);
    public function store(array $data);
    public function findBySlug($slug);
    public function findCategoriesWithCourses();
    public function orderCategories(array $data);
    public function destroy($id);
    
    
}
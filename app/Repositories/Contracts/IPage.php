<?php
namespace App\Repositories\Contracts;

interface IPage extends IRepository
{
    
    
    public function getAdminPages(array $data);
    public function store(array $data);
    public function fetchPageForLocale($uuid, $locale);
    public function update(array $data, $uuid);
    public function getByUuid($uuid);
    public function updateSlug(array $data, $id);
    public function togglePublish($id);
    public function destroy($id);
    
    
}
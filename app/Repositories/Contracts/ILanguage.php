<?php
namespace App\Repositories\Contracts;

interface ILanguage extends IRepository
{
    
    public function findByCode($code);
    public function markAsDefault($id);



}
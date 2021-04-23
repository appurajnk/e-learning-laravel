<?php
namespace App\Repositories\Contracts;

interface ITransaction extends IRepository
{
    
    public function fetchAll(array $data);
}
<?php
namespace App\Repositories\Contracts;

use Gloudemans\Shoppingcart\Contracts\Buyable;

interface IQuestion extends IRepository
{
    
    
    public function fetchQuestions(array $data);
    
    public function fetchQuestion($uuid);
    
    public function storeQuestion(array $data);
    
    public function updateQuestion(array $data, $id);
    
    public function destroyQuestion($id);
    
    
    
    
}